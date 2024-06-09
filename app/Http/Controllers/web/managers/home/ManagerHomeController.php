<?php

namespace App\Http\Controllers\web\managers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagerHomeController extends Controller
{
    //AFFICHER LA PAGE D'ACCUEIL DU DASHBOARD DU MANAGER
    public function index()
    {
        return view('managers.pages.home.home');
    }
}
