<?php

namespace App\Http\Controllers\web\managers\assignations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Task;
use Exception;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Validator;

class AssignationController extends Controller
{

    // Fonction permettant d'assigner une tache à un collaborateur
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'task_id' => 'required|array',
                'task_id.*' => 'exists:tasks,id',
                'collaborator_id' => 'required|array',
                'collaborator_id.*' => 'exists:users,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            foreach ($request->collaborator_id as $collaborator_id)
            {
                foreach ($request->task_id as $task_id)
                {
                    $assignment = new Assignment();
                    $assignment->user_id = $collaborator_id;
                    $assignment->task_id = $task_id;


                    do {
                        $token = Str::random(12);
                    } while (Assignment::where('token', $token)->exists());

                    $assignment->token = $token;
                    $assignment->save();
                }
            }

            return redirect()->back()->with('success', 'Tâches assignées ajoutées avec succès!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


  // Fonction permettant de modifier une tâche
public function update(Request $request, $id)
{
    try {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'task_id' => 'required|exists:tasks,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $assignment = Assignment::findOrFail($id);


        $assignment->user_id = $request->user_id;
        $assignment->task_id = $request->task_id;

        $assignment->save();

        return redirect()->back()->with('success', 'Assignation mise à jour avec succès!');
    } catch (Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}


    // Fonction permettant de supprimer une assignation
public function delete($token)
{
    try {
        // Chercher l'assignation par son token
        $assignment = Assignment::where('token', $token)->first();

        if (!$assignment) {
            return redirect()->back()->with('error', 'Assignation introuvable');
        }

        // Supprimer l'assignation
        $assignment->delete();

        return redirect()->back()->with('success', 'Assignation supprimée avec succès');
    } catch (\Exception $e) {
        // Capturer toute exception survenue lors de la suppression
        return redirect()->back()->with('error', 'Une erreur est survenue lors de la suppression : ' . $e->getMessage());
    }
}



    //AFFICHER LA LISTE DE ASSIGNATIONS
    public function view()
    {
        // Récupérer toutes les assignations avec les utilisateurs et les tâches associées
        $assignments = Assignment::join('users', 'assignments.user_id', '=', 'users.id')
            ->join('tasks', 'assignments.task_id', '=', 'tasks.id')
            ->select('assignments.id', 'users.name as user_name', 'tasks.name','tasks.status', 'tasks.start_time', 'tasks.end_time')
            ->get();
        $users = User::all();


        $tasks = Task::all();

        return view('managers.pages.assignations.list', compact('assignments', 'users', 'tasks'));
    }
}
