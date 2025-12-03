<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkerPortfolio;

class PortfolioController extends Controller
{
    /**
     * Public: Show list of all worker portfolios (with optional search).
     * Route: GET /portfolio
     * View: resources/views/portfolio/index.blade.php
     */
    public function index(Request $request)
    {
        // Optional search q param
        $q = $request->query('q');

        $query = WorkerPortfolio::query();

        if ($q) {
            $query->where(function ($qbuilder) use ($q) {
                $qbuilder->where('title', 'like', '%' . $q . '%')
                         ->orWhere('location', 'like', '%' . $q . '%')
                         ->orWhere('type', 'like', '%' . $q . '%');
            });
        }

        // latest first, paginate (12 per page)
        $portfolios = $query->latest()->paginate(12)->withQueryString();

        return view('portfolio.index', compact('portfolios', 'q'));
    }

    /**
     * Public: Show a single portfolio detail page.
     * Route: GET /portfolio/{id}
     * View: resources/views/portfolio/show.blade.php
     */
    public function show($id)
    {
        $project = WorkerPortfolio::findOrFail($id);

        // If you store only filename in DB, you can use this in blade:
        // <img src="{{ asset('uploads/portfolio/' . $project->image) }}" ...>
        // If you implemented an accessor like image_url, use $project->image_url

        return view('portfolio.show', compact('project'));
    }
}
