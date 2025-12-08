@extends('layouts.main')

@section('content')

<style>
    .ai-img-box {
        text-align: center;
        margin-top: 40px;
        animation: fadeIn 0.6s ease;
    }

    .ai-img-box img {
        max-width: 650px;
        border-radius: 16px;
        box-shadow: 0 12px 28px rgba(0,0,0,0.25);
    }

    .worker-card {
        background: white;
        padding: 18px;
        border-radius: 14px;
        box-shadow: 0 6px 18px rgba(0,0,0,0.15);
        transition: 0.3s;
        animation: fadeInUp 0.5s ease;
    }

    .worker-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 10px 28px rgba(0,0,0,0.25);
    }

    .worker-card img {
        height: 180px;
        object-fit: cover;
        width: 100%;
        border-radius: 10px;
    }

    .btn-book {
        background:#28a745;
        color:white;
        padding: 8px 12px;
        border-radius: 8px;
        display:block;
        text-align:center;
        margin-top:8px;
    }

    .btn-book:hover {
        background:#1f8f3a;
    }

    .btn-profile {
        background:#6c63ff;
        color:white;
        padding: 8px 12px;
        border-radius: 8px;
        display:block;
        text-align:center;
    }

    .btn-profile:hover {
        background:#4f48ff;
    }

    @keyframes fadeInUp {
        from { opacity:0; transform: translateY(25px); }
        to   { opacity:1; transform: translateY(0); }
    }
</style>

<div class="container">

    <div class="ai-img-box">
        <h2 class="mb-4">🎨 Your AI Interior Design</h2>

        <img src="{{ $generatedImage }}" alt="AI Result">
        <p class="mt-3"><strong>Your Prompt:</strong> {{ $prompt }}</p>
    </div>

    <hr class="my-5">

    <h3 class="mb-4">✨ Suggested Interior Designers</h3>

    <div class="row">
        @forelse($workers as $worker)
            <div class="col-md-4 mb-4">
                <div class="worker-card">
                    <img src="{{ asset('storage/' . $worker->image) }}">

                    <h4 class="mt-3">{{ $worker->user->name }}</h4>
                    <p style="font-size:14px; color:gray;">
                        Style: {{ $worker->type }} <br>
                        Tags: {{ $worker->tags }}
                    </p>

                    <a href="{{ route('worker.profile', $worker->user_id) }}" class="btn-profile">View Profile</a>
                    <a href="{{ route('booking.create', $worker->user_id) }}" class="btn-book">Book Now</a>
                </div>
            </div>
        @empty
            <p>No matching designers found based on your prompt.</p>
        @endforelse
    </div>

</div>
@endsection
