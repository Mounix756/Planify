<?php

namespace App\Http\Controllers\web\managers\tasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\task;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    
    //Fonction affichant le formulaire d'ajout de taches
    public function create_task()
    {
        $projects = Project::all();
        return view('managers.pages.tasks.index', compact('projects'));
    }

    //Fonction permettant d'ajouter un taches à la base de donnée
    public function task_add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'project_id' => 'required|exists:projects,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            do {
                $token = Str::random(12);
            }
            while (Task::where('token', $token)->exists());

            $task = new Task();
            $task->name = $request->name;
            $task->start_time = $request->start_time;
            $task->end_time = $request->end_time;
            $task->token = $token;
            $task->user_id = $request->user_id;
            $task->project_id = $request->project_id; 

            $task->save();

            return redirect()->back()->with('success', 'Tache ajouter avec succes!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Fonction affichant la liste des taches
    public function task_list()
    {
        $task = Task::all(); 
        return view('managers.pages.tasks.list', ['tasks' => $task]);
    }

    //Fonction pour rechercher un element dans le tableau
    public function search_tasks(Request $request)
{
    $search = $request->input('search');
    $task = Task::where('name', 'like', '%'.$search.'%')->get();

    return view('managers.pages.tasks.list', ['tasks' => $task]);
}

    //Fonction qui permet d'éditer le contenu d'une tache
    public function editer_task($id)
    {
        $task = Task::findOrFail($id);
        $projects = Project::all();
        return view('tasks.edit', compact('task', 'projects'));
    }


    //Fonction permettant de modifier un taches
    public function update_task(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
                'project_id' => 'required|exists:projects,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $task = Task::findOrFail($id);
            $task->name = $request->name;
            $task->start_time = $request->start_time;
            $task->end_time = $request->end_time;
            $task->project_id = $request->project_id; 

            $task->save();

            return redirect()->back()->with('success', 'Task updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    //Fonction permettant de supprimer une taches
    public function delete_task($id)
    {
        try {
            $task = Task::find($id);
            
            $task->delete();
            return redirect()->route('task_list')->with('success', 'Suppression réussie!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
