<!--Страница управления разделами-->
<x-app-layout>
    @if (Auth::user()->role == 'teacher' || Auth::user()->role == 'admin')
        <div class="flex flex-col md:flex-row justify-between h-full">
            <div class="flex flex-col w-full p-4">
                <x-slot name="header">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight text-center">
                        {{ __('Управление разделами') }}
                    </h2>
                </x-slot>
                <div class="text-center mt-4">
                    <a href="{{ route('course.show') }}" :active="request() - > routeIs('course.show')"
                        class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Вернуться
                        назад</a>
                </div>
                <form action="{{ route('chapters.create') }}" class="p-4 md:p-5" method="post">
                    @csrf
                    @method('post')
                    <div class="grid gap-4 mb-4 grid-cols-1 md:grid-cols-2">
                        <div class="col-span-2">
                            <label for="name"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                            <input type="text" name="name" id="name"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                placeholder="Название раздела" required="">
                        </div>
                        <div class="col-span-2 sm:col-span-2">
                            <label for="id"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Курс</label>
                            <select name="course_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">
                                        {{ $course->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-span-2">
                            <label for="content"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание
                                раздела</label>
                            <textarea name="content" id="content" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Описание раздела"></textarea>
                        </div>
                        <div class="col-span-2">
                            <label for="content"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Редактор</label>
                            <select name="editor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }}
                                        {{ $user->role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class=" text-white inline-flex items-left bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            Добавить раздел
                        </button>
                </form>
            </div>
            <div class="flex flex-col w-full p-4 md:mt-0 mt-4">
                <form action="{{ route('chapters') }}" method="GET" class="flex flex-col space-y-2">
                    <label for="course_id" class="font-semibold">По курсам:</label>
                    <select name="course_id" id="course_id" class="border border-gray-300 rounded-md p-2">
                        <option value="" {{ is_null(request('course_id')) ? 'selected' : '' }}>Все курсы</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}"
                                {{ request('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    <label for="search" class="font-semibold">Поиск разделов:</label>
                    <input type="text" name="search" id="search" class="border border-gray-300 rounded-md p-2"
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="bg-blue-500 text-white rounded-md p-2 hover:bg-blue-600">Фильтр</button>
                </form>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="py-3 px-4 pe-0">
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Название раздела</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Курс</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Описание раздела</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Создатель</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Редактор</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                    Управление</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @foreach ($chapters as $chapter)
                                <tr>
                                    <form method="POST" action="{{ route('chapters.update', $chapter->id) }}">
                                        @csrf
                                        @method('PATCH')
                                        <td class="py-3 ps-4">
                                        </td>
                                        <input type="text" name="id" value="{{ $chapter->id }}" hidden>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $chapter->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $chapter->course->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $chapter->content }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $chapter->creators->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $chapter->editors->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-primary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-chapter-update-{{ $chapter->id }}')">{{ __('Изменить') }}</x-primary-button>

                                            <x-modal name="confirm-chapter-update-{{ $chapter->id }}" focusable>
                                                <form method="post"
                                                    action="{{ route('chapters.update', $chapter->id) }}"
                                                    class="p-6">
                                                    @csrf
                                                    @method('patch')

                                                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                        Измените данные раздела
                                                    </h2>

                                                    <div>
                                                        <x-input-label for="name" :value="__('Название')" />
                                                        <x-text-input id="name" name="name" type="text"
                                                            class="mt-1 block w-full" value="{{ $chapter->name }}" />
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" :value="__('Какой курс?')" />
                                                        <select name="course_id" class="mt-1 block w-full">
                                                            @foreach ($courses as $course)
                                                                <option value="{{ $course->id }}">
                                                                    {{ $course->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" :value="__('Описание')" />
                                                        <x-text-input id="content" name="content" type="text"
                                                            class="mt-1 block w-full"
                                                            value="{{ $chapter->content }}" />
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" :value="__('Создатель')" />
                                                        <x-text-input id="creator" name="creator" type="text"
                                                            class="mt-1 block w-full"
                                                            value="{{ $chapter->creator }}" />
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" :value="__('Редактор')" />
                                                        <x-text-input id="name" name="editor" type="text"
                                                            class="mt-1 block w-full"
                                                            value="{{ $chapter->editor }}" />
                                                    </div>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button x-on:click="$dispatch('close')">
                                                            {{ __('Закрыть') }}
                                                        </x-secondary-button>

                                                        <x-primary-button class="ms-3">
                                                            {{ __('Изменить данные темы') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                    </form>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <x-danger-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-chapter-deletion-{{ $chapter->id }}')">{{ __('Удалить') }}</x-danger-button>
                                    </td>
                                    <x-modal name="confirm-chapter-deletion-{{ $chapter->id }}" focusable>
                                        <form method="post" action="{{ route('chapter_destroy', $chapter->id) }}"
                                            class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Вы уверены, что хотите удалить данный раздел?') }}
                                            </h2>

                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Пропустить') }}
                                                </x-secondary-button>

                                                <x-danger-button class="ms-3">
                                                    {{ __('Удалить') }}
                                                </x-danger-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                    </td>
                                </tr>
                            @endforeach
                            </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center">
                У вас нет прав!
            </div>
        @endif
    </x-app-layout>
