<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ManagerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //VERIFIER QUE L'UTILISATEUR EST BIEN UN MANAGER
        if($request->user() && $request->user()->isManager())
        {
            return $next($request);
        }

        return redirect()->route('manager_signin');
    }
}
