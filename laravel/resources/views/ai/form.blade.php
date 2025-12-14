@extends('layouts.main')

@section('content')

<style>
    body {
        background: url('/assets/images/bg.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .ai-container {
        max-width: 650px;
        margin: 60px auto;
        padding: 40px;
        background: rgba(255, 255, 255, 0.25);
        backdrop-filter: blur(14px);
        border-radius: 16px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.3);
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
        cursor: pointer;
        transition: 0.3s;
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
        padding: 14px;
        border-radius: 10px;
        width: 100%;
        margin-top: 18px;
        transition: 0.3s;
        font-size: 17px;
        cursor: pointer;
    }

    .ai-btn:hover {
        background: #4f48ff;
        transform: translateY(-2px);
    }

    #loadingText {
        display: none;
        margin-top: 12px;
        font-size: 15px;
        text-align: center;
        color: #222;
    }

    #preview img {
        width: 150px;
        margin-top: 12px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }
</style>


<div class="ai-container">

    <h2 class="text-center mb-4">✨ AI Interior Visualization</h2>

    <form id="aiForm">
        @csrf

        <!-- IMAGE UPLOAD -->
        <label class="ai-upload-box">
            <input
                type="file"
                id="roomInput"
                name="room_image"
                accept="image/*"
                hidden
                required
            >
            <h4>📤 Click to upload your room photo</h4>
            <p>JPG, PNG supported</p>

            <!-- IMAGE PREVIEW -->
            <div id="preview"></div>
        </label>

        <!-- PROMPT -->
        <div class="mt-4">
            <label><strong>Your Design Request</strong></label>
            <textarea
                id="prompt"
                class="form-control"
                rows="4"
                placeholder="Make this room modern minimalist with warm lighting and wooden furniture."
                required></textarea>
        </div>

        <button type="submit" id="generateBtn" class="ai-btn">
            Generate AI Design
        </button>

        <p id="loadingText">⏳ AI is generating your new design...</p>
    </form>
</div>


<script>
// ===================================================
// IMAGE PREVIEW — FIX 1 (100% WORKING)
// ===================================================
const roomInput = document.getElementById("roomInput");
const preview = document.getElementById("preview");

roomInput.addEventListener("change", function () {
    preview.innerHTML = "";
    if (!this.files[0]) return;

    const img = document.createElement("img");
    img.src = URL.createObjectURL(this.files[0]);
    preview.appendChild(img);
});

document.getElementById("aiForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const file = roomInput.files[0];
    const prompt = document.getElementById("prompt").value;

    if (!file) {
        alert("Please upload an image");
        return;
    }

    const btn = document.getElementById("generateBtn");
    const loading = document.getElementById("loadingText");

    btn.disabled = true;
    loading.style.display = "block";

    const reader = new FileReader();

    reader.onload = function () {

        // 🔥 USE FormData (NOT JSON)
        const formData = new FormData();
        formData.append("original_image", reader.result);
        formData.append("final_image", reader.result);
        formData.append("prompt", prompt);
        formData.append("_token", "{{ csrf_token() }}");

        fetch("{{ route('ai.save') }}", {
            method: "POST",
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.href = "{{ route('ai.result') }}";
            } else {
                alert("Save failed");
            }
        })
        .catch(() => {
            alert("Request failed");
        })
        .finally(() => {
            btn.disabled = false;
            loading.style.display = "none";
        });
    };

    reader.readAsDataURL(file);
});
</script>

@endsection
