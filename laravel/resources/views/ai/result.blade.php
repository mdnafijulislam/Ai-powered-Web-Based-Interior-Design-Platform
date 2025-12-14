@extends('layouts.main')

@section('content')

<style>
.ai-result-container{
    max-width: 1000px;
    margin: 60px auto;
    background: rgba(255,255,255,0.18);
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

/* ===== BEFORE / AFTER ===== */
.compare-wrapper{
    position: relative;
    width: 100%;
    overflow: hidden;
    border-radius: 16px;
    margin-top: 25px;
}
.compare-wrapper img{ width:100%; display:block; }

.after-image{
    position:absolute;
    top:0; left:0;
    height:100%; width:50%;
    overflow:hidden;
}

.slider{
    position:absolute;
    top:0; left:50%;
    width:4px; height:100%;
    background:#6c63ff;
    cursor: ew-resize;
}
.slider:before{
    content:'⇆';
    position:absolute;
    top:50%; left:-18px;
    transform:translateY(-50%);
    background:#6c63ff;
    color:#fff;
    padding:8px 10px;
    border-radius:50%;
}

/* ===== GEMINI ANALYSIS ===== */
.analysis-box{
    margin-top:40px;
    background:rgba(255,255,255,.25);
    padding:20px;
    border-radius:14px;
}

/* ===== FURNITURE ===== */
.furniture-panel{
    margin-top:30px;
    display:flex;
    gap:15px;
    flex-wrap: wrap;
}
.furniture-item{
    padding:10px 14px;
    background:#6c63ff;
    color:white;
    border-radius:10px;
    cursor:grab;
    user-select:none;
}
.room-canvas{
    margin-top:20px;
    position:relative;
    border:2px dashed #aaa;
    border-radius:14px;
    min-height:350px;
    background:rgba(255,255,255,.25);
}

/* ===== DESIGNERS ===== */
.worker-card{
    background:rgba(255,255,255,.22);
    padding:18px;
    border-radius:12px;
    margin-top:15px;
}
.worker-card img{
    width:100%;
    border-radius:10px;
    margin-top:10px;
}
</style>


<div class="ai-result-container">

    <h2 class="text-center">✨ AI Room Transformation</h2>

    <p class="text-center text-muted">
        Prompt: <strong>{{ $prompt }}</strong>
    </p>

    {{-- BEFORE / AFTER --}}
    @if(!empty($originalImage) && !empty($generatedImage))
    <div class="compare-wrapper" id="compareBox">
        <img src="{{ $originalImage }}" alt="Before">
        <div class="after-image" id="afterBox">
            <img src="{{ $generatedImage }}" alt="After">
        </div>
        <div class="slider" id="slider"></div>
    </div>
    @endif


    {{-- =========================
        STEP-5.1 : GEMINI ANALYSIS UI
    ========================== --}}
    <div class="analysis-box">
        <h4>🧠 Gemini AI Design Analysis</h4>
        <p id="analysisText">Analyzing your room design...</p>
    </div>


    {{-- =========================
        STEP-5.2 : FURNITURE DRAG / DROP
    ========================== --}}
    <h4 class="mt-4">🪑 Try Furniture Placement</h4>

    <div class="furniture-panel">
        <div class="furniture-item" draggable="true">🛋 Sofa</div>
        <div class="furniture-item" draggable="true">🪑 Chair</div>
        <div class="furniture-item" draggable="true">🛏 Bed</div>
        <div class="furniture-item" draggable="true">🪟 Table</div>
        <div class="furniture-item" draggable="true">🪴 Plant</div>
    </div>

    <div class="room-canvas" id="roomCanvas">
        <p style="text-align:center; margin-top:140px; color:#555;">
            Drop furniture here
        </p>
    </div>


    {{-- =========================
        DESIGNER SUGGESTIONS
    ========================== --}}
    <h3 class="mt-5">👷 Recommended Designers</h3>

    @forelse($workers as $worker)
        <div class="worker-card">
            <strong>{{ $worker->user->name ?? 'Designer' }}</strong><br>
            <small>{{ $worker->type ?? 'Interior Designer' }}</small>

            @if(!empty($worker->image))
                <img src="{{ asset('uploads/portfolio/'.$worker->image) }}">
            @endif

            <div class="mt-2">
                <a href="{{ route('portfolio.show', $worker->id) }}"
                   class="btn btn-sm btn-outline-primary">
                    View Portfolio
                </a>

                <a href="{{ route('booking.create', ['worker_id'=>$worker->user_id]) }}"
                   class="btn btn-sm btn-success">
                    Book Designer
                </a>
            </div>
        </div>
    @empty
        <p class="text-muted">No designers found.</p>
    @endforelse


    <div class="text-center mt-4">
        <a href="{{ route('ai.form') }}" class="btn btn-dark">
            Try Another Design
        </a>
    </div>
</div>


{{-- =========================
    SCRIPTS
========================= --}}
<script>
// ===== BEFORE / AFTER SLIDER =====
const slider = document.getElementById("slider");
const afterBox = document.getElementById("afterBox");
const compareBox = document.getElementById("compareBox");
let dragging = false;

if(slider){
    slider.onmousedown = () => dragging = true;
    window.onmouseup = () => dragging = false;
    window.onmousemove = e => {
        if(!dragging) return;
        const rect = compareBox.getBoundingClientRect();
        let x = Math.max(0, Math.min(e.clientX - rect.left, rect.width));
        afterBox.style.width = x + "px";
        slider.style.left = x + "px";
    };
}


// ===== GEMINI ANALYSIS (MOCK for now) =====
fetch("{{ route('ai.gemini.analyze') }}",{
    method:"POST",
    headers:{
        "Content-Type":"application/json",
        "X-CSRF-TOKEN":"{{ csrf_token() }}"
    },
    body:JSON.stringify({ prompt:"{{ $prompt }}" })
})
.then(res=>res.json())
.then(d=>{
    document.getElementById("analysisText").innerText = d.analysis;
})
.catch(()=>{
    document.getElementById("analysisText").innerText =
        "⚠️ Gemini analysis unavailable.";
});


// ===== FURNITURE DRAG & DROP =====
const items = document.querySelectorAll('.furniture-item');
const canvas = document.getElementById('roomCanvas');

items.forEach(item=>{
    item.addEventListener('dragstart',e=>{
        e.dataTransfer.setData("text", item.innerText);
    });
});

canvas.addEventListener('dragover',e=>e.preventDefault());
canvas.addEventListener('drop',e=>{
    e.preventDefault();

    const el = document.createElement("div");
    el.innerText = e.dataTransfer.getData("text");

    el.style.position="absolute";
    el.style.left=e.offsetX+"px";
    el.style.top=e.offsetY+"px";
    el.style.cursor="move";
    el.style.background="rgba(108,99,255,.9)";
    el.style.color="white";
    el.style.padding="6px 10px";
    el.style.borderRadius="8px";

    canvas.appendChild(el);
});
</script>

@endsection
