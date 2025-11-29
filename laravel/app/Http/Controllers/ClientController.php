<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    // ---------- CLIENT DASHBOARD ----------
    public function dashboard()
    {
        return view('client.dashboard');
    }

    // ---------- SHOW PROFILE PAGE ----------
    public function profile()
    {
        $user = Auth::user(); // logged-in user
        return view('client.profile', compact('user'));
    }

    // ---------- UPDATE PROFILE ----------
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validation
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'bio'     => 'nullable|string',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Update basic data
        $user->name    = $request->name;
        $user->phone   = $request->phone;
        $user->address = $request->address;
        $user->bio     = $request->bio;

        // ---------- PHOTO UPLOAD ----------
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $filename);
            $user->photo = $filename;
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
