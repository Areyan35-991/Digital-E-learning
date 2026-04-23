<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string|null  ...$guards
     */
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                $user = Auth::guard($guard)->user();
                
                // Redirect based on user role
                if ($user->role === 'admin') {
                    return redirect()->route('admin.dashboard');
                } 
                elseif ($user->role === 'teacher') {
                    return redirect()->route('teacher.dashboard');
                } 
                else {
                    // Default for students or if role is not set
                    return redirect()->route('student.dashboard');
                }
            }
        }

        return $next($request);
    }
}