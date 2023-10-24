<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Psy\Readline\Hoa\Console;

class ChatController extends Controller
{
    // ...

    public function chatView()
    {
        return view('chat');
    }

    // 儲存和廣播新消息
    // 獲取特定聊天室的所有消息（按時間排序）
    public function getMessages(Request $request)
    {
        $chatRoomId = $request->input('chat_room_id'); // 可以根據需要從請求中獲取聊天室ID

        $messages = Message::where('chat_room_id', $chatRoomId)
            ->orderBy('created_at', 'asc')
            ->get();

        // 将消息中的发件人信息（如果有）一起返回
        $formattedMessages = $messages->map(function ($message) {
            $sender = $message->user; // 假设你的Message模型有一个'user'关联

            return [
                'id' => $message->id,
                'content' => $message->content,
                'created_at' => $message->created_at,
                'sender' => $sender ? [
                    'id' => $sender->id,
                    'name' => $sender->name,
                    // 添加其他关于发件人的信息，如果需要的话
                ] : null,
            ];
        });

        return response()->json($formattedMessages);
    }

    public function sendMessage(Request $request)
    {
        Log::info('sendMessage 方法被調用');

        // 从请求中获取前端发送的消息数据
        $messageData = $request->all();

        // 设置发送消息用户的 ID
        $messageData['from_user_id'] = auth()->id();

        // 在这里，你可以处理接收到的消息数据，例如保存到数据库或进行其他逻辑处理

        // 假设你保存了消息到数据库
        // 请根据你的数据表结构进行相应的更改
        $message = new Message();
        $message->content = $messageData['content'];
        $message->from_user_id = $messageData['from_user_id'];
        $message->type = 'sent'; // 或者 'received'，根据需要设置
        $message->save();

        // 广播消息到前端
        event(new NewMessage($message)); // 使用事件类来广播消息

        // 返回成功响应
        return response()->json(['message' => 'Message sent successfully']);
    }

    public function getUserName(Request $request)
    {
        Log::info('getUserName 方法被調用');
        $userId = auth()->id(); // 假设使用 Laravel 的身份验证获取用户ID

        // 根据用户ID获取用户名，您需要根据您的用户模型和数据库结构来编写查询逻辑
        $user = User::find($userId);
Log::info($user);
        if ($user) {
            // 如果找到用户，返回用户姓名
return response()->json(['first_name' => $user->first_name,'last_name' => $user->last_name]);
        } else {
            // 如果未找到用户，返回错误响应
            return response()->json(['error' => 'User not found'], 404);
        }
    }

    // ...
}
