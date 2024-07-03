<?php

namespace App\Http\Controllers\web\managers\meets;

use App\Http\Controllers\Controller;
use App\Mail\MeetingInviteMail;
use App\Models\IsMeetMember;
use App\Models\Meet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Exception;

class ManagerMeetsController extends Controller
{
    //AFFICHER LA PAGE DE REUNION
    public function index()
    {
        $meets_count = Meet::count();
        $ongoing_count = Meet::where('status', 0)->count();
        $finish_count = Meet::where('status', 1)->count();
        $meets = Meet::where('status', 0)->get();
        return view('managers.pages.meets.list', compact('meets', 'meets_count', 'ongoing_count', 'finish_count'));
    }


    //ENREGISTRER LA REUNION DANS LA BD
    public function store(Request $request)
    {
        try
        {
            // Valider les données entrées par l'utilisateur
            $validator = Validator::make($request->all(), [
                'subject' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            //Vérifier si la validation a échoué
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->start_time >= $request->end_time)
            {
                return redirect()->back()->with('error', 'La date de début doit être inférieure à la date de fin');
            }

            $meet = new Meet();
            $meet->subject = $request->subject;
            $meet->start_time = $request->start_time;
            $meet->end_time = $request->end_time;
            $meet->user_id = $request->user_id;
            $meet->content = $request->content;
            $meet->status = 0;

            //ICI ON GENERE UN TOKEN DE FACON ALEATOIRE CONTENANT 12 CARACTERES
            //ON PASSE LE TOKEN DANS UNE BOUCLE DO WHILE POUR L'EXISTANCE DU TOKEN DANS LA TABLE PROJECTS
            //NB: SELON MA LOGIQUE, LE TOKEN DOIT ETRE UNIQUE
            do {
                $token = Str::random(12);
            }
            while (Meet::where('token', $token)->exists());

            $meet->token = $token;
            $meet->save();

            return redirect()->back()->with('success', "Réunion créee !");

        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    //SUPPRIMER UNE REUNION CRÉEE
    public function delete($token)
    {
        $meet = Meet::where('token', $token)->first();

        if(!$meet)
        {
            return redirect()->back()->with('error', 'Meet introuvable');
        }

        $meet->delete();
        return redirect()->back()->with('success', 'Meet supprimé');
    }


    //AFFICHER LES DETAILS D'UNE REUNIONS
    public function show($token)
    {
        $meet = Meet::join('users', 'meets.user_id', '=', 'users.id')
            ->where('meets.token', $token)
                ->select('meets.*', 'users.name')
                    ->first();

        if(!$meet)
        {
            return redirect()->back()->with('error', 'Meet introuvable');
        }

        $collaborators_list = User::where('status', true)->get();

        $collaborators = User::join('is_meet_members', 'is_meet_members.user_id', '=', 'users.id')
            ->join('meets', 'meets.id', '=', 'is_meet_members.meet_id')
            ->select('users.*', 'is_meet_members.status as statut')
                ->where('meets.token', $token)
                    ->get();

        return view('managers.pages.meets.invite', compact('meet', 'collaborators', 'collaborators_list'));
    }

    //INVITER DES COLLABORATEURS A UNE REUNION
    public function invite(Request $request)
    {
        $user_id = $request->user_id;
        $meet_id = $request->meet_id;

        // Vérifiez si l'utilisateur est déjà membre du meet
            $isMember = IsMeetMember::where('user_id', $user_id)
            ->where('meet_id', $meet_id)
            ->exists();

        if ($isMember) {
        return redirect()->back()->with('error', 'L\'utilisateur est déjà membre de ce meet');
        }

        // Ajoutez l'utilisateur au meet s'il n'est pas déjà membre
        $is_meet_member = new IsMeetMember();
        $is_meet_member->user_id = $user_id;
        $is_meet_member->meet_id = $meet_id;
        $is_meet_member->save();

        if($is_meet_member->save())
        {
            return redirect()->back()->with('success', 'Collaborateur invité');
        }
        else
        {
            dd();
            //return redirect()->back()->with('error', 'Collaborateur invité');
        }
    }

    //ENVOYER UN EMAIL AUX MEMBRES D'UNE REUNION
    public function sendEmail($token)
    {
        $meet = Meet::where('token', $token)->first();

        if(!$meet)
        {
            return redirect()->back()->with('error', 'Meet introuvable');
        }

        $collaborators = User::join('is_meet_members', 'is_meet_members.user_id', '=', 'users.id')
            ->join('meets', 'meets.id', '=', 'is_meet_members.meet_id')
            ->select('users.*', 'is_meet_members.status as statut', 'meets.subject', 'meets.url', 'meets.content', 'meets.start_time', 'meets.end_time')
                ->where('meets.token', $token)
                    ->get();


        // Vérifiez si des collaborateurs ont été invités
        if($collaborators->isEmpty())
        {
            return redirect()->back()->with('error', 'Aucun collaborateur n\'a été invité à cette réunion');
        }

        // Envoyer un email à chaque collaborateur
        foreach ($collaborators as $collaborator)
        {
            Mail::to($collaborator->email)->send(new MeetingInviteMail($collaborator->email, $collaborator->content, $collaborator->name, $collaborator->subject, $collaborator->url, $collaborator->start_time, $collaborator->end_time));
        }

        return redirect()->back()->with('success', 'Email envoyé aux collaborateurs');
    }
}
