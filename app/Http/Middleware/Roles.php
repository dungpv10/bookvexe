<?php

namespace App\Http\Middleware;

use Gate;
use Closure;
use Illuminate\Contracts\Auth\Guard;

class Roles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
        $userRoles = auth()->user()->role->module_ids_as_array;
        $check = [];
        foreach($roles as $role){
            $check[] = in_array($role, $userRoles);
        }

        if(in_array(true, $check)){
            return $next($request);
        }

        return response()->view('errors.401', [], 401);
    }
}
