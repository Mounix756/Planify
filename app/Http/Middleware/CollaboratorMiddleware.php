<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CollaboratorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //SI L'UTILISATEUR EST BIEN CONNECTER A TRAVER LE GUARD 'collaborator', ALORS CONTINUER SA REQUETE
        if(Auth::guard('collaborator')->check())
        {
            return $next($request);
        }

        //SINON PRESENTER LA PAGE DE CONNEXION DES COLLABORATEURS
        return redirect()->route('collaborator_signin');
    }
}
