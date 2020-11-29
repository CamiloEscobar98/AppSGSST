<?php

namespace App\Http\Middleware;

use Closure;

class checkRoute
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        $roles = explode('_', $role);
        if ($request->user()->hasAnyRoleSession($roles)) {
            return $next($request);
        }
        return redirect()->route('home');
    }
}
