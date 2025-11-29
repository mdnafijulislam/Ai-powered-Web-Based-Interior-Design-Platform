@extends('layouts.main')

@section('title', 'Client Dashboard')

@section('content')

<div class="dashboard-header">

    <div class="user-info">
        <!-- PROFILE PHOTO IN DASHBOARD -->
        <div class="dash-photo">
            @if(Auth::user()->photo)
                <img src="{{ asset('uploads/profile/' . Auth::user()->photo) }}" alt="Profile">
            @else
                <img src="{{ asset('assets/images/default.png') }}" alt="Default">
            @endif
        </div>

        <h2>Welcome, {{ Auth::user()->name }} 👋</h2>
        <p>Manage your activities and explore designs.</p>
    </div>

</div>

@include('client.dashboard-content')

@endsection
