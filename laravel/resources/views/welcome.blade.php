@extends('layouts.main')

@section('title', 'Aesthetica — AI Interior Design')

@section('content')

<div class="hero-section-bg">

    <div class="hero-overlay">
        <div class="hero-text-left">

            <h1>Transform Your Space <br> with <span>Aesthetica</span></h1>

            <p class="subtitle">
                AI-powered interior design platform where clients meet skilled designers.
            </p>

            <div class="hero-buttons">

                <!-- Guest Buttons -->
                @guest
                    <a href="{{ route('login') }}" class="btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn-secondary">Get Started</a>
                @endguest

                <!-- Client -->
                @auth
                    @if(Auth::user()->role === 'client')
                        <a href="{{ route('client.dashboard') }}" class="btn-primary">Go to Dashboard</a>
                    @endif

                    <!-- Worker -->
                    @if(Auth::user()->role === 'worker')
                        <a href="{{ route('worker.portfolio') }}" class="btn-primary">My Portfolio</a>
                    @endif
                @endauth

            </div>

        </div>
    </div>

</div>

@endsection
