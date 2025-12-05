@extends('layouts.main')

@section('title', 'Chat')

@section('content')

<style>
.chat-box {
    width: 60%;
    margin: 40px auto;
    background: white;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.messages {
    height: 400px;
    overflow-y: auto;
    border: 1px solid #ddd;
    padding: 15px;
    border-radius: 8px;
    background: #fafafa;
}

.message {
    margin-bottom: 12px;
    padding: 8px 14px;
    border-radius: 14px;
    max-width: 60%;
}

.me {
    background: #d1ffd6;
    margin-left: auto;
}

.other {
    background: #e6e6e6;
    margin-right: auto;
}
</style>

<div class="chat-box">
    <h2>Chat with {{ $otherUser->name }}</h2>

    <div id="messages" class="messages"></div>

    <div style="display: flex; margin-top: 10px;">
        <input type="text" id="messageInput" placeholder="Type a message..." style="flex:1; padding:10px; border-radius:8px; border:1px solid #ccc;">
        <button onclick="sendMessage()" style="margin-left:10px; padding:10px 20px; border:none; border-radius:8px; background:#111; color:white;">Send</button>
    </div>
</div>

<script>
let receiver_id = {{ $otherUser->id }};
let csrf = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

// Load messages every 1 second
setInterval(fetchMessages, 1000);
fetchMessages();

// Fetch messages
function fetchMessages() {
    fetch(`/chat/messages/${receiver_id}`)
        .then(res => res.json())
        .then(data => {
            let msgBox = document.getElementById("messages");
            msgBox.innerHTML = "";

            data.forEach(msg => {
                let div = document.createElement("div");
                div.classList.add("message");

                if (msg.sender_id == {{ Auth::id() }}) {
                    div.classList.add("me");
                } else {
                    div.classList.add("other");
                }

                div.innerText = msg.message;
                msgBox.appendChild(div);
            });

            msgBox.scrollTop = msgBox.scrollHeight;
        });
}

// Send message
function sendMessage() {
    let text = document.getElementById("messageInput").value;
    if (text.trim().length === 0) return;

    fetch(`/chat/send`, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": csrf
        },
        body: JSON.stringify({
            receiver_id: receiver_id,
            message: text
        })
    });

    document.getElementById("messageInput").value = "";
}
</script>

@endsection
