<?php

namespace App\Http\Controllers\web\collaborators\users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MesCollaboratotorController extends Controller
{
    //AFFICHER LA LISTE DES COLLABORATEURS
    public function index()
    {
        $collaborator_count = User::where('status', true)->count();
        $collaborators = User::where('status', true)->get();
        return view('collaborators.pages.users.index', compact('collaborators', 'collaborator_count'));
    }
}
