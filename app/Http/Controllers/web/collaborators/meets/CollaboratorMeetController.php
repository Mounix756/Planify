<?php

namespace App\Http\Controllers\web\collaborators\meets;

use App\Http\Controllers\Controller;
use App\Models\Meet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CollaboratorMeetController extends Controller
{
    //AFFICHER LA LISTE DE REUNION D'UN UTILISATEUR
    public function index()
    {
        if(Auth::guard('collaborator')->check())
        {
            $id = Auth::guard('collaborator')->id();

            $meets_count = Meet::join('is_meet_members', 'is_meet_members.meet_id', '=', 'meets.id')
                ->join('users', 'users.id','=', 'is_meet_members.user_id')
                    ->where('users.id', $id)
                        ->count();

            $ongoing_count = Meet::join('is_meet_members', 'is_meet_members.meet_id', '=', 'meets.id')
                ->join('users', 'users.id','=', 'is_meet_members.user_id')
                    ->where('users.id', $id)
                        ->where('meets.status', 0)
                            ->count();

            $finish_count = Meet::join('is_meet_members', 'is_meet_members.meet_id', '=', 'meets.id')
                ->join('users', 'users.id','=', 'is_meet_members.user_id')
                    ->where('users.id', $id)
                        ->where('meets.status', 1)
                            ->count();

            $meets = Meet::join('is_meet_members', 'is_meet_members.meet_id', '=', 'meets.id')
                ->join('users', 'users.id','=', 'is_meet_members.user_id')
                    ->select('meets.*')
                        ->where('users.id', $id)
                            ->where('meets.status', 0)
                                ->get();

            return view('collaborators.pages.meets.index', compact('meets', 'meets_count', 'ongoing_count', 'finish_count'));
        }
        else
        {
            return redirect()->back()->with('error', "Utilisateur non connecté");
        }

    }


    //VOIR LES DETAILS D'UNE REUNION
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

        return view('collaborators.pages.meets.show', compact('meet', 'collaborators', 'collaborators_list'));
    }
}
