<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ChatMessage extends Model
{
    use HasFactory;

    /** ✔ Mass Assignment Fix */
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'message',
    ];

    /** ✔ sender user relationship */
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    /** ✔ receiver user relationship */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /** 
     * ✔ Extra: Automatic sender_name attribute
     * Backend থেকে JSON-এ sender_name সবসময় যাবে
     */
    protected $appends = ['sender_name', 'created_at_formatted'];

    public function getSenderNameAttribute()
    {
        return $this->sender->name ?? 'User';
    }

    /**
     * ✔ Automatic formatted time 
     * উদাহরণ: 06:45 PM
     */
    public function getCreatedAtFormattedAttribute()
    {
        return Carbon::parse($this->created_at)->format('h:i A');
    }
}
