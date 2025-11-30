<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register form submit
    public function register(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:4',
            'role'     => 'required|in:client,worker'
        ]);

        // Save to database
        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),  // Password Hash
            'role'     => $request->role
        ]);

        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please login.');
    }

    // Show Login Page
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login form submit
    public function login(Request $request)
    {
        // Validate login fields
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        // Attempt login
        if (Auth::attempt([
            'email'    => $request->email,
            'password' => $request->password
        ])) {
            $user = Auth::user();

            // ROLE BASED REDIRECT
            if ($user->role === 'client') {
                return redirect()->route('client.dashboard');
            }

            if ($user->role === 'worker') {
                return redirect()->route('worker.dashboard'); 
            }
        }

        return back()->with('error', 'Invalid email or password.');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
