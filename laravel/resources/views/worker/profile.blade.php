@extends('layouts.main')

@section('title', 'Worker Profile')

@section('content')

<div style="max-width:700px; margin:auto; padding:40px;">

    <h2>Edit Profile</h2>

    <form action="{{ route('worker.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- PHOTO PREVIEW --}}
        <div style="margin-bottom:20px;">
            <img id="preview" src="{{ Auth::user()->photo ? asset('uploads/profile/'.Auth::user()->photo) : '/assets/img/default.png' }}" 
                 style="width:100px;height:100px;border-radius:50%;object-fit:cover;">
        </div>

        <input type="file" name="photo" onchange="previewImage(event)">

        <script>
            function previewImage(event){
                document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
            }
        </script>

        <label>Name:</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">

        <label>Email:</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">

        <label>Phone:</label>
        <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control">

        <label>Address:</label>
        <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control">

        <label>Bio:</label>
        <textarea name="bio" class="form-control">{{ Auth::user()->bio }}</textarea>

        <button class="btn-primary" style="margin-top:20px;">Update Profile</button>
    </form>

</div>

@endsection
