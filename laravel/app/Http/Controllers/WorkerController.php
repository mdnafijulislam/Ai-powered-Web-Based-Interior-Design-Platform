<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class WorkerController extends Controller
{
    // Dashboard
    public function dashboard() {
        return view('worker.dashboard');
    }

    // Profile Page
    public function profile() {
        return view('worker.profile');
    }

    // Profile Update
    public function updateProfile(Request $request) {
        $user = Auth::user();

        $request->validate([
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $image = time().'.'.$request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $image);
            $user->photo = $image;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->bio = $request->bio;

        $user->save();

        return redirect()->back()->with('success', 'Profile Updated Successfully!');
    }

    // Portfolio Page
    public function portfolio() {
        return view('worker.portfolio');
    }
}
