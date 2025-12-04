@extends('layouts.main')

@section('title','Create Booking')

@section('content')
<div class="container" style="max-width:700px;margin:auto;padding:40px;">

    <h2>Book a Designer</h2>

    {{-- ✅ SUCCESS MESSAGE --}}
    @if(session('success'))
        <div style="
            background:#d1f7d6;
            padding:12px;
            border-left:4px solid #28a745;
            margin-bottom:18px;
            color:#155724;
            border-radius:6px;
            font-size:16px;">
            {{ session('success') }}
        </div>
    @endif

    @if(isset($project) && $project)
        <div style="padding:12px;border-radius:8px;background:#f7f7f7;margin-bottom:12px;">
            <strong>Project:</strong> {{ $project->title }} <br>
            <strong>Designer:</strong> {{ $project->worker?->name }}
        </div>
    @endif

    <form action="{{ route('booking.store') }}" method="POST">
        @csrf
        <input type="hidden" name="worker_id" value="{{ $workerId ?? ($project->worker_id ?? '') }}">
        <input type="hidden" name="portfolio_id" value="{{ $portfolioId ?? ($project->id ?? '') }}">

        <label>Preferred Date</label>
        <input type="date" name="preferred_date" class="form-control" style="margin-bottom:10px;">

        <label>Budget (optional)</label>
        <input type="text" name="budget" class="form-control" style="margin-bottom:10px;">

        <label>Message</label>
        <textarea name="message" rows="5" class="form-control" style="margin-bottom:10px;"></textarea>

        <button class="btn" style="background:#111;color:#fff;padding:10px 14px;border-radius:8px;">
            Send Booking Request
        </button>
    </form>
</div>
@endsection
