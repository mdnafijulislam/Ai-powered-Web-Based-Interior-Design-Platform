<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\WorkerPortfolio;
use Illuminate\Support\Str;

class WorkerController extends Controller
{
    /* ================================================================
     |  WORKER DASHBOARD
     ================================================================= */
    public function dashboard()
    {
        $user = Auth::user();
        return view('worker.dashboard', compact('user'));
    }


    /* ================================================================
     |  PROFILE PAGE
     ================================================================= */
    public function profile()
    {
        $user = Auth::user();
        return view('worker.profile', compact('user'));
    }


    /* ================================================================
     |  PROFILE UPDATE
     ================================================================= */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

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




    /* ================================================================
     |  🚀 PORTFOLIO SECTION (Dynamic)
     ================================================================= */

    // ===========================
    //  PORTFOLIO LIST PAGE
    // ===========================
    public function portfolio()
    {
        $portfolios = WorkerPortfolio::where('worker_id', Auth::id())
            ->latest()
            ->get();

        return view('worker.portfolio', compact('portfolios'));
    }


    // ===========================
    //  SAVE NEW PORTFOLIO PROJECT
    // ===========================
    public function storePortfolio(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'location'    => 'nullable|string',
            'type'        => 'nullable|string',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|max:4096',
        ]);

        $data = $request->only(['title','location','type','description']);
        $data['worker_id'] = Auth::id();

        // Image Upload
        if ($request->hasFile('image')) {

            $img = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('uploads/portfolio'), $filename);

            $data['image'] = $filename;
        }

        WorkerPortfolio::create($data);

        return redirect()->back()->with('success', 'Portfolio Added Successfully!');
    }


    // ===========================
    //  PORTFOLIO DETAILS PAGE
    // ===========================
    public function portfolioDetails($id)
    {
        $project = WorkerPortfolio::where('worker_id', Auth::id())->findOrFail($id);

        return view('worker.portfolio_details', compact('project'));
    }




    /* ================================================================
     |  OTHER PAGES (LifeCycle / Orders / Ratings)
     ================================================================= */

    public function lifeCycle()
    {
        $user = Auth::user();
        $joined = $user->created_at;
        $age = $joined->diffForHumans();

        return view('worker.lifecycle', compact('user', 'joined', 'age'));
    }


    public function orders()
    {
        return view('worker.orders');
    }


    public function ratings()
    {
        return view('worker.ratings');
    }
}
