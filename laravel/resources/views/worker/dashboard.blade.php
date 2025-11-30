@extends('layouts.main')

@section('title', 'Worker Dashboard')

@section('content')

<div class="worker-hero">
    <h1>Welcome, {{ Auth::user()->name }} 👷‍♂️</h1>
    <p>Manage your work and grow your design career.</p>
</div>

<div class="dashboard-grid">

    <!-- Portfolio -->
    <div class="dash-card">
        <h3>📁 My Portfolio</h3>
        <p>Manage and upload your interior design works.</p>
        <a href="{{ route('worker.portfolio') }}" class="btn-dashboard">Go to Portfolio</a>
    </div>

    <!-- Orders -->
    <div class="dash-card">
        <h3>🧾 Order List</h3>
        <p>View client orders and completed projects.</p>
        <a href="#" class="btn-dashboard">View Orders</a>
    </div>

    <!-- Ratings -->
    <div class="dash-card">
        <h3>⭐ Ratings</h3>
        <p>Check your client feedback & reputation.</p>
        <a href="#" class="btn-dashboard">View Ratings</a>
    </div>

    <!-- Life Cycle -->
    <div class="dash-card">
        <h3>📅 Life Cycle</h3>
        <p>Your account creation date and account age.</p>
        <a href="{{ route('worker.lifecycle') }}" class="btn-dashboard">View Life Cycle</a>
    </div>

</div>

@endsection
