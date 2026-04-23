<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidateEmailDomain
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->is('register') && $request->isMethod('post')) {
            $email = $request->input('email');
            
            if ($email && !str_ends_with($email, '@diu.edu.bd')) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['email' => 'Only @diu.edu.bd email addresses are allowed.']);
            }
        }

        return $next($request);
    }
}