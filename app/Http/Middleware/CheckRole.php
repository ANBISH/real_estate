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
    public function handle(Request $request, Closure $next, $role): Response
    {
        if (!auth()->check()) {
            return response()->json(['message' => 'The user is not authenticated.'], 401);
        }

        // dd(auth()->user()->hasRole($role));

        if (!auth()->user()->hasRole($role)) {
            return response()->json(['message' => 'You do not have the required role.'], 403);
        }

        // dd($request);

        return $next($request);
    }
}
