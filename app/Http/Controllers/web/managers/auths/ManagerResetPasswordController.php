<?php

namespace App\Http\Controllers\web\managers\auths;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerResetPasswordController extends Controller
{
    //FONCTION PERMETTANT D'AFFICHER UNE PAGE PERMETTANT AU MANAGER DE RECUPERER SON COMPTE EN CAS DE MOT DE PASSE OUBLIÉ
    public function index()
    {
        return view('managers.pages.auth.reset');
    }
}
