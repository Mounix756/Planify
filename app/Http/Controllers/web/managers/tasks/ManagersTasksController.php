<?php

namespace App\Http\Controllers\web\managers\tasks;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Exception;

class ManagersTasksController extends Controller
{
    //ENREGISTRER UNE TACHE DANS LA BASE DE DONNÉES
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

            $task = new Task();
            $task->name = $request->name;
            $task->start_time = $request->start_time;
            $task->end_time = $request->end_time;
            $task->user_id = $request->user_id;
            $task->project_id = $request->project_id;
            $task->content = $request->content;
            $task->status = 0;

            //ICI ON GENERE UN TOKEN DE FACON ALEATOIRE CONTENANT 12 CARACTERES
            //ON PASSE LE TOKEN DANS UNE BOUCLE DO WHILE POUR L'EXISTANCE DU TOKEN DANS LA TABLE PROJECTS
            //NB: SELON MA LOGIQUE, LE TOKEN DOIT ETRE UNIQUE
            do {
                $token = Str::random(12);
            }
            while (Task::where('token', $token)->exists());

            $task->token = $token;
            $task->save();

            return redirect()->back()->with('success', "Tâche ajouté !");

        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



    //SUPPRESSION D'UNE TACHE
    public function delete($token)
    {
        $task = Task::where('token', $token)->first();

        if(!$task)
        {
            return redirect()->back()->with('error', 'Tache introuvable');
        }

        $task->delete();
        return redirect()->back()->with('success', 'Tâche supprimé');
    }


    //VOIR LA LISTE DES TACHES D'UN PRODUIT
    public function view($token)
    {
        $project = Project::where('token', $token)->first();
        $project_id = $project->id;

        if(!$project)
        {
            return redirect()->back()->with('error', 'Projet introuvable');
        }

        
        $tasks = Task::where('project_id', $project->id)->get();

        return view('managers.pages.tasks.list', compact('tasks', 'project'));
    }
}
