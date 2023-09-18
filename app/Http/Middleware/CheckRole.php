<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role_name)
    {
        if (!$request->user() || !$request->user()->hasRole($role_name)) {
            abort(403, 'Unauthorized');
        }


        return $next($request);
    }
}
