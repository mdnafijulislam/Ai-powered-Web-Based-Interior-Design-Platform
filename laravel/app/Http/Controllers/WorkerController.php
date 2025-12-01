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
        $user = Auth::user();  // logged worker info

        return view('worker.dashboard', compact('user'));
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

        // Validation
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        // PHOTO UPLOAD + DELETE OLD IMAGE
        if ($request->hasFile('photo')) {

            if ($user->photo && file_exists(public_path('uploads/profile/' . $user->photo))) {
                unlink(public_path('uploads/profile/' . $user->photo));
            }

            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $imageName);
            $user->photo = $imageName;
        }

        // Update user info
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
    //  LIFE CYCLE PAGE
    // ===========================
    public function lifeCycle()
    {
        $user = Auth::user();

        $joined = $user->created_at;
        $age = $joined->diffForHumans();

        return view('worker.lifecycle', compact('user', 'joined', 'age'));
    }

    // ===========================
    //  ORDER LIST PAGE  (NEW)
    // ===========================
    public function orders()
    {
        return view('worker.orders');
    }
}

