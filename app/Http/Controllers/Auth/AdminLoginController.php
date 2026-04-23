<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
   
      public function showLoginForm()
    {
        \Log::info('AdminLoginController::showLoginForm method called');
        
        // Add this debug line to see what's happening
        try {
            $view = view('admin.auth.login');
            \Log::info('View created successfully');
            return $view;
        } catch (\Exception $e) {
            \Log::error('View error: ' . $e->getMessage());
            return response()->view('errors.500', [], 500);
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        if (Auth::guard('admin')->attempt([
            'email' => $request->email,
            'password' => $request->password
        ], $request->remember)) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/auth/login');
    }
}