<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Ensure user is logged in
        if (!auth()->check()) {
            return redirect('/login');
        }

        // If user role is in the allowed roles, allow request
        if (in_array(auth()->user()->role, $roles)) {
            return $next($request);
        }

        // Otherwise, redirect to a generic dashboard or deny access
        return redirect('/dashboard')->with('error', 'Unauthorized access');
    }
    
}
