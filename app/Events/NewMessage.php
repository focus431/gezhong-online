<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;  // 引入 ShouldBroadcast
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewMessage implements ShouldBroadcast  // 實現 ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $messageData;

    public function __construct($messageData)
    {
        $this->messageData = $messageData;
    }

    // 指定廣播頻道
    public function broadcastOn()
    {
        return new Channel('chat-room.' . $this->messageData['chat_room_id']);
    }

    // 指定要廣播的數據
    public function broadcastWith()
    {
        return ['message' => $this->messageData];
    }
}
