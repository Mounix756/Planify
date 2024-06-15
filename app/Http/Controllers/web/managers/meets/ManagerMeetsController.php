<?php

namespace App\Http\Controllers\web\managers\meets;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

class ManagerMeetsController extends Controller
{
    //AFFICHER LA PAGE DE REUNION
    public function index()
    {
        $meets = Meet::where('status', 0)->get();
        return view('managers.pages.meets.list', compact('meets'));
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
}
