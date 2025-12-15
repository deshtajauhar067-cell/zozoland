<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show the login form
     */
    public function showLogin()
    {
        if (Auth::check() && Auth::user()->is_admin) {
            return redirect()->route('admin.dashboard');
        }
        return view('admin.auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return back()->withErrors([
                'email' => 'Invalid credentials provided.',
            ])->withInput();
        }

        if (!$user->is_admin) {
            return back()->withErrors([
                'email' => 'You do not have admin access.',
            ])->withInput();
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('admin.dashboard')->with('success', 'Login successful!');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('admin.auth.forgot-password');
    }

    /**
     * Handle password reset request
     */
    public function resetPassword(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user->is_admin) {
            return back()->withErrors([
                'email' => 'This account does not have admin access.',
            ]);
        }

        // In production, send a password reset email
        // For now, return a message
        return back()->with('success', 'Password reset link has been sent to your email.');
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
    }
}
