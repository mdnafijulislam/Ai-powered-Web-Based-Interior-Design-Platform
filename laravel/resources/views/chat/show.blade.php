@extends('layouts.main')

@section('title', 'Chat with ' . ($otherUser->name ?? 'User'))
@section('body-class', 'chat-page')

@section('content')

<style>
.chat-wrapper { max-width:900px; margin:40px auto; display:flex; flex-direction:column; gap:12px; }
.chat-box { background:#fff; border-radius:10px; padding:12px; min-height:350px; max-height:520px; overflow:auto; box-shadow:0 4px 12px rgba(0,0,0,0.06); }
.msg { margin:8px 0; display:flex; }
.msg.me { justify-content:flex-end; }
.msg .bubble { padding:10px 14px; border-radius:12px; max-width:70%; }
.msg.me .bubble { background:#0b74de; color:#fff; border-bottom-right-radius:4px; }
.msg.other .bubble { background:#f0f0f0; color:#111; border-bottom-left-radius:4px; }
.chat-form { display:flex; gap:8px; }
.chat-form textarea { flex:1; min-height:48px; resize:vertical; padding:8px; border-radius:8px; border:1px solid #ddd; }
.chat-form button { padding:10px 16px; border-radius:8px; background:#111; color:#fff; border:none; cursor:pointer; }
</style>

{{-- CSRF TOKEN --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="chat-wrapper">
    <h2>Chat with {{ $otherUser->name }}</h2>

    <div id="chatBox" class="chat-box">
        @foreach($messages as $m)
            <div class="msg {{ $m->sender_id == auth()->id() ? 'me' : 'other' }}" data-id="{{ $m->id }}">
                <div class="bubble">
                    <div style="font-size:13px; color:#666;">{{ $m->sender->name }}</div>
                    <div style="margin-top:6px;">{{ $m->message }}</div>
                    <div style="font-size:11px; color:#999; margin-top:6px;">
                        {{ $m->created_at->format('h:i A') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form id="chatForm" class="chat-form" onsubmit="return false;">
        @csrf
        <textarea id="messageInput" placeholder="Type a message..."></textarea>
        <button id="sendBtn">Send</button>
    </form>
</div>

<script>
(() => {

    const otherId = {{ $otherUser->id }};
    const authId = {{ auth()->id() }};
    const chatBox = document.getElementById('chatBox');
    const messageInput = document.getElementById('messageInput');
    const sendBtn = document.getElementById('sendBtn');

    function scrollBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    /** Track last message ID */
    let lastId = 0;
    const msgs = chatBox.querySelectorAll('.msg[data-id]');
    if (msgs.length) lastId = msgs[msgs.length - 1].dataset.id;

    /** ⭐ REPLACE করা appendMessage() (Duplicate STOP fix) */
    function appendMessage(m) {

        // STOP DUPLICATE MESSAGE (MOST IMPORTANT FIX)
        if (document.querySelector(`.msg[data-id="${m.id}"]`)) return;

        const div = document.createElement('div');
        div.className = 'msg ' + (m.sender_id == authId ? 'me' : 'other');
        div.dataset.id = m.id;

        div.innerHTML = `
            <div class="bubble">
                <div style="font-size:13px; color:#666;">${m.sender_name ?? 'User'}</div>
                <div style="margin-top:6px;">${m.message}</div>
                <div style="font-size:11px; color:#999; margin-top:6px;">
                    ${m.created_at_formatted ?? new Date(m.created_at).toLocaleTimeString()}
                </div>
            </div>
        `;

        chatBox.appendChild(div);
        lastId = m.id;
        scrollBottom();
    }

    /** Fetch new messages */
    async function fetchMessages() {
        try {
            const res = await fetch(`/chat/messages/${otherId}?since_id=${lastId}`);
            const data = await res.json();

            if (data.length) data.forEach(m => appendMessage(m));

        } catch (err) {
            console.error("Fetch Error:", err);
        }
    }

    /** SEND MESSAGE */
    async function sendMessage() {
        const text = messageInput.value.trim();
        if (!text) return;

        sendBtn.disabled = true;

        const res = await fetch(`/chat/${otherId}/send`, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message: text })
        });

        sendBtn.disabled = false;

        if (res.ok) {
            const m = await res.json();
            appendMessage(m);
            messageInput.value = "";
        } else {
            alert("Failed to send message");
        }
    }

    sendBtn.addEventListener('click', sendMessage);

    messageInput.addEventListener('keydown', e => {
        if (e.key === "Enter" && !e.shiftKey) {
            e.preventDefault();
            sendMessage();
        }
    });

    setInterval(fetchMessages, 2000);
    scrollBottom();

})();
</script>

@endsection
