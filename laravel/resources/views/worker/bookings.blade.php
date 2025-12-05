@extends('layouts.main')

@section('title', 'Client Booking Requests')

@section('content')
<div class="container" style="max-width:1000px; margin:auto; padding:40px;">
    
    <h2 style="margin-bottom:25px;">Client Booking Requests</h2>

    @forelse($bookings as $booking)
        <div style="
            padding:18px;
            background:#fff;
            border-radius:10px;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
            margin-bottom:18px;
        ">

            <p><strong>Client:</strong> {{ $booking->client->name }}</p>
            <p><strong>Portfolio:</strong> {{ $booking->portfolio->title ?? 'N/A' }}</p>
            <p><strong>Status:</strong> 
                <span style="
                    padding:4px 10px;
                    border-radius:6px;
                    background:
                        {{ $booking->status === 'pending' ? '#ffc107' : 
                           ($booking->status === 'accepted' ? '#28a745' : '#dc3545') }};
                    color:#fff;
                    font-size:13px;
                ">
                    {{ ucfirst($booking->status) }}
                </span>
            </p>

            <p><strong>Budget:</strong> {{ $booking->budget ?? '—' }}</p>
            <p><strong>Date:</strong> {{ $booking->preferred_date ?? '—' }}</p>

            <div style="margin-top:15px; display:flex; gap:12px; flex-wrap:wrap;">

                <!-- ⭐ CHAT BUTTON (Worker → Client) -->
                <a href="{{ route('chat.window', $booking->client_id) }}"
                   style="
                       background:#0b74de;
                       color:#fff;
                       padding:8px 16px;
                       border-radius:8px;
                       text-decoration:none;
                       display:inline-block;
                   ">
                    💬 Chat
                </a>

                @if($booking->status === 'pending')

                    <!-- Accept -->
                    <form action="{{ route('worker.booking.accept', $booking->id) }}" method="POST">
                        @csrf
                        <button style="
                            background:#28a745;
                            color:#fff;
                            padding:8px 16px;
                            border-radius:8px;
                            border:none;
                            cursor:pointer;
                        ">
                            ✔ Accept
                        </button>
                    </form>

                    <!-- Reject -->
                    <form action="{{ route('worker.booking.reject', $booking->id) }}" method="POST">
                        @csrf
                        <button style="
                            background:#dc3545;
                            color:#fff;
                            padding:8px 16px;
                            border-radius:8px;
                            border:none;
                            cursor:pointer;
                        ">
                            ✖ Reject
                        </button>
                    </form>

                @endif

            </div>

        </div>
    @empty

        <p>No booking requests found.</p>

    @endforelse

</div>
@endsection
