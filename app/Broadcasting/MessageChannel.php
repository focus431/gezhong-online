<?php

namespace App\Broadcasting;

use Illuminate\Broadcasting\Channel;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;

class MessageChannel
{
    protected $messageData;

    public function __construct($messageData)
    {
        $this->messageData = $messageData;
    }

    public function broadcastOn()
    {
        // 使用聊天室名稱作為頻道名稱
        return new Channel('chat-room.' . $this->messageData['chat_room_id']);
    }
}
