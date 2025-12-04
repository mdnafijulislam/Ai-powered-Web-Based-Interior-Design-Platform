@extends('layouts.main')

@section('title','My Bookings')

@section('content')
<div class="container" style="max-width:1000px;margin:auto;padding:40px;">
    <h2>My Bookings</h2>

    @foreach($bookings as $b)
        <div style="padding:18px;border-radius:8px;background:#fff;box-shadow:0 4px 12px rgba(0,0,0,0.04);margin-bottom:12px;">
            <p><strong>Designer:</strong> {{ $b->worker?->name }}</p>
            <p><strong>Project:</strong> {{ $b->portfolio?->title ?? '—' }}</p>
            <p><strong>Date:</strong> {{ $b->preferred_date ?? 'N/A' }}</p>
            <p><strong>Budget:</strong> {{ $b->budget ?? '—' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($b->status) }}</p>
        </div>
    @endforeach
</div>
@endsection
