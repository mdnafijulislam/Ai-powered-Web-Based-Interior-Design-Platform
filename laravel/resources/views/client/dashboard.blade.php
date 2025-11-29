@extends('layouts.main')

@section('title', 'Client Dashboard')

@section('content')

<!-- Background Image Section -->
<div class="dashboard-bg">

    <div class="dashboard-container">

        <!-- USER HEADER -->
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

        <!-- CARDS -->
        <div class="dashboard-cards">

            <div class="dash-card">
                <h3>Browse Portfolios</h3>
                <p>Explore interior designers and their work.</p>
                <a href="#" class="btn-primary">View Portfolios</a>
            </div>

            <div class="dash-card">
                <h3>AI Visualization</h3>
                <p>Upload a room photo to get AI-generated designs.</p>
                <a href="#" class="btn-secondary">Try AI Design</a>
            </div>

            <div class="dash-card">
                <h3>Your Bookings</h3>
                <p>Check your booking activity and history.</p>
                <a href="#" class="btn-primary">View Bookings</a>
            </div>

        </div>

    </div>

</div>

@endsection
