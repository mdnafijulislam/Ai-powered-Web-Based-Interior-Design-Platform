@extends('layouts.main')

@section('title', 'Worker Profile')

@section('content')

<style>
    .profile-container {
        max-width: 750px;
        margin: auto;
        background: #fff;
        padding: 35px;
        border-radius: 14px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .profile-title {
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .profile-img {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ddd;
        margin-bottom: 15px;
    }

    .form-label {
        font-weight: 600;
        margin-top: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        margin-top: 5px;
    }

    .btn-save {
        background: #000;
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        margin-top: 25px;
        border: none;
        cursor: pointer;
        font-size: 15px;
        transition: 0.3s ease;
    }

    .btn-save:hover {
        background: #222;
    }

</style>

<div class="profile-container">

    <h2 class="profile-title">Edit Profile</h2>

    <form action="{{ route('worker.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- IMAGE PREVIEW -->
        <div style="text-align:center;">
            <img id="preview" 
                 src="{{ Auth::user()->photo 
                        ? asset('uploads/profile/' . Auth::user()->photo) 
                        : asset('assets/images/default-user.png') }}"
                 class="profile-img">
            <br>
            <input type="file" name="photo" onchange="previewImage(event)" style="margin-top:10px;">
        </div>

        <script>
            function previewImage(event){
                document.getElementById('preview').src = URL.createObjectURL(event.target.files[0]);
            }
        </script>

        <label class="form-label">Name:</label>
        <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control">

        <label class="form-label">Email:</label>
        <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control">

        <label class="form-label">Phone:</label>
        <input type="text" name="phone" value="{{ Auth::user()->phone }}" class="form-control">

        <label class="form-label">Address:</label>
        <input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control">

        <label class="form-label">Bio:</label>
        <textarea name="bio" class="form-control" rows="3">{{ Auth::user()->bio }}</textarea>

        <button class="btn-save">Update Profile</button>
    </form>

</div>

@endsection
