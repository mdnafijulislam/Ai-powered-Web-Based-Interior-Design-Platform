@extends('layouts.main')

@section('title', 'Welcome')

@section('content')
<div class="hero-section">

    <div class="hero-text">
        <h1>Transform Your Space with   <span>Aesthetica</span></h1>
        <p>AI-powered interior design platform where clients meet skilled designers.</p>

        <div class="hero-buttons">
            <a href="{{ route('login') }}" class="btn-primary">Login</a>
            <a href="{{ route('register') }}" class="btn-secondary">Get Started</a>
        </div>
    </div>

    <div class="hero-image">
        <img src="{{ asset('assets/images/hero.png') }}" alt="Interior Design">
    </div>

</div>
@endsection
