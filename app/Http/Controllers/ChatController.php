<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index(Request $request)
    {
        $chatId = $request->route('chat');
        $chatUser = null; // Переменная для хранения пользователя, с кем ведется чат
        if (request('search')) {
            // Если в запросе есть параметр search, фильтруем пользователей по имени, исключая администраторов
            $users = User::where('name', 'like', '%' . request('search') . '%')
                ->where('role', '!=', 'admin')
                ->get();
        } else {
            // Если параметр search не указан, получаем всех пользователей, исключая администраторов
            $users = User::where('role', '!=', 'admin')->get();
        }

        // Получите список чатов для текущего пользователя
        $chats = Chat::where('user_one', auth()->id())
            ->orWhere('user_two', auth()->id())
            ->get();
        // По умолчанию установите пустой массив сообщений
        $messages = [];

        // Если параметр user_id указан, пытаемся найти или создать чат
        if ($request->has('user_id')) {
            $userId = $request->input('user_id');

            // Проверяем, существует ли уже чат между текущим пользователем и выбранным пользователем
            $chat = Chat::where(function($query) use ($userId) {
                $query->where('user_one', auth()->id())
                    ->where('user_two', $userId);
            })->orWhere(function($query) use ($userId) {
                $query->where('user_two', auth()->id())
                    ->where('user_one', $userId);
            })->first();

            // Если чат не существует, создаем новый
            if (!$chat) {
                $chat = new Chat;
                $chat->user_one = auth()->id();
                $chat->user_two = $userId;
                $chat->save();
            }

            // Получаем сообщения для этого чата
            $messages = Message::where('chat_id', $chat->id)->get();
            // Определяем пользователя, с кем ведется чат
            $chatUser = $chat->user_one === auth()->id() ? User::find($chat->user_two) : User::find($chat->user_one);

            // Возвращаем представление с пользователями и чатами
            return view('chat.chat', [
                'users' => $users,
                'chats' => $chats,
                'messages'=>$messages,
                'chat_id'=>$chat->id,
                'chatUser'=>$chatUser
            ]);
        }elseif (isset($chatId)){
            $chatId = $request->route('chat');
            // Получаем чат по идентификатору
            $chat = Chat::findOrFail($chat);
            // Получаем сообщения для этого чата
            $messages = Message::where('chat_id', $chat->id)->get();
            // Определяем пользователя, с кем ведется чат
            $chatUser = $chat->user_one === auth()->id() ? User::find($chat->user_two) : User::find($chat->user_one);
            // Возвращаем представление с пользователями и чатами
            return view('chat.chat', [
                'users' => $users,
                'chats' => $chats,
                'messages'=>$messages,
                'chat_id'=>$chat->id,
                'chatUser'=>$chatUser
            ]);
        }

        // Возвращаем представление с пользователями и чатами
        return view('chat.chat', [
            'users' => $users,
            'chats' => $chats,
            'messages'=>$messages,
        ]);
    }


    private function isParticipant(Chat $chat)
    {
        return $chat->user_one == Auth::id() || $chat->user_two == Auth::id();
    }


}
