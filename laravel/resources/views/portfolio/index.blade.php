@extends('layouts.main')

@section('title','Browse Portfolios')

@section('content')
<div class="container" style="max-width:1200px;margin:auto;padding:40px;">
    <h1>Browse Portfolios</h1>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:20px;margin-top:20px;">
        
        @forelse($portfolios as $p)
        <div style="background:#fff;border-radius:10px;box-shadow:0 4px 14px rgba(0,0,0,0.06);overflow:hidden;">
            
            <!-- Portfolio Image -->
            <img src="{{ $p->image_url }}" alt="" style="width:100%;height:220px;object-fit:cover;">

            <div style="padding:15px;">

                <!-- Title -->
                <h3 style="margin:0 0 8px;">{{ $p->title }}</h3>

                <!-- Portfolio Info -->
                <p><strong>By:</strong> {{ $p->worker?->name ?? 'Unknown' }}</p>
                <p><strong>Location:</strong> {{ $p->location }}</p>
                <p><strong>Type:</strong> {{ $p->type }}</p>

                <!-- BUTTON SECTION -->
                <div style="margin-top:12px;display:flex;flex-wrap:wrap;gap:8px;">

                    <!-- View Button -->
                    <a href="{{ route('portfolio.show', $p->id) }}" 
                       class="btn" 
                       style="background:#111;color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;">
                        View
                    </a>

                    <!-- Book Button -->
                    @auth
                        <a href="{{ route('booking.create', ['worker' => $p->worker_id, 'portfolio' => $p->id]) }}" 
                            class="btn" 
                            style="background:#0b74de;color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;">
                            Book
                        </a>

                        <!-- ⭐ CHAT BUTTON (Step–7) -->
                        <a href="{{ route('chat.window', $p->worker_id) }}" 
                            class="btn" 
                            style="background:#28a745;color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;">
                            Chat
                        </a>

                    @else

                        <!-- If not logged in: force login -->
                        <a href="{{ route('login') }}" 
                            class="btn" 
                            style="background:#0b74de;color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;">
                            Login to Book
                        </a>

                        <a href="{{ route('login') }}" 
                            class="btn" 
                            style="background:#28a745;color:#fff;padding:8px 12px;border-radius:8px;text-decoration:none;">
                            Login to Chat
                        </a>
                    @endauth

                </div>
            </div>

        </div>
        @empty
            <p>No portfolios found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div style="margin-top:20px;">
        {{ $portfolios->links() }}
    </div>
</div>
@endsection
