<?php

use App\Http\Controllers\web\collaborators\auths\CollaboratorLoginController;
use App\Http\Controllers\web\collaborators\auths\CollaboratorRegisterController;
use App\Http\Controllers\web\collaborators\home\CollaboratorHomeController;
use App\Http\Controllers\web\errors\Error404Controller;
use App\Http\Controllers\web\managers\auths\ManagerRegisterController;
use App\Http\Controllers\web\managers\auths\ManagerLoginController;
use App\Http\Controllers\web\managers\home\ManagerHomeController;
use App\Http\Controllers\web\managers\projects\ProjectController;
use App\Http\Controllers\web\managers\tasks\TaskController;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/404',[Error404Controller::class, 'index'])->name('404');
Route::get('/manager/signup',[ManagerRegisterController::class, 'index'])->name('manager_signup');
Route::post('/manager/signup-success',[ManagerRegisterController::class, 'store'])->name('manager_signup_success');
Route::get('/identification={token}', [ManagerRegisterController::class, 'validateToken'])->name('validate_token');
Route::get('/manager/home',[ManagerRegisterController::class, 'index'])->name('manager_home');
Route::get('/manager/signin',[ManagerLoginController::class, 'index'])->name('manager_signin');
Route::post('/manager/signin-success',[ManagerLoginController::class, 'login'])->name('manager_signin_success');






//ROUTE DONC L'ACCÈS NECCESSITE UNE AUTHENTICATION EN TANT QUE MANAGER
Route::middleware(['web', 'auth:manager'])->group(function(){
    //PAGE D'ACCUEIL POUR LE MANAGER
    Route::get('/manager/home',[ManagerHomeController::class, 'index'])->name('manager_home');
    Route::get('/manager/projects-list', [ProjectController::class, 'project_list'])->name('project_list');
    Route::get('/search-projects', [ProjectController::class, 'search_projects'])->name('search_projects');
    Route::get('/manager/create-project',[ProjectController::class, 'create_project'])->name('create_project');
    Route::post('/manager/add-project',[ProjectController::class, 'project_add'])->name('project_add');
    Route::match(['get', 'post'], 'manager/project-edit/{token}', [ProjectController::class, 'editer_project'])->name('editer_project');
    Route::match(['get', 'post'], 'manager/project-update', [ProjectController::class, 'update_project'])->name('update_project');
    Route::match(['get', 'post'], 'manager/project-delete/{token}', [ProjectController::class, 'delete_project'])->name('delete_project');

    Route::get('/manager/tasks-list', [TaskController::class, 'task_list'])->name('task_list');
    Route::get('/search-tasks', [TaskController::class, 'search_tasks'])->name('search_tasks');
    Route::get('/manager/create-task',[TaskController::class, 'create_task'])->name('create_task');
    Route::post('/manager/add-task',[TaskController::class, 'task_add'])->name('task_add');
    Route::match(['get', 'post'], 'manager/task-edit/{token}', [TaskController::class, 'editer_task'])->name('editer_task');
    Route::match(['get', 'post'], 'manager/task-update', [TaskController::class, 'update_task'])->name('update_task');
    Route::match(['get', 'post'], 'manager/task-delete/{token}', [TaskController::class, 'delete_task'])->name('delete_task');


});














Route::get('/collaborator/signin',[CollaboratorLoginController::class, 'index'])->name('collaborator_signin');
Route::get('/collaborator/signup',[CollaboratorRegisterController::class, 'index'])->name('collaborator_signup');
Route::post('/collaborator/signup-success',[CollaboratorRegisterController::class, 'store'])->name('collaborator_signup_success');
//Route::get('/collaborator/identification={token}', [CollaboratorLoginController::class, 'validateToken'])->name('validate_token');
Route::post('/collaborator/signin-success',[CollaboratorLoginController::class, 'login'])->name('collaborator_signin_success');


Route::middleware('collaborator')->group(function(){
    //PAGE D'ACCUEIL POUR LE COLLABORATOR
    Route::get('/collaborator/home',[CollaboratorHomeController::class, 'index'])->name('collaborator_home');
});
