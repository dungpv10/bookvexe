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
    public function handle($request, Closure $next, ... $roles)
    {
        $roleName = auth()->user()->role->name;

        if(in_array($roleName, $roles)){
            return $next($request);
        }

        return response()->view('errors.401', [], 401);
    }
}
