<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {

        if (!$request->user()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userRoles = $request->user()->roles->pluck('name')->toArray();
        $roles = explode('|', $roles);

        if (empty(array_intersect($roles, $userRoles))) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
