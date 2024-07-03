<?php

use App\Http\Controllers\web\collaborators\auths\CollaboratorLoginController;
use App\Http\Controllers\web\collaborators\auths\CollaboratorRegisterController;
use App\Http\Controllers\web\collaborators\home\CollaboratorHomeController;
use App\Http\Controllers\web\collaborators\meets\CollaboratorMeetController;
use App\Http\Controllers\web\collaborators\taches\TachesCollaboratorController;
use App\Http\Controllers\web\collaborators\users\MesCollaboratotorController;
use App\Http\Controllers\web\errors\Error404Controller;
use App\Http\Controllers\web\managers\assignations\AssignationController;
use App\Http\Controllers\web\managers\auths\ManagerRegisterController;
use App\Http\Controllers\web\managers\auths\ManagerLoginController;
use App\Http\Controllers\web\managers\home\ManagerHomeController;
use App\Http\Controllers\web\managers\meets\ManagerMeetsController;
use App\Http\Controllers\web\managers\members\MemberController;
use App\Http\Controllers\web\managers\projects\ManagersProjectsController;
use App\Http\Controllers\web\managers\tasks\ManagersTasksController;
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





Route::get('/manager/list/active/token={token}',[MemberController::class, 'active'])->name('manager_account_active');

//ROUTE DONC L'ACCÈS NECCESSITE UNE AUTHENTICATION EN TANT QUE MANAGER
Route::middleware(['web', 'auth:manager'])->group(function(){
    //PAGE D'ACCUEIL POUR LE MANAGER
    Route::get('/manager/home',[ManagerHomeController::class, 'index'])->name('manager_home');
    Route::get('/collaborators/list',[MemberController::class, 'collaborator'])->name('collaborator_list');
    Route::get('/manager/list',[MemberController::class, 'manager'])->name('manager_list');
    Route::get('/manager/list/delete/token={token}',[MemberController::class, 'delete'])->name('manager_account_delete');





    //ROUTE QUI CONCERNE LES PROJETS
    Route::get('/manager/projects/list',[ManagersProjectsController::class, 'index'])->name('manager_project_add_form');
    Route::get('/manager/1projects/list',[ManagersProjectsController::class, 'list'])->name('manager_project_list');
    Route::post('/manager/new/project',[ManagersProjectsController::class, 'store'])->name('manager_add_new_project');
    Route::get('/manager/projects/delete/token={token}',[ManagersProjectsController::class, 'delete'])->name('manager_project_delete');
    Route::post('/manager/update/project',[ManagersProjectsController::class, 'update'])->name('update_project');


    //ROUTE QUI CONCERNE LES TACHES
    Route::post('/manager/new/task',[ManagersTasksController::class, 'store'])->name('manager_add_new_task');
    Route::get('/manager/task/delete/token={token}',[ManagersTasksController::class, 'delete'])->name('manager_task_delete');
    Route::get('/manager/task/view/token={token}',[ManagersTasksController::class, 'view'])->name('manager_task_view');
    Route::post('/manager/update/task',[ManagersProjectsController::class, 'update'])->name('update_task');


    //ROUTES QUI CONCERNE LES ASSIGNATIONS
    Route::post('/manager/new/assign',[AssignationController::class, 'store'])->name('manager_add_new_assign');
    Route::get('/manager/assign/delete/{token}', [AssignationController::class, 'delete'])->name('manager_assign_delete');
    Route::post('/manager/update/assign/{id}',[AssignationController::class, 'update'])->name('update_assign');
    Route::get('/manager/assign/view',[AssignationController::class, 'view'])->name('manager_assign_list');



    //ROUTE QUI CONCERNE LES REUNIONS
    Route::get('/manager/meeting/list',[ManagerMeetsController::class, 'index'])->name('manager_meets_list');
    Route::post('/manager/new/meet',[ManagerMeetsController::class, 'store'])->name('manager_add_new_meet');
    Route::get('/manager/meet/delete/token={token}',[ManagerMeetsController::class, 'delete'])->name('manager_meet_delete');
    Route::get('/manager/show/meet={token}',[ManagerMeetsController::class, 'show'])->name('manager_show_meet');
    Route::post('/manager/meet/assign',[ManagerMeetsController::class, 'invite'])->name('manager_invite_collaborator');
    Route::get('/manager/meet/notification/token={token}',[ManagerMeetsController::class, 'sendEmail'])->name('manager_send_meet_notification');

});














Route::get('/collaborator/signin',[CollaboratorLoginController::class, 'index'])->name('collaborator_signin');
Route::get('/collaborator/signup',[CollaboratorRegisterController::class, 'index'])->name('collaborator_signup');
Route::post('/collaborator/signup-success',[CollaboratorRegisterController::class, 'store'])->name('collaborator_signup_success');
//Route::get('/collaborator/identification={token}', [CollaboratorLoginController::class, 'validateToken'])->name('validate_token');
Route::post('/collaborator/signin-success',[CollaboratorLoginController::class, 'login'])->name('collaborator_signin_success');


Route::middleware('collaborator')->group(function(){
    //PAGE D'ACCUEIL POUR LE COLLABORATOR
    Route::get('/collaborator/home',[CollaboratorHomeController::class, 'index'])->name('collaborator_home');

    //PAGES AFFICHANTS SES TACHES
    Route::get('/collaborator/tasks', [TachesCollaboratorController::class, 'Collaborator_task'])->name('collaborator_tasks');
    Route::get('/collaborator/mark/tasks/as/finish={token}', [TachesCollaboratorController::class, 'mark'])->name('collaborator_mark_tasks');

    //LISTER SES COLLABORATEURS
    Route::get('/mes/collaborators',[MesCollaboratotorController::class, 'index'])->name('my_collaborator');

    //LES REUNIONS DE L'UTILISATEUR
    Route::get('/my/meets',[CollaboratorMeetController::class, 'index'])->name('my_meet');
    Route::get('/meet/show-more/token={token}',[CollaboratorMeetController::class, 'show'])->name('meet_show_more');

    Route::get('/member', [MemberController::class, 'index'])->name('planify_member');

});
