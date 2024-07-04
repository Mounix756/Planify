<?php

namespace App\Http\Controllers\web\collaborators\auths;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CollaboratorLoginController extends Controller
{
    //FONCTION PERMETTANT D'AFFICHER LE FORMULAIRE DE CONNEXION SUR L'APPLI EN TANT QUE COLLABORATEUR
    public function index()
    {
        return view('collaborators.pages.auths.login');
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

            //Tentative de connexion de l'utilisateur avec le guard "collaborator"
            if(Auth::guard('collaborator')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => true, 'is_manager' => false], true))
            {
                //Authentification réussie
                //Ici je defini un cookie en fonction de si l'utilisateur a cliqué sur se souvenir de moi ou non
                return redirect()->route('collaborator_home')->withCookie(cookie('Collaborator_authenticate_cookies', $request->cookie('Collaborator_authenticate_cookies'), $cookieLifetime));
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


    //DECONNEXION DU COLLABORATEUR
    public function logout(Request $request)
    {
        try {
            // Déconnexion de l'utilisateur du guard "manager"
            Auth::guard('collaborator')->logout();

            // Invalider la session de l'utilisateur
            $request->session()->invalidate();

            // Régénérer le token CSRF
            $request->session()->regenerateToken();

            // Rediriger l'utilisateur vers la page de connexion avec un message de succès
            return redirect()->route('collaborator_signin');
        } catch (Exception $e) {
            // En cas d'erreur, rediriger l'utilisateur avec un message d'erreur
            return redirect()->back()->with('error', "Oups ! Une erreur s'est produite. " . $e->getMessage());
        }
    }
}
