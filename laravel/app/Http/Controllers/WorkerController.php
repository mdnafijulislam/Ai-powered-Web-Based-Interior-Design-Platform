<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\WorkerPortfolio;

class WorkerController extends Controller
{
    /* ================= DASHBOARD ================= */
    public function dashboard()
    {
        return view('worker.dashboard', ['user' => Auth::user()]);
    }

    /* ================= PROFILE ================= */
    public function profile()
    {
        return view('worker.profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo && file_exists(public_path('uploads/profile/' . $user->photo))) {
                unlink(public_path('uploads/profile/' . $user->photo));
            }

            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/profile'), $imageName);
            $user->photo = $imageName;
        }

        $user->update($request->only(['name','email','phone','address','bio']));

        return back()->with('success', 'Profile Updated Successfully!');
    }

    /* ================= BOOKINGS ================= */
    public function workerBookings()
    {
        $bookings = Booking::where('worker_id', Auth::id())
            ->with(['client', 'portfolio'])
            ->latest()
            ->get();

        return view('worker.bookings', compact('bookings'));
    }

    /* ================= PORTFOLIO ================= */
    public function portfolio()
    {
        $portfolios = WorkerPortfolio::where('worker_id', Auth::id())
            ->latest()
            ->get();

        return view('worker.portfolio', compact('portfolios'));
    }

    public function storePortfolio(Request $request)
{
    $request->validate([
        'type'        => 'nullable|string',
        'description' => 'nullable|string',
        'image'       => 'nullable|image|max:4096',
    ]);

    $data = [
        'worker_id'   => Auth::id(),
        'type'        => $request->type,
        'description' => $request->description,
    ];

    if ($request->hasFile('image')) {
        $img = $request->file('image');
        $filename = time().'_'.uniqid().'.'.$img->getClientOriginalExtension();
        $img->move(public_path('uploads/portfolio'), $filename);
        $data['image'] = $filename;
    }

    WorkerPortfolio::create($data);

    return redirect()->back()->with('success', 'Portfolio Added Successfully!');
}


    public function portfolioDetails($id)
    {
        $project = WorkerPortfolio::where('worker_id', Auth::id())->findOrFail($id);
        return view('worker.portfolio_details', compact('project'));
    }

    public function editPortfolio($id)
    {
        $project = WorkerPortfolio::where('worker_id', Auth::id())->findOrFail($id);
        return view('worker.portfolio_edit', compact('project'));
    }

    public function updatePortfolio(Request $request, $id)
    {
        $project = WorkerPortfolio::where('worker_id', Auth::id())->findOrFail($id);

        $project->update($request->only(['type','description']));

        if ($request->hasFile('image')) {
            if ($project->image && file_exists(public_path('uploads/portfolio/'.$project->image))) {
                unlink(public_path('uploads/portfolio/'.$project->image));
            }

            $img = $request->file('image');
            $filename = time().'_'.uniqid().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('uploads/portfolio'), $filename);
            $project->image = $filename;
            $project->save();
        }

        return redirect()->route('worker.portfolio.details', $project->id)
            ->with('success', 'Portfolio Updated Successfully!');
    }

    public function deletePortfolio($id)
    {
        $project = WorkerPortfolio::where('worker_id', Auth::id())->findOrFail($id);

        if ($project->image && file_exists(public_path('uploads/portfolio/'.$project->image))) {
            unlink(public_path('uploads/portfolio/'.$project->image));
        }

        $project->delete();

        return redirect()->route('worker.portfolio')
            ->with('success', 'Portfolio Deleted Successfully!');
    }
}
