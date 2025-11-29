@extends('layouts.main')

@section('title', 'Client Dashboard')

@section('content')

<div class="dashboard-container">

    <!-- USER HEADER SECTION -->
    <div class="dashboard-header">

        <div class="user-info">

            <!-- Profile Photo -->
            <div class="dash-photo">
                @if(Auth::user()->photo)
                    <img src="{{ asset('uploads/profile/' . Auth::user()->photo) }}" alt="Profile">
                @else
                    <img src="{{ asset('assets/images/default.png') }}" alt="Default">
                @endif
            </div>

            <div class="welcome-text">
                <h2>Welcome, {{ Auth::user()->name }} 👋</h2>
                <p>Manage your activities and explore designs.</p>
            </div>

        </div>

    </div>


    <!-- DASHBOARD CARDS (Old Design Restored) -->
    <div class="dashboard-cards">

        <!-- Browse Portfolio -->
        <div class="dash-card">
            <h3>Browse Portfolios</h3>
            <p>Explore interior designers and their work.</p>
            <a href="#" class="btn-primary">View Portfolios</a>
        </div>

        <!-- AI Visualization -->
        <div class="dash-card">
            <h3>AI Visualization</h3>
            <p>Upload a room photo to get AI-generated designs.</p>
            <a href="#" class="btn-secondary">Try AI Design</a>
        </div>

        <!-- Bookings -->
        <div class="dash-card">
            <h3>Your Bookings</h3>
            <p>Check your booking activity and history.</p>
            <a href="#" class="btn-primary">View Bookings</a>
        </div>

    </div>

</div>

@endsection
