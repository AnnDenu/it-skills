@extends('layouts.lk')
@section('content')
    <div class="overflow-hidden bg-dark:blue-400 sm:py-5">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-4 text-xl font-extrabold tracking-tight leading-none md:text-3xl xl:text-3xl dark:text-white">
                        {{ $theme->name }}
                    </h1>
                    <p class="max-w-xl mb-4 text-base md:text-lg lg:text-xl dark:text-white"
                        style="overflow-wrap: break-word;">
                        Описание: {{ $theme->content }}
                    </p>
                    <p class="max-w-xl mb-2 font-light text-gray-500 lg:mb-4 md:text-lg lg:text-xl dark:text-gray-400">
                        Тип: {{ $theme->type_of_activity }}
                    </p>
                    <p class="max-w-xl mb-2 font-light text-gray-500 lg:mb-4 md:text-lg lg:text-xl dark:text-gray-400">
                        Какому разделу принадлежит: {{ $theme->chapter->name }}
                    </p>
                    @if (auth()->check())
                        <a href="{{ route('themes.download', $theme->id) }}" class="text-lime-700 block mt-2">Скачать
                            документ</a>
                    @endif
                </div>
                <div class="lg:col-span-5 bg-white shadow-md rounded-lg p-4 my-4">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-400 text-center">Запланированные
                        мероприятия</h2>
                    <!-- Форма для расписания -->
                    <form action="" method="POST">
                        @foreach ($theme->shedule as $shedule)
                            <div class="bg-white shadow-md rounded-lg p-4 my-4">
                                <h3 class="text-lg font-semibold mb-2 text-gray-800">
                                    {{ \Carbon\Carbon::parse($shedule->date)->formatLocalized('%d %B %Y') }}
                                </h3>
                                <p class="text-gray-700 mb-1">Время:
                                    {{ $shedule->sunrise }}</p>
                                <p class="text-gray-700">Содержание:
                                    {{ $shedule->content }}</p>
                            </div>
                        @endforeach
                    </form>
                </div>
                <div class="lg:col-span-5 bg-white shadow-md rounded-lg p-4 my-4">
                    <h2 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-400 text-center">Задания
                    </h2>
                    <!-- Форма загрузки задания -->
                    <form action="{{ route('create.works', ['id' => $themeId]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="grid gap-4 mb-4 grid-cols-2">
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
                </div>
            </div>
            </form>
            <div class="mb-4">
                <a href="{{ url()->previous() }}"
                    class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Вернуться
                    назад</a>
            </div>
        </div>

    </div>
    </div>
    </div>
@endsection
