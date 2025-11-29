@extends('layouts.main')

@section('title', 'Edit Profile')

@section('content')

<div class="profile-container">

    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Profile Photo -->
        <div class="profile-photo-box">
            <img src="{{ $user->photo ? asset('uploads/users/'.$user->photo) : asset('assets/images/default.png') }}" class="profile-photo">
            <input type="file" name="photo">
        </div>

        <!-- Basic Info -->
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

        <button class="btn-primary" type="submit">Update Profile</button>
    </form>

</div>

@endsection
