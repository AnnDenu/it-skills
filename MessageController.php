<?php
namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Storage;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // Валидация данных
        $validatedData = $request->validate([
            'chat_id' => 'required|exists:chats,id',
            'content' => 'required|string',
        ]);

        $message = new Message;

        $message->chat_id = $request->chat_id;
        $message->user_id = Auth::id();
        $message->content = $request->content;

        // Загрузка файла, если он был прикреплен
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/messages', $filename);
            $message->file = $filename;
        }

        // Устанавливаем текущее время для поля 'time'
        $message->time = now();

        $message->save();

        // Получаем чат по идентификатору, переданному в запросе, и убеждаемся, что он существует
        $chat = Chat::findOrFail($request->chat_id);

        // Проверяем, является ли текущий аутентифицированный пользователь первым участником чата
        if (auth()->id() == $chat->user_one) {
            $userId = $chat->user_two;
        } else {
            $userId = $chat->user_one;
        }
        // Генерация CSRF-токена
        $token = csrf_token();

        // Создание URL с параметрами
        $url = route('chats.index', ['user_id' => $userId, '_token' => $token]);

        // Выполнение редиректа на URL с параметрами
        return Redirect::to($url);
        //        return redirect()->route('chats.index', ['chat' => $request->chat_id]);
    }

    public function download($filename)
    {
        $path = 'public/messages/' . $filename;

        if (Storage::exists($path)) {
            return Storage::download($path, $filename, [
                'Content-Type' => 'application/octet-stream',
            ]);
        } else {
            abort(404);
        }
    }
}
