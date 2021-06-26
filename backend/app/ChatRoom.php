<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    public function chatMessages()
    {
        return $this->hasMany(ChatMessage::class);
    }
}
