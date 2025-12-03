<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\WorkerPortfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /* ------------------------------------------------------
     |  CLIENT: Show booking form (worker + optional portfolio)
     -------------------------------------------------------*/
    public function create($worker_id, $portfolio_id = null)
    {
        $portfolio = null;

        if ($portfolio_id) {
            $portfolio = WorkerPortfolio::with('worker')->findOrFail($portfolio_id);
        }

        return view('booking.create', compact('worker_id', 'portfolio'));
    }

    /* ------------------------------------------------------
     |  CLIENT: Store booking request
     -------------------------------------------------------*/
    public function store(Request $request)
    {
        $request->validate([
            'worker_id'      => 'required|exists:users,id',
            'portfolio_id'   => 'nullable|exists:worker_portfolios,id',
            'preferred_date' => 'nullable|date',
            'message'        => 'nullable|string',
            'budget'         => 'nullable|numeric'
        ]);

        Booking::create([
            'client_id'     => Auth::id(),
            'worker_id'     => $request->worker_id,
            'portfolio_id'  => $request->portfolio_id,
            'preferred_date'=> $request->preferred_date,
            'message'       => $request->message,
            'budget'        => $request->budget,
            'status'        => 'pending'
        ]);

        return redirect()->route('client.bookings')
            ->with('success', 'Booking request sent successfully!');
    }

    /* ------------------------------------------------------
     | CLIENT: Show my bookings
     -------------------------------------------------------*/
    public function myBookings()
    {
        $bookings = Booking::where('client_id', Auth::id())
            ->with('worker','portfolio')
            ->latest()
            ->get();

        return view('client.bookings', compact('bookings'));
    }

    /* ------------------------------------------------------
     | WORKER: Show all bookings coming from clients
     -------------------------------------------------------*/
    public function workerBookings()
    {
        $bookings = Booking::where('worker_id', Auth::id())
            ->with('client', 'portfolio')
            ->latest()
            ->get();

        return view('worker.bookings', compact('bookings'));
    }

    /* ------------------------------------------------------
     | WORKER: Accept booking
     -------------------------------------------------------*/
    public function accept($id)
    {
        $booking = Booking::where('worker_id', Auth::id())->findOrFail($id);
        $booking->status = 'accepted';
        $booking->save();

        return redirect()->back()->with('success', 'Booking accepted!');
    }

    /* ------------------------------------------------------
     | WORKER: Reject booking
     -------------------------------------------------------*/
    public function reject($id)
    {
        $booking = Booking::where('worker_id', Auth::id())->findOrFail($id);
        $booking->status = 'rejected';
        $booking->save();

        return redirect()->back()->with('success', 'Booking rejected!');
    }
}
