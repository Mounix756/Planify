<?php

namespace App\Http\Controllers\web\collaborators\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CollaboratorHomeController extends Controller
{
    //AFFICHER LA PAGE D'ACCUEIL DU DASHBOARD COLLABORATEUR
    public function index()
    {
        return view('collaborators.pages.home.home');
    }
}
