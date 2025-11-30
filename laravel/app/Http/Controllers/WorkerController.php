<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkerController extends Controller
{
    // Worker Dashboard Page
    public function dashboard()
    {
        return view('worker.dashboard');
    }

    // Worker Portfolio Page (Missing method problem FIXED)
    public function portfolio()
    {
        return view('worker.portfolio');
    }
}


