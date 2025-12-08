@extends('layouts.main')

@section('content')

<style>
    .ai-container {
        max-width: 650px;
        margin: 60px auto;
        padding: 40px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        animation: fadeIn 0.5s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .ai-upload-box {
        border: 2px dashed #6c63ff;
        padding: 35px;
        border-radius: 16px;
        text-align: center;
        transition: 0.3s;
        cursor: pointer;
        background: rgba(255,255,255,0.3);
    }

    .ai-upload-box:hover {
        background: rgba(255,255,255,0.5);
        transform: scale(1.02);
    }

    .ai-btn {
        background: #6c63ff;
        color: white;
        border: none;
        padding: 12px 20px;
        border-radius: 10px;
        width: 100%;
        transition: 0.3s;
    }

    .ai-btn:hover {
        background: #4f48ff;
        transform: translateY(-2px);
    }
</style>


<div class="ai-container">

    <h2 class="text-center mb-4">✨ AI Interior Visualization</h2>

    <form action="{{ route('ai.generate') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Upload Box -->
        <label class="ai-upload-box">
            <input type="file" name="room_image" hidden required id="roomInput">
            <h4>📤 Click to upload your room photo</h4>
            <p style="font-size:14px; margin:0;">JPG, PNG supported</p>
            <div id="preview" class="mt-3"></div>
        </label>

        <!-- Prompt -->
        <div class="mt-4">
            <label><strong>Your Design Request</strong></label>
            <textarea name="prompt" class="form-control" rows="4" placeholder="Example: Make this room modern minimalist with warm lighting." required></textarea>
        </div>

        <!-- Generate Button -->
        <button class="ai-btn mt-4">Generate AI Design</button>

    </form>
</div>

<script>
    document.getElementById("roomInput").addEventListener("change", function(event){
        let preview = document.getElementById("preview");
        preview.innerHTML = "";

        let file = event.target.files[0];
        let img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.style.width = "120px";
        img.style.borderRadius = "10px";
        img.style.marginTop = "10px";

        preview.appendChild(img);
    });
</script>

@endsection
