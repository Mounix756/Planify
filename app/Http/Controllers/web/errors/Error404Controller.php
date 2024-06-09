<?php

namespace App\Http\Controllers\web\errors;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Error404Controller extends Controller
{
    //AFFICHER UNE PAGE 404 POUR TOUTE LES ROUTES INCONNUES ENTRÉES PAR L'UTILISATEUR
    public function index()
    {
        return view('managers.pages.errors.404');
    }
}
