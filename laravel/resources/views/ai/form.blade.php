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
        color: white;
    }
</style>



<div class="ai-container">

    <h2 class="text-center mb-4">✨ AI Interior Visualization</h2>

    <!-- IMPORTANT: Form now has ID -->
    <form id="aiForm">

        @csrf

        <!-- Upload Box -->
        <label class="ai-upload-box">
            <input type="file" id="roomInput" name="room_image" hidden required>
            <h4>📤 Click to upload your room photo</h4>
            <p style="font-size:14px; margin:0;">JPG, PNG supported</p>
            <div id="preview"></div>
        </label>

        <!-- Prompt -->
        <div class="mt-4">
            <label><strong>Your Design Request</strong></label>
            <textarea id="prompt" name="prompt" class="form-control" rows="4"
            placeholder="Example: Make this room modern minimalist with warm lighting." required></textarea>
        </div>

        <!-- Generate Button -->
        <button type="submit" id="generateBtn" class="ai-btn">Generate AI Design</button>

        <p id="loadingText">⏳ AI is generating your new design...</p>

    </form>
</div>



<script>
// IMAGE PREVIEW
document.getElementById("roomInput").addEventListener("change", function(event){
    let preview = document.getElementById("preview");
    preview.innerHTML = "";

    let file = event.target.files[0];
    let img = document.createElement("img");
    img.src = URL.createObjectURL(file);
    img.style.width = "140px";
    img.style.borderRadius = "10px";
    img.style.marginTop = "10px";

    preview.appendChild(img);
});


// AI GENERATION SCRIPT
document.getElementById("aiForm").addEventListener("submit", async function(e) {
    e.preventDefault();

    const btn = document.getElementById("generateBtn");
    const loading = document.getElementById("loadingText");
    const fileInput = document.getElementById("roomInput");

    btn.disabled = true;
    loading.style.display = "block";

    let file = fileInput.files[0];
    let reader = new FileReader();

    reader.onloadend = async function () {
        const base64 = reader.result.split(",")[1];

        try {
            // Public image model
            const aiResponse = await fetch("https://api.fal.ai/generate/flux-realistic-v1.1", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    prompt: document.getElementById("prompt").value,
                    image_base64: base64
                })
            });

            const result = await aiResponse.json();

            if (!result || !result.image_base64) {
                alert("AI could not generate image. Try again!");
                btn.disabled = false;
                loading.style.display = "none";
                return;
            }

            // Save to Laravel
            const saveResponse = await fetch("{{ route('ai.save') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    final_image: result.image_base64,
                    prompt: document.getElementById("prompt").value
                })
            });

            const saved = await saveResponse.json();

            if (saved.status === "saved") {
                window.location.href = "{{ route('ai.result') }}";
            }

        } catch (error) {
            console.error(error);
            alert("AI request failed.");
        }

        btn.disabled = false;
        loading.style.display = "none";
    };

    reader.readAsDataURL(file);
});
</script>

@endsection
