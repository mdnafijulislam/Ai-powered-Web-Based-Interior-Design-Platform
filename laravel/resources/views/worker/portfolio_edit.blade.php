@extends('layouts.main')

@section('title', 'Edit Portfolio')

@section('content')

<style>
.edit-box { max-width: 700px; margin: auto; background:white;
           padding:25px; border-radius:12px;
           box-shadow:0 4px 12px rgba(0,0,0,0.1); }
.btn { background:black; color:white; padding:10px 16px;
       border-radius:8px; text-decoration:none; border:none; }
</style>

<div class="edit-box">

    <h2>Edit Portfolio</h2>

    <form action="{{ route('worker.portfolio.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label>Project Title *</label>
        <input type="text" name="title" class="form-control" value="{{ $project->title }}" required>

        <label style="margin-top:10px;">Location</label>
        <input type="text" name="location" class="form-control" value="{{ $project->location }}">

        <label style="margin-top:10px;">Project Type</label>
        <input type="text" name="type" class="form-control" value="{{ $project->type }}">

        <label style="margin-top:10px;">Description</label>
        <textarea name="description" class="form-control" rows="3">{{ $project->description }}</textarea>

        <label style="margin-top:10px;">Replace Image (optional)</label>
        <input type="file" name="image" class="form-control">

        <p style="margin-top:10px;">Current Image:</p>
        <img src="{{ $project->image_url }}" width="150" style="border-radius:8px;">

        <button class="btn" style="margin-top:20px;">Save Changes</button>
    </form>

</div>

@endsection
