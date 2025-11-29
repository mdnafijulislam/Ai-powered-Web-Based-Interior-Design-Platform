@extends('layouts.main')

@section('title', 'Aesthetica — AI Interior Design')

@section('content')

<!-- ================= HERO SECTION ================= -->
<div class="hero-section-bg">
    <div class="hero-overlay">
        <div class="hero-text-left">

            <h1>Transform Your Space <br> with <span>Aesthetica</span></h1>

            <p class="subtitle">
                AI-powered interior design platform where clients <br> meet skilled designers.
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

<!-- ====================================================== -->
<!-- ===================== ABOUT SECTION ==================== -->
<!-- ====================================================== -->

<section id="about" class="about-section">

    <h2 class="section-title">About Aesthetica</h2>

    <p class="about-text">
        Aesthetica is an AI-powered interior design platform that brings together creative designers 
        and clients looking to transform their living spaces.  
        Our platform allows users to generate AI visualizations, book designers, chat in real-time, 
        and manage full design projects effortlessly.
    </p>

    <p class="about-text">
        Whether you're looking for a modern makeover, aesthetic setup, or full home transformation —  
        Aesthetica connects you with the right talent and powerful AI visualization tools.
    </p>

</section>


<!-- ====================================================== -->
<!-- ===================== CONTACT/TEAM ====================== -->
<!-- ====================================================== -->

<section id="contact" class="team-section">

    <h2 class="section-title">Meet Our Team</h2>
    <p class="team-subtitle">The creative minds behind Aesthetica</p>

    <div class="team-grid">

        <!-- MEMBER 1 -->
        <div class="team-card">
            <img src="{{ asset('assets/images/member1.jpg') }}" alt="Member 1">
            <h3>Md. Nafijul Islam</h3>
            <p>ID: 1045</p>
        </div>

        <!-- MEMBER 2 -->
        <div class="team-card">
            <img src="{{ asset('assets/images/member2.jpg') }}" alt="Member 2">
            <h3>Md Nayeem Hasan Habib</h3>
            <p>ID: 1018</p>
        </div>

        <!-- MEMBER 3 -->
        <div class="team-card">
            <img src="{{ asset('assets/images/member3.jpg') }}" alt="Member 3">
            <h3>Arif Bin Hamid</h3>
            <p>ID: 1138</p>
        </div>

        <!-- MEMBER 4 -->
        <div class="team-card">
            <img src="{{ asset('assets/images/member4.jpg') }}" alt="Member 4">
            <h3>Linkon Mondol</h3>
            <p>ID: 1865</p>
        </div>

    </div>

</section>

@endsection
