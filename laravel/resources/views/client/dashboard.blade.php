@extends('layouts.main')

@section('title', 'Client Dashboard')

@section('content')

<div class="dashboard">

    <h2>Welcome, {{ Auth::user()->name }} 👋</h2>

    <p class="subtitle">Manage your activities and explore designs.</p>

    <div class="dashboard-cards">

        <!-- Portfolio Browse Card -->
        <div class="card">
            <h3>Browse Portfolios</h3>
            <p>Explore interior designers and their work.</p>
            <a href="{{ route('portfolio') }}" class="btn-primary">View Portfolios</a>
        </div>

        <!-- AI Interior Generator -->
        <div class="card">
            <h3>AI Visualization</h3>
            <p>Upload a room photo to get AI-generated designs.</p>
            <a href="#" class="btn-secondary">Try AI Design</a>
        </div>

        <!-- Booking Page -->
        <div class="card">
            <h3>Your Bookings</h3>
            <p>Check your booking activity and history.</p>
            <a href="{{ route('booking') }}" class="btn-primary">View Bookings</a>
        </div>

    </div>

</div>

@endsection
