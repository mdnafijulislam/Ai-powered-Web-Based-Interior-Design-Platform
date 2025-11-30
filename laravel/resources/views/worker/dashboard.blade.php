@extends('layouts.main')

@section('title', 'Worker Dashboard')

@section('content')

<style>
    .dashboard-hero {
        background: url('/assets/img/bg.jpg') center/cover no-repeat;
        padding: 80px;
        border-radius: 12px;
        color: white;
    }
    .dashboard-box {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        margin-bottom: 25px;
    }
</style>

<div class="dashboard-hero">
    <h1 style="font-size:42px; font-weight:bold;">Welcome, {{ Auth::user()->name }}</h1>
    <p>Manage your work and showcase your portfolio</p>
</div>

<div style="padding:40px; max-width:1100px; margin:auto;">

    <div class="dashboard-box">
        <h3>📁 My Portfolio</h3>
        <p>Upload and manage your design projects.</p>
        <a href="{{ route('worker.portfolio') }}" class="btn-primary">Go to Portfolio</a>
    </div>

    <div class="dashboard-box">
        <h3>👤 My Profile</h3>
        <p>Edit your personal information.</p>
        <a href="{{ route('worker.profile') }}" class="btn-secondary">Edit Profile</a>
    </div>

</div>

@endsection
