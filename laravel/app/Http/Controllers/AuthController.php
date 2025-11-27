<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // Show Register Page
    public function showRegister() {
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

        // Redirect to login with success message
        return redirect()->route('login')
            ->with('success', 'Account created successfully! Please login.');
    }

    // Show Login Page
    public function showLogin() {
        return view('auth.login');
    }
}
