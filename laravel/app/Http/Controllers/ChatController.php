<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ChatMessage;

class ChatController extends Controller
{
    // 1️⃣ চ্যাট উইন্ডো ওপেন
    public function chatWindow($user_id)
    {
        $auth = Auth::user();
        $otherUser = User::findOrFail($user_id);

        // দুইজনের পুরানো মেসেজ লোড
        $messages = ChatMessage::where(function ($q) use ($auth, $user_id) {
                $q->where('sender_id', $auth->id)
                  ->where('receiver_id', $user_id);
            })
            ->orWhere(function ($q) use ($auth, $user_id) {
                $q->where('sender_id', $user_id)
                  ->where('receiver_id', $auth->id);
            })
            ->orderBy('id', 'asc')
            ->get();

        return view('chat.show', compact('otherUser', 'messages'));
    }

    // 2️⃣ AJAX — নতুন মেসেজ ফেচ (FINAL FIX — sender_name + created_at ফরম্যাট সহ)
    public function fetchMessages(Request $request, $user_id)
    {
        $auth = Auth::id();
        $sinceId = $request->query('since_id', 0);

        $messages = ChatMessage::where(function ($q) use ($auth, $user_id) {
                $q->where('sender_id', $auth)
                  ->where('receiver_id', $user_id);
            })
            ->orWhere(function ($q) use ($auth, $user_id) {
                $q->where('sender_id', $user_id)
                  ->where('receiver_id', $auth);
            })
            ->where('id', '>', $sinceId)
            ->orderBy('id', 'asc')
            ->get();

        // ⭐ front-end এ দেখানোর জন্য extra তথ্য যোগ
        foreach ($messages as $m) {
            $m->sender_name = $m->sender->name ?? 'User';
            $m->created_at_formatted = $m->created_at->format('h:i A');
        }

        return response()->json($messages);
    }

    // 3️⃣ AJAX — মেসেজ পাঠানো (FINAL & CORRECT)
    public function sendMessage(Request $request, $user_id)
    {
        $request->validate([
            'message' => 'required|string|max:2000'
        ]);

        $msg = ChatMessage::create([
            'sender_id'   => Auth::id(),
            'receiver_id' => $user_id,
            'message'     => $request->message
        ]);

        // ⭐ front-end এ দেখানোর জন্য data attach
        $msg->sender_name = Auth::user()->name;
        $msg->created_at_formatted = $msg->created_at->format('h:i A');

        return response()->json($msg);
    }
}
