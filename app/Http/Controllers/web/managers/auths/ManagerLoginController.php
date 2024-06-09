<?php

namespace App\Http\Controllers\web\managers\auths;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ManagerLoginController extends Controller
{
    //FONCTION PERMETTANT D'AFFICHER LE FORMULAIRE DE CONNEXION SUR L'APPLI EN TANT QUE PROJECT MANAGER
    public function index()
    {
        return view('managers.pages.auth.login');
    }

    //FONCTION QUI CONNECTE L'UTILISATEUR
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        try
        {
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //Si la validation a échoué
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //Definir la durée des cookies à 120s => deux heures
            $cookieLifetime = 120;

            //Si l'utilisateur a coché le champ: "Se souvenir de moi", alors definir les cookies à 30 jours
            if ($request->remember == true) {
                $cookieLifetime = 60 * 24 * 30;
            }

            //Tentative de connexion de l'utilisateur avec le guard "manager"
            if(Auth::guard('manager')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => true, 'is_manager' => true], true))
            {
                //Authentification réussie
                //Ici je defini un cookie en fonction de si l'utilisateur a cliqué sur se souvenir de moi ou non
                return redirect()->route('manager_home')->withCookie(cookie('Manager_authenticate_cookies', $request->cookie('Manager_authenticate_cookies'), $cookieLifetime));
            }
            else
            {
                //Authentification échouée
                return redirect()->back()->with(['error' => 'Email ou mot de passe incorrect']);
            }

            return redirect()->back()->withErrors(['email' => 'Email ou mot de passe incorrect']);
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', "Oups ! Une erreur s'est produite.". $e->getMessage());
        }
    }
}
