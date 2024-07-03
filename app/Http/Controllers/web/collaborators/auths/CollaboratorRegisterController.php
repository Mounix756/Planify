<?php

namespace App\Http\Controllers\web\collaborators\auths;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\ManagerOtpMail;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;
use Carbon\Carbon;

class CollaboratorRegisterController extends Controller
{
    //FONCTION PERMETTANT D'AFFICHER LE FORMULAIRE D'INSCRIPTION SUR L'APPLI EN TANT QUE COLLABORATEUR
    public function index()
    {
        return view('collaborators.pages.auths.register');
    }


    //FONCTION PERMETTANT D'ENREGISTRER L'UTILISATEUR DANS LE BD
    public function store(Request $request)
    {
        try
        {
            // Valider les données entrées par l'utilisateur
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required'
            ]);

            //Vérifier si la validation a échoué
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            //Vérifier si l'email existe déjà dans la base de données
            $existingUser = User::where('email', $request->email)->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'Compte existant, vous ne pouvez pas créer plus d\'un compte avec cet email. Veillez récupérer votre ancien compte.');
            }

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->is_manager = false;
            $user->status = false;

            //UNE FACON DE CREER UN MOT DE PASSE AVEC UNE CLE SECRETE LONGUE, DONC PLUS SECURISE
            $user->password = Hash::make($request->password,
                ['rounds' => 12,
            ]);

            //ICI ON GENERE UN TOKEN DE FACON ALEATOIRE CONTENANT 12 CARACTERES
            //ON PASSE LE TOKEN DANS UNE BOUCLE DO WHILE POUR L'EXISTANCE DU TOKEN DANS LA TABLE USER
            //NB: SELON MA LOGIQUE, LE TOKEN DOIT ETRE UNIQUE
            do {
                $token = Str::random(12);
            }
            while (User::where('token', $token)->exists());

            $user->token = $token;

            //AJOUTE 5MIN A LA DATE DE CREATION DU TOKEN, CETTE SERA CONSIDERER COMME DATE D'EXPIRATION DU TOKEN.
            $user->email_verified_at = Carbon::now()->addMinutes(5);
            $user->save();

            if($user->save())
            {
                try
                {
                    $userEmail = $user->email;
                    $validToken = $user->token;
                    $userName = $user->first_name. ' ' . $user->last_name;

                    Mail::to($userEmail)->send(new ManagerOtpMail($userEmail, $validToken, $userName));
                    return redirect()->back()->with('message', "Un email de verification vous a été envoyé ! Cliquez sur le bouton valider pour confirmer votre identité.");
                }
                catch(Exception $i)
                {
                    return redirect()->back()->with('error', $i->getMessage());
                }
            }
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    //FONCTION QUI VERIFIE QUE LE LIEN SUR LEQUEL L'UTILISATEUR A CLIQUE EST VALIDE
    public function validateToken($token)
    {
        try
        {
            $user = User::where('token', $token)
            ->where('email_verified_at', '>=', Carbon::now())
            ->first();

            if (!$user) {
                return redirect()->route('collaborator_signin')->with('info', 'Le lien de validation est invalide ou a expiré.');
            }

            // Activer le compte de l'utilisateur
            $user->status = false;
            $user->save();

            // Authentifier l'utilisateur avec le guard admin
            //Auth::guard('collaborator')->login($user);

            return redirect()->route('collaborator_signin')->with('success', 'Félicitation ! Votre compte Planify a bien été créé.');
        }
        catch(Exception $e)
        {
            return redirect()->back()->with('error', "Oups! Une erreur s'est produite lors de la validation du coupe, veillez ressayer.". $e->getMessage());
        }
    }
}
