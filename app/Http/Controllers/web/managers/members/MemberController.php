<?php

namespace App\Http\Controllers\web\managers\members;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    //AFFICHER LA LISTE DES COLLABORATEURS
    public function index()
    {
        $collaborator_count = User::where('status', true)->count();
        $collaborators = User::where('status', true)->get();
        return view('managers.pages.members.index', compact('collaborators', 'collaborator_count'));
    }


    //AFFICHER LES COMPTES COLLABORATEURS
    public function collaborator()
    {
        $collaborator_count = User::where('status', true)->count();
        $collaborators = User::where('status', true)->where('is_manager', false)->get();
        return view('managers.pages.members.collaborators', compact('collaborators', 'collaborator_count'));
    }

    //AFFICHER LES COMPTES MANAGERS
    public function manager()
    {
        $collaborator_count = User::where('status', true)->count();
        $managers = User::where('status', true)->where('is_manager', true)->get();
        return view('managers.pages.members.managers', compact('managers', 'collaborator_count'));
    }


    //SUPPRIMER UN UTILISATEUR
    public function delete($token)
    {
        $manager = User::where('token', $token)->first();

        if(!$manager)
        {
            return redirect()->back()->with('error', 'Utilisateur introuvable');
        }

        $manager->delete();
        return redirect()->back()->with('success', 'Utilisateur supprimé');
    }


    //ACTIVER LE COMPTE DES UTILISATEUR
    public function active($token)
    {
        $manager = User::where('token', $token)->first();

        if(!$manager)
        {
            return redirect()->back()->with('error', 'Utilisateur introuvable');
        }

        $manager->status = true;
        return redirect()->back()->with('success', 'Utilisateur supprimé');
    }
}
