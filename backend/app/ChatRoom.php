<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    protected $fillable = [
        'user_id', 'send_user_id',
    ];

    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
