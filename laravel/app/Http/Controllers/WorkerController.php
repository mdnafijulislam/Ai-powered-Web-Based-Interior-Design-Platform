<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    // ===========================
    //  WORKER DASHBOARD
    // ===========================
    public function dashboard()
    {
        return view('worker.dashboard');
    }

    // ===========================
    //  PROFILE PAGE
    // ===========================
    public function profile()
    {
        $user = Auth::user();
        return view('worker.profile', compact('user'));
    }

    // ===========================
    //  PROFILE UPDATE
    // ===========================
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        // Validate
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        // Profile Photo Upload
        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $imageName);
            $user->photo = $imageName;
        }

        // Update fields
        $user->name    = $request->name;
        $user->email   = $request->email;
        $user->phone   = $request->phone;
        $user->address = $request->address;
        $user->bio     = $request->bio;

        $user->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

    // ===========================
    //  PORTFOLIO PAGE
    // ===========================
    public function portfolio()
    {
        return view('worker.portfolio');
    }


    // ===========================
    //  LIFE CYCLE PAGE (NEW)
    // ===========================
    public function lifeCycle()
    {
        $user = Auth::user();

        $joined = $user->created_at;               // account creation date
        $age = $joined->diffForHumans();           // human readable age

        return view('worker.lifecycle', compact('user', 'joined', 'age'));
    }
}
