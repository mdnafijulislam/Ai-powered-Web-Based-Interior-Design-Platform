@extends('layouts.main')

@section('title', $project->title)

@section('content')
<div class="container" style="max-width:900px;margin:auto;padding:40px;">
    <img src="{{ $project->image_url }}" style="width:100%;border-radius:12px;height:360px;object-fit:cover;">
    <h1 style="margin-top:18px;">{{ $project->title }}</h1>
    <p><strong>By:</strong> {{ $project->worker?->name }}</p>
    <p><strong>Location:</strong> {{ $project->location }}</p>
    <p><strong>Type:</strong> {{ $project->type }}</p>
    <h3>Description</h3>
    <p>{{ $project->description }}</p>

    @auth
    <a href="{{ route('booking.create', ['worker' => $project->worker_id, 'portfolio' => $project->id]) }}" class="btn" style="background:#0b74de;color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;">Book this worker</a>
    @else
    <a href="{{ route('login') }}" class="btn" style="background:#0b74de;color:#fff;padding:10px 14px;border-radius:8px;text-decoration:none;">Login to Book</a>
    @endauth
</div>
@endsection
