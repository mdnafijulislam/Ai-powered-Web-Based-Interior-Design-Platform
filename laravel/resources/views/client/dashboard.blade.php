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

            <!-- ⭐ Browse Portfolios -->
            <div class="dash-card">
                <h3>Browse Portfolios</h3>
                <p>Explore interior designers and their work.</p>

                <!-- FIXED LINK 👇 -->
                <a href="{{ route('portfolio') }}" class="btn-primary">View Portfolios</a>
            </div>

            <!-- AI Design -->
            <div class="dash-card">
                <h3>AI Visualization</h3>
                <p>Upload a room photo to get AI-generated designs.</p>
                <a href="#" class="btn-secondary">Try AI Design</a>
            </div>

            <!-- ⭐ My Bookings -->
            <div class="dash-card">
                <h3>Your Bookings</h3>
                <p>Check your booking activity and history.</p>

                <a href="{{ route('client.bookings') }}" class="btn-primary">View Bookings</a>
            </div>

        </div>



        <!-- ⭐ RECENT BOOKINGS + CHAT SECTION -->
        @if(isset($bookings) && $bookings->count() > 0)
        <h2 style="margin-top:40px; color:white;">Recent Bookings</h2>

        <div class="dashboard-cards">
            @foreach($bookings as $booking)
                <div class="dash-card">
                    <h3>{{ $booking->worker->name }}</h3>
                    <p>Status: {{ ucfirst($booking->status) }}</p>

                    <!-- CHAT BUTTON 👇 -->
                    <a href="{{ route('chat.window', $booking->worker_id) }}" class="btn-primary">
                        Chat
                    </a>
                </div>
            @endforeach
        </div>
        @endif

    </div>

</div>

@endsection
