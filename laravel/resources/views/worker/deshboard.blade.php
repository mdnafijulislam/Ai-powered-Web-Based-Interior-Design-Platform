@extends('layouts.main')

@section('title', 'Worker Dashboard')

@section('content')

<style>
.dashboard-bg {
    background: url('/assets/images/bg.jpg') no-repeat center center/cover;
    border-radius: 12px;
    padding: 40px;
    margin: 30px auto;
    min-height: 500px;
}

.dashboard-card {
    background: white;
    padding: 25px;
    margin-top: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transition: 0.3s;
}

.dashboard-card:hover {
    transform: translateY(-4px);
}

.profile-photo {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
}
</style>


<div class="dashboard-bg">

    {{-- Profile --}}
    <div style="display: flex; align-items: center; gap: 20px;">
        <img src="{{ Auth::user()->photo ? asset('storage/'.Auth::user()->photo) : asset('assets/images/default.png') }}" 
             class="profile-photo">

        <div>
            <h2>Welcome, {{ Auth::user()->name }} 👋</h2>
            <p>Manage your work, portfolio and bookings.</p>
        </div>
    </div>


    {{-- Cards --}}
    <div style="display: flex; gap: 20px; margin-top: 30px;">

        <div class="dashboard-card" style="width: 30%;">
            <h3>My Portfolio</h3>
            <p>Add or manage your design portfolio.</p>
            <a href="#" class="btn-primary">Manage Portfolio</a>
        </div>

        <div class="dashboard-card" style="width: 30%;">
            <h3>Client Bookings</h3>
            <p>Check client booking requests.</p>
            <a href="#" class="btn-primary">View Bookings</a>
        </div>

        <div class="dashboard-card" style="width: 30%;">
            <h3>Profile Settings</h3>
            <p>Update your personal info.</p>
            <a href="{{ route('client.profile') }}" class="btn-primary">Edit Profile</a>
        </div>

    </div>

</div>

@endsection

@extends('layouts.main')

@section('title', 'Worker Dashboard')

@section('content')

<div style="padding: 40px;">
    <h1>Welcome, {{ Auth::user()->name }} 👋</h1>

    <p>Manage your portfolio and client requests.</p>

    <a href="{{ route('worker.portfolio') }}" 
       style="display:inline-block; margin-top:20px; background:#000; color:#fff; padding:10px 20px; border-radius:6px;">
       Go to Portfolio
    </a>
</div>

@endsection


