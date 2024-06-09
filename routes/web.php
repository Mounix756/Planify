<?php

use App\Http\Controllers\web\errors\Error404Controller;
use App\Http\Controllers\web\managers\auths\ManagerRegisterController;
use App\Http\Controllers\web\managers\auths\ManagerLoginController;
use App\Http\Controllers\web\managers\home\ManagerHomeController;
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
});














Route::get('/collaborator/signin',[ManagerLoginController::class, 'index'])->name('collaborator_signin');
