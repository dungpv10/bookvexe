<?php

namespace App\Http\Middleware;

use Closure;

class IsManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $managers = [
            'root','admin','staff'
        ];
        $roleName = auth()->user()->role->name;

        if(!in_array($roleName, $managers)){
            abort(403, 'Permission denied');
        }
        return $next($request);
    }
}
