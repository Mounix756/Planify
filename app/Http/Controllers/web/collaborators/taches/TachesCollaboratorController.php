<?php

namespace App\Http\Controllers\web\collaborators\taches;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assignment;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;


class TachesCollaboratorController extends Controller
{
   // Fonction permettant d'afficher les taches d'un UTILISATEUR
   public function Collaborator_task()
   {
       try 
       {
        if(Auth::guard('collaborator')->check())
        {
            $userId = Auth::guard('collaborator')->id();

            // Récupérer les assignments pour ce collaborateur avec les relations task et project
           $assignments = Assignment::join('tasks', 'assignments.task_id', '=', 'tasks.id')
           ->join('projects', 'projects.id', '=', 'tasks.project_id')
           ->select('tasks.*', 'projects.name as projet')
            ->where('assignments.user_id', $userId)
                ->get();

            return view('collaborators.pages.taches.list', compact('assignments'));
        }
        else
        {
            return redirect()->back()->with('error', "Utilisateur non connecté");
        }
       } 
       catch (Exception $e) {
        dd($e->getMessage());
           //return redirect()->back()->with('error', $e->getMessage());
       }
   }
}
