@extends('layouts.main')

@section('title', 'Worker Dashboard')

@section('content')

<style>
    /* Background Hero Section */
    .worker-hero {
        background: url('/assets/images/worker-dashboard-bg.jpg') center/cover no-repeat;
        height: 330px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        padding-left: 40px;
        position: relative;
        color: white;
    }

    .worker-photo {
        width: 110px;
        height: 110px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        margin-right: 20px;
    }

    .worker-hero-content h1 {
        font-size: 34px;
        font-weight: bold;
        margin: 0;
    }

    .worker-hero-content p {
        font-size: 18px;
        opacity: 0.9;
        margin-top: 5px;
    }

    .dashboard-grid {
        margin-top: 30px;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
        gap: 25px;
    }

    .dash-card {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: 0.3s ease;
    }

    .dash-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.12);
    }

    .dash-card h3 {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .btn-dashboard {
        margin-top: 10px;
        display: inline-block;
        padding: 10px 18px;
        background: black;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .btn-dashboard:hover {
        background: #1c1c1c;
    }
</style>

<div class="worker-hero">

    <img src="{{ Auth::user()->photo 
        ? asset('uploads/profile/' . Auth::user()->photo) 
        : asset('assets/images/default-user.png') }}" 
        class="worker-photo">

    <div class="worker-hero-content">
        <h1>Welcome, {{ Auth::user()->name }} 👷‍♂️</h1>
        <p>Manage your work and grow your design career.</p>
    </div>
</div>

<div class="dashboard-grid">

    <div class="dash-card">
        <h3>📁 My Portfolio</h3>
        <p>Manage and upload your interior design works.</p>
        <a href="{{ route('worker.portfolio') }}" class="btn-dashboard">Go to Portfolio</a>
    </div>

    <div class="dash-card">
        <h3>🧾 Order List</h3>
        <p>View client orders and completed projects.</p>

        {{-- FIXED ROUTE HERE --}}
        <a href="{{ route('worker.bookings') }}" class="btn-dashboard">View Orders</a>
    </div>

    <div class="dash-card">
        <h3>⭐ Ratings</h3>
        <p>Check your client feedback & reputation.</p>
        <a href="{{ route('worker.ratings') }}" class="btn-dashboard">View Ratings</a>
    </div>

    <div class="dash-card">
        <h3>📅 Life Cycle</h3>
        <p>Your account creation date and account age.</p>
        <a href="{{ route('worker.lifecycle') }}" class="btn-dashboard">View Life Cycle</a>
    </div>

</div>

@endsection
