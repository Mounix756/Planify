<?php

namespace App\Http\Controllers\web\managers\auths;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerLoginController extends Controller
{
    //FONCTION PERMETTANT D'AFFICHER LE FORMULAIRE DE CONNEXION SUR L'APPLI EN TANT QUE PROJECT MANAGER
    public function index()
    {
        return view('managers.pages.auth.login');
    }
}
