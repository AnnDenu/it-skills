<!--Отправка задания преподавателю-->
<x-app-layout>

    @section('content')
        @if (Auth::user()->role == 'teacher')
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                            <div class="py-3 px-4">
                                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                                    {{ __('Задания') }}
                                </h2>
                            </div>
                            <form action="{{ route('works') }}" method="GET" class="w-auto ml-4 mr-4">
                                <div class="col-span-2">
                                    <label for="theme_id"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">К какой
                                        теме?</label>
                                    <select name="theme_id" id=""
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach ($themes as $theme)
                                            <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-4">
                                        Показать задания
                                    </button>
                                </div>
                            </form>
                            <div class="border-t border-gray-200 dark:border-gray-600">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col" class="py-3 px-4 pe-0"></th>
                                            <th class="border border-slate-300 p-5">Пользователь</th>
                                            <th class="border border-slate-300 p-5">На тему</th>
                                            <th class="border border-slate-300 p-5">Файл(Ссылка на документ)</th>
                                            <th class="border border-slate-300 p-5">Описание</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                        @foreach ($works as $work)
                                            <tr>
                                                <td class="py-4 px-4 whitespace-nowrap"></td>
                                                <td class="py-4 px-4 whitespace-nowrap">{{ $work->user->name }}</td>
                                                <td class="py-4 px-4 whitespace-nowrap">{{ $work->theme->name }}</td>
                                                <td class="py-4 px-4 whitespace-nowrap">
                                                    @if ($work->file)
                                                        <a href="{{ Storage::url($work->file) }}"
                                                            class="text-blue-500 hover:underline" target="_blank">
                                                            Скачать файл
                                                        </a>
                                                    @endif
                                                </td>
                                                <td class="py-4 px-4 whitespace-nowrap">{{ $work->content }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="py-3 px-4 border-t border-gray-200 dark:border-gray-600">
                                <!-- Кнопка возврата -->
                                <a href="{{ route('welcome') }}"
                                    class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Вернуться назад
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->role == 'user')
            <div class="bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-6">
                    <!-- Заголовок карточки -->
                    <h1 class="text-center text-2xl">Задания</h1>
                    <!-- Форма загрузки задания -->
                    <form action="{{ route('create.works') }}" method="POST" class="space-y-4"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Название..." required="">
                            </div>
                            <div class="col-span-2">
                                <label for="content"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание</label>
                                <input type="text" name="content" id="content"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Описание..." required="">
                            </div>
                            <div class="col-span-2">
                                <label for="file"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Документ</label>
                                <input type="file" name="file" class="form-control">
                            </div>
                            <div class="col-span-2">
                                <label for="theme_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">К
                                    какой
                                    теме?</label>
                                <select name="theme_id" id="">
                                    @foreach ($themes as $theme)
                                        <option value="{{ $theme->id }}">{{ $theme->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Загрузить
                        </button>
                    </form>
                    <!-- Список заданий для пользователя -->
                    @foreach ($works as $work)
                        <div class="mb-5">
                            <div class="flex flex-row mb-5">
                                <div class=" basis-2/4 lg:p-5 shadow-xl">
                                    <p class="italic hover:not-italic">{{ $work->content }}</p>
                                    <p class="italic hover:not-italic">{{ $work->file }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </x-app-layout>
