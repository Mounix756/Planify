<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if(! $request->expectsJson())
        {
            return route($this->getRedirectRoute($request));
        }
    }
    //protected function redirectTo(Request $request): ?string
    //{
     //   return $request->expectsJson() ? null : route('login');
    //}

    protected function getRedirectRoute($request)
    {
        if($request->expectsJson())
        {
            return null;
        }

        if($request->is('manager*'))
        {
            return 'manager_signin';
        }
        elseif($request->is('collaborator'))
        {
            return 'collaborator_signin';
        }
        else
        {
            return '404';
        }
    }
}
