<?php

namespace App\Http\Controllers\web\managers\tasks;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignation;
use App\Models\User;
use App\Models\Task;
use Exception;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Validator;

class AssignationController extends Controller
{
    public function assign_task()
    {
        $users = User::all(); 
        $assignations = Assignation::join('users', 'assignations.user_id', '=', 'users.id')
            ->join('tasks', 'assignations.task_id', '=', 'tasks.id') 
            ->select('assignations.id', 'tasks.start_time', 'tasks.end_time', 'users.name', 'assignations.status')
            ->get();

        return view('managers.pages.assignation.index', compact('users', 'assignations')); 
    }

    // Fonction permettant d'ajouter une tâche à la base de donnée
    public function assign_add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'task_id' => 'required|exists:tasks,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            do {
                $token = Str::random(12);
            } while (Assignation::where('token', $token)->exists());

            $assignation = new Assignation();
            $assignation->token = $token;
            $assignation->status = $request->status;
            $assignation->user_id = $request->user_id;
            $assignation->task_id = $request->task_id;

            $assignation->save();

            return redirect()->back()->with('success', 'Tâche assignée ajoutée avec succès!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit_assign($id)
    {
        $assignation = Assignation::findOrFail($id);
        return view('managers.pages.assignation.edit', compact('assignation'));
    }

    // Fonction permettant de modifier une tâche
    public function update_assign(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'task_id' => 'required|exists:tasks,id',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $assignation = Assignation::findOrFail($id);
            $assignation->status = $request->status;
            $assignation->user_id = $request->user_id;
            $assignation->task_id = $request->task_id;

            $assignation->save();

            return redirect()->back()->with('success', 'Assignation mise à jour avec succès!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function assign_list()
    {
        $assignations = Assignation::all(); 
        return view('managers.pages.assignation.list', ['assignations' => $assignations]);
    }

    // Fonction permettant de supprimer une assignation
    public function delete_assign($id)
    {
        try {
            $assignation = Assignation::findOrFail($id); 

            $assignation->delete();
            return redirect()->route('assign_list')->with('success', 'Suppression réussie!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
