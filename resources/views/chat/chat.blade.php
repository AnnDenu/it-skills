<x-app-layout>
    <div class="flex h-screen">
        <!-- Список пользователей -->
        <div class="w-1/4 bg-gray-700 text-white overflow-y-auto">
            <div class="p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Пользователи</h2>
                </div>
                <form action="{{ route('chats.index') }}" method="GET">
                    <input type="search" id="default-search" name="search" value="{{ old('search') }}"
                        placeholder="Поиск пользователей">
                    <!-- Кнопка для отправки формы без значения поля поиска -->
                </form>
                <ul>
                    @foreach ($users as $user)
                        <li class="mb-2">
                            <form action="{{ route('chats.index') }}" method="get">
                                @csrf
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <button type="submit"
                                    class="block p-2 rounded hover:bg-gray-600 transition duration-300">
                                    {{ $user->name }}
                                </button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- Окно чата -->
        <div class="flex-1 flex flex-col">
            <!-- Заголовок чата -->
            <div class="bg-gray-700 text-white p-4">
                <h2 class="text-2xl font-bold">Чат с {{ $chatUser->name ?? 'Пользователь' }}</h2>
            </div>
            <!-- Окно чата -->
            <div class="flex-1 bg-gray-600 p-4 overflow-y-auto">
                <!-- Здесь будет отображаться чат -->
                <div class="text-black">
                    <!-- Отображение сообщений в чатах с использованием компонента -->
                    <div class="messages flex flex-col">
                        @foreach ($messages as $message)
                            <div
                                class="message {{ auth()->id() == $message->user_id ? 'ml-auto bg-white text-black' : 'bg-gray-200' }} rounded-lg p-3 mb-2">
                                <p>{{ $message->content }}</p>
                                <div class="flex justify-between items-center mt-1">
                                    <span class="font-semibold">{{ $message->user->name }}</span>
                                    <span
                                        class="timestamp text-xs text-gray-500">{{ $message->created_at->format('H:i') }}</span>
                                </div>
                                @if ($message->file)
                                    <a href="{{ route('download.file', ['filename' => $message->file]) }}"
                                        class="block mt-2 text-blue-500 hover:underline">
                                        Скачать файл
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Форма ввода сообщения -->
            @if (isset($chat_id))
                <div class="bg-gray-800 p-4">
                <form action="{{ route('message.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="chat_id" value="{{ $chat_id }}">
                    <div class="flex">
                        <input type="text" class="flex-1 p-2 rounded mr-2" name="content" placeholder="Type a message...">
                        <input type="file" class="flex-1 p-2 rounded mr-2" name="file">
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition duration-300">Отправить</button>
                    </div>
                </form>
            </div>
        @endif
    </div>
    </div>
</x-app-layout>
