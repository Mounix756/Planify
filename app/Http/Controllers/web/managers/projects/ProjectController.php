<?php

namespace App\Http\Controllers\web\managers\projects;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\User;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Validator;

class ProjectController extends Controller
{
    //Fonction affichant le formulaire d'ajout de projet
    public function create_project()
    {
        return view('managers.pages.projects.index');
    }
    
    //Fonction permettant d'ajouter un projet à la base de donnée
    public function project_add(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
               'start_time' => 'required|date',
               'end_time' => 'required|date|after_or_equal:start_time',
            ]);
    
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            do {
                $token = Str::random(12);
            }
            while (Project::where('token', $token)->exists());
    
            $project = new Project();
            $project->name = $request->name;
            $project->start_time = $request->start_time;
            $project->end_time = $request->end_time;
            $project->content = $request->content;
            $project->token = $token;
            $project->user_id = $request->user_id; 
    
            $project->save();
    
            return redirect()->back()->with('success', 'Project added successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    //Fonction affichant la liste des projets
    public function project_list()
    {
        $project = Project::all(); // Suppose que vous récupérez tous les projets depuis la base de données
        return view('managers.pages.projects.list', ['projects' => $project]);
    }

    //Fonction pour rechercher un element dans le tableau
    public function search_projects(Request $request)
{
    $search = $request->input('search');
    $project = Project::where('name', 'like', '%'.$search.'%')->get();

    return view('managers.pages.projects.list', ['projects' => $project]);
}

    //Fonction qui permet d'éditer le contenu d'une actualité
    public function edit_project($id)
    {
        $project = Project::find($id);
    
        if (!$project) {
            return redirect()->route('project_list')->with('error', 'Projet non trouvé.');
        }
    
        return view('managers.pages.projects.edit', compact('project'));
    }
    
    //Fonction permettant de modifier un projet
    public function update_project(Request $request, $project)
    {
        try {
            $project = Project::find($request->id);

            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'start_time' => 'required|date',
            'end_time' => 'required|date|after_or_equal:start_time',
            ]);

            $project = new Project();
            $project->name = $request->name;
            $project->start_time = $request->start_time;
            $project->end_time = $request->end_time;
            $project->content = $request->content;

            $project->save();
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    

    //Fonction permettant de supprimer un projet
    public function delete_project($id)
    {
        try {
            $project = Project::find($id);
            
            $project->delete();
            return redirect()->route('project_list')->with('success', 'Suppression réussie!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
