@extends('layouts.main')

@section('title', 'Edit Profile')

@section('content')

<div class="profile-container">

    <div class="profile-card">

        <h2>Edit Profile</h2>

        <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- SHOW CURRENT PHOTO -->
            <div class="profile-photo-preview">
                @if(Auth::user()->photo)
                    <img src="{{ asset('uploads/profile/' . Auth::user()->photo) }}" alt="Profile Photo">
                @else
                    <img src="{{ asset('assets/images/default.png') }}" alt="Default Photo">
                @endif
            </div>

            <!-- UPLOAD NEW PHOTO -->
            <label>Upload New Photo:</label>
            <input type="file" name="photo" accept="image/*" class="form-control">

            <label>Name:</label>
            <input type="text" name="name" value="{{ $user->name }}">

            <label>Email:</label>
            <input type="email" name="email" value="{{ $user->email }}">

            <label>Phone:</label>
            <input type="text" name="phone" value="{{ $user->phone }}">

            <label>Address:</label>
            <input type="text" name="address" value="{{ $user->address }}">

            <label>Bio:</label>
            <textarea name="bio" rows="4">{{ $user->bio }}</textarea>

            <button type="submit" class="btn-update">Update Profile</button>

        </form>

    </div>

</div>

@endsection
