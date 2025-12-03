@extends('layouts.main')

@section('title', $project->title)

@section('content')

<style>
.details-wrapper { max-width:1100px; margin:auto; padding:40px; }
.main-img { width:100%; height:420px; object-fit:cover; border-radius:12px; }
.info-box { background:white; padding:25px; border-radius:12px; margin-top:20px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08); }
.section-title { font-size:28px; margin:25px 0 15px; font-weight:700; }
</style>

<div class="details-wrapper">

    {{-- MAIN IMAGE --}}
    <img src="{{ $project->image_url }}" class="main-img">

    {{-- PROJECT INFO --}}
    <div class="info-box">
        <h1>{{ $project->title }}</h1>

        <p><strong>📍 Location:</strong> {{ $project->location }}</p>
        <p><strong>📌 Type:</strong> {{ $project->type }}</p>

        <h3 class="section-title">📝 Project Description</h3>
        <p>{{ $project->description }}</p>

        <a href="{{ route('worker.portfolio') }}" class="btn" style="margin-top:25px;">⬅ Back to Portfolio</a>
    </div>
</div>

@endsection
