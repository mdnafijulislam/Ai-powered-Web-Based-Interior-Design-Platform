@extends('layouts.main')

@section('content')

<style>
.ai-result-container{
    max-width: 900px;
    margin: 60px auto;
    background: rgba(255,255,255,0.15);
    backdrop-filter: blur(14px);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0 10px 35px rgba(0,0,0,.25);
    animation: fadeUp .5s ease;
}

@keyframes fadeUp {
    from {opacity:0; transform: translateY(20px);}
    to {opacity:1; transform: translateY(0);}
}

.compare-wrapper{
    position: relative;
    width: 100%;
    overflow: hidden;
    border-radius: 16px;
    margin-top: 30px;
}

.compare-wrapper img{
    width: 100%;
    display: block;
}

.after-image{
    position: absolute;
    top:0;
    left:0;
    height:100%;
    width:50%;
    overflow:hidden;
}

.after-image img{
    width:100%;
}

.slider{
    position:absolute;
    top:0;
    left:50%;
    width:4px;
    height:100%;
    background:#6c63ff;
    cursor: ew-resize;
}

.slider:before{
    content:'⇆';
    position:absolute;
    top:50%;
    left:-18px;
    transform:translateY(-50%);
    background:#6c63ff;
    color:#fff;
    padding:8px 10px;
    border-radius:50%;
    font-size:14px;
}

.worker-card{
    background:rgba(255,255,255,.18);
    padding:18px;
    border-radius:12px;
    margin-top:15px;
}

.worker-card a{
    margin-top:8px;
    display:inline-block;
}
</style>

<div class="ai-result-container">

    <h2 class="text-center">✨ AI Room Transformation</h2>

    <p class="text-center text-muted">
        Prompt:
        <strong>{{ $prompt ?? 'N/A' }}</strong>
    </p>

    {{-- BEFORE / AFTER --}}
    @if(!empty($originalImage) && !empty($generatedImage))
        <div class="compare-wrapper" id="compareBox">

            <!-- BEFORE -->
            <img src="{{ $originalImage }}" alt="Before Image">

            <!-- AFTER -->
            <div class="after-image" id="afterBox">
                <img src="{{ $generatedImage }}" alt="After Image">
            </div>

            <div class="slider" id="slider"></div>
        </div>
    @else
        <p class="text-center text-danger mt-4">
            ❌ Image comparison unavailable.
        </p>
    @endif


    {{-- DESIGNER SUGGESTIONS --}}
    <h3 class="mt-5">👷 Recommended Designers</h3>

    @if(!empty($workers) && count($workers))
        @foreach($workers as $worker)
            <div class="worker-card">

                <strong>
                    {{ $worker->user->name ?? 'Designer' }}
                </strong><br>

                <small>
                    {{ $worker->type ?? 'Interior Designer' }}
                </small><br>

                {{-- Portfolio Image --}}
                @if(!empty($worker->image))
                    <img
                        src="{{ asset('uploads/portfolio/'.$worker->image) }}"
                        style="width:100%; margin-top:10px; border-radius:10px;">
                @endif

                {{-- ACTION BUTTONS --}}
                <div class="mt-2">
                    <a href="{{ route('portfolio.show', $worker->id) }}"
                       class="btn btn-sm btn-outline-primary">
                        View Portfolio
                    </a>

                    <a href="{{ route('booking.create', ['worker_id' => $worker->user_id]) }}"
                       class="btn btn-sm btn-success">
                        Book Designer
                    </a>
                </div>

            </div>
        @endforeach
    @else
        <p class="text-muted">No designers available.</p>
    @endif

    <div class="text-center mt-4">
        <a href="{{ route('ai.form') }}" class="btn btn-dark">
            Try Another Design
        </a>
    </div>

</div>


{{-- SLIDER SCRIPT --}}
@if(!empty($originalImage) && !empty($generatedImage))
<script>
const slider = document.getElementById("slider");
const afterBox = document.getElementById("afterBox");
const compareBox = document.getElementById("compareBox");

let dragging = false;

slider.addEventListener("mousedown", () => dragging = true);
window.addEventListener("mouseup", () => dragging = false);

window.addEventListener("mousemove", e => {
    if (!dragging) return;

    const rect = compareBox.getBoundingClientRect();
    let x = e.clientX - rect.left;

    x = Math.max(0, Math.min(x, rect.width));

    afterBox.style.width = x + "px";
    slider.style.left = x + "px";
});
</script>
@endif

@endsection
