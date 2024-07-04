<?php

namespace App\Http\Controllers\web\managers\projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;
use Carbon\Carbon;

class ManagersProjectsController extends Controller
{
    //AFFICHER LE FORMULAIRE D'AJOUT DE PROJETS
    public function index()
    {
        //RECUPÉRER TOUS LES PROJETS
        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
            ->select('projects.*', 'users.name as user_name')
                ->get();

        //RECUPÉRER LE NOMBRE DE PROJETS TERMINÉS
        $is_finish = Project::where('status', 1)->count();

        //RECUPÉRER LE NOMBRE DE PROJETS EN COURS
        $is_ongoing = Project::where('status', 0)->count();

        //RECUPÉRER LE NOMBRE DE PROJETS EN ATTENTE
        $is_pending = Project::where('status', -1)->count();

        $page = 0;

        return view('managers.pages.projects.list', compact('projects', 'is_finish', 'is_ongoing', 'is_pending', 'page'));
    }


    //AFFICHER UNE PAGE PERMETTANT L'EDITION D'UN PROJET
    public function edit($token)
    {
        $project = Project::where('token', $token)->first();
        
        return view('managers.pages.projects.edit', compact('project'));
    }


    //AFFICHER LA LISTE DE PROJETS
    public function list()
    {
        //RECUPÉRER TOUS LES PROJETS
        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
            ->select('projects.*', 'users.name as user_name')
                ->get();

        //RECUPÉRER LE NOMBRE DE PROJETS TERMINÉS
        $is_finish = Project::where('status', 1)->count();

        //RECUPÉRER LE NOMBRE DE PROJETS EN COURS
        $is_ongoing = Project::where('status', 0)->count();

        //RECUPÉRER LE NOMBRE DE PROJETS EN ATTENTE
        $is_pending = Project::where('status', -1)->count();

        $page = 1;

        return view('managers.pages.projects.list', compact('projects', 'is_finish', 'is_ongoing', 'is_pending', 'page'));
    }


    //FONCTION PERMETTANT D'ENREGISTRER UN NOUVEAU PROJET
    public function store(Request $request)
    {
        try
        {
            // Valider les données entrées par l'utilisateur
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);

            //Vérifier si la validation a échoué
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->start_time >= $request->end_time)
            {
                return redirect()->back()->with('error', 'La date de début doit être inférieure à la date de fin');
            }

            $project = new Project();
            $project->name = $request->name;
            $project->start_time = $request->start_time;
            $project->end_time = $request->end_time;
            $project->user_id = $request->user_id;
            $project->content = $request->content;
            $project->status = -1;

            //ICI ON GENERE UN TOKEN DE FACON ALEATOIRE CONTENANT 12 CARACTERES
            //ON PASSE LE TOKEN DANS UNE BOUCLE DO WHILE POUR L'EXISTANCE DU TOKEN DANS LA TABLE PROJECTS
            //NB: SELON MA LOGIQUE, LE TOKEN DOIT ETRE UNIQUE
            do {
                $token = Str::random(12);
            }
            while (Project::where('token', $token)->exists());

            $project->token = $token;
            $project->save();

            return redirect()->back()->with('success', "Projet ajouté !");

        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

     //FONCTION PERMETTANT DE METTRE À JOUR UN PROJET EXISTANT
     public function update(Request $request)
     {
         try {
             // Valider les données entrées par l'utilisateur
             $validator = Validator::make($request->all(), [
                 'name' => 'required',
                 'start_time' => 'required|date',
                 'end_time' => 'required|date',
                 'content' => 'required',
             ]);

             //Vérifier si la validation a échoué
             if ($validator->fails()) {
                 return redirect()->back()->withErrors($validator)->withInput();
             }

             if ($request->start_time >= $request->end_time) {
                 return redirect()->back()->with('error', 'La date de début doit être inférieure à la date de fin');
             }

             $id = $request->id;

             // Récupérer le projet existant
             $project = Project::findOrFail($id);
             $project->name = $request->name;
             $project->start_time = $request->start_time;
             $project->end_time = $request->end_time;
             $project->content = $request->content;

             $project->save();

             return redirect()->back()->with('success', "Projet mis à jour !");
         } catch (Exception $e) {
             return redirect()->back()->with('error', $e->getMessage());
         }
     }


    //SUPPRESSION D'UN PROJET
    public function delete($token)
    {
        $project = Project::where('token', $token)->first();

        if(!$project)
        {
            return redirect()->back()->with('error', 'Projet introuvable');
        }

        $project->delete();
        return redirect()->back()->with('success', 'Projet supprimé');
    }
}
