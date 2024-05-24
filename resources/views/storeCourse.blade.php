<!--Страница управления курсами-->

<x-app-layout>
    @if (Auth::user()->role == 'admin')
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Курсы') }}
            </h2>
        </x-slot>
        <div class="container mx-auto px-4 py-8">
            <div class="flex flex-col">
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white text-center">
                        Создайте новый курс
                    </h3>
                    <form method="POST" action="{{ route('courses.create') }}" enctype="multipart/form-data"
                        class="p-4 md:p-5">
                        @csrf
                        @method('POST')
                        <div class="grid gap-4 mb-4 grid-cols-2">
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Назначить
                                    преподавателя на курс</label>
                                <select name="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">
                                            {{ $user->name }}
                                            {{ $user->role }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="name"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название</label>
                                <input type="text" name="name" id="name"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    placeholder="Напишите название курса" required="">
                            </div>
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    for="file">Изображение</label>
                                <input
                                    class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="file" type="file" name="image">
                            </div>
                            <div class="col-span-2 sm:col-span-1">
                                <label for="id"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Категория</label>
                                <select name="category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-span-2">
                                <label for="description"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Описание
                                    курса</label>
                                <textarea name="description" id="description" rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Напишите описание курса"></textarea>
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
                            Добавить курс
                        </button>
                        <a href="{{ route('course.show') }}" :active="request() - > routeIs('course.show')"
                            class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Вернуться
                            назад</a>
                    </form>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    <th scope="col" class="py-3 px-4 pe-0">

                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Преподаватель</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Название</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Изображение</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Описание</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Редактирование</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">
                                        Удаление</th>
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
                                @foreach ($courses as $course)
                                    <tr>
                                        <td class="py-3 ps-4">
                                        </td>
                                        <input type="text" name="id" value="{{ $course->id }}" hidden>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $course->user->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            {{ $course->name }}</td>
                                        <td
                                            class="px-6 py-4 whitespace-normal text-sm text-gray-800 dark:text-gray-200">
                                            <img src="{{ Storage::url($course->image) }}" alt="Course Image"
                                                class="w-23 h-23 object-cover">
                                        </td>
                                        <td
                                            class="px-4 py-2 whitespace-normal text-sm text-gray-800 dark:text-gray-200 max-w-0">
                                            {{ $course->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-primary-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-course-update-{{ $course->id }}')">{{ __('Изменить') }}</x-primary-button>

                                            <x-modal name="confirm-course-update-{{ $course->id }}" focusable>
                                                <form method="post" enctype="multipart/form-data"
                                                    action="{{ route('courses.update', $course->id) }}" class="p-6">
                                                    @csrf
                                                    @method('patch')

                                                    <h2
                                                        class="text-lg text-center mt-8 font-medium text-gray-900 dark:text-gray-100">
                                                        Измените данные раздела
                                                    </h2>
                                                    <div>
                                                        <x-input-label for="name" class="me-3"
                                                            :value="__('Преподаватель')" />
                                                        <select name="user_id">
                                                            <option value="{{ $course->user_id }}">
                                                                {{ $course->user->name }}
                                                            </option>
                                                            @foreach ($users as $user)
                                                                <option value="{{ $user->id }}">
                                                                    {{ $user->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" class="me-3 mt-3"
                                                            :value="__('Категория')" />
                                                        <select name="category_id">
                                                            @foreach ($categories as $category)
                                                                <option value="{{ $category->id }}">
                                                                    {{ $category->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" class="me-3 mt-3"
                                                            :value="__('Название')" />
                                                        <x-text-input id="name" name="name" type="text"
                                                            class="mt-1 block w-full" value="{{ $course->name }}" />
                                                    </div>
                                                    <div>
                                                        <x-input-label  for="file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                                            :value="__('Изображение')" />
                                                        <x-text-input  id="file" type="file" name="image"
                                                        class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" />
                                                    </div>
                                                    <div>
                                                        <x-input-label for="name" class="me-3 mt-3"
                                                            :value="__('Описание')" />
                                                        <x-text-input id="description" name="description"
                                                            type="text" class="mt-1 block w-full"
                                                            value="{{ $course->description }}" />
                                                    </div>
                                                    <div class="mt-6 flex justify-end">
                                                        <x-secondary-button class="ms-3 me-3 mb-3"
                                                            x-on:click="$dispatch('close')">
                                                            {{ __('Закрыть') }}
                                                        </x-secondary-button>

                                                        <x-primary-button class="ms-3 me-3 mb-3">
                                                            {{ __('Изменить данные курса') }}
                                                        </x-primary-button>
                                                    </div>
                                                </form>
                                            </x-modal>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-course-deletion-{{ $course->id }}')">{{ __('Удалить') }}</x-danger-button>
                                        </td>
                                        <x-modal name="confirm-course-deletion-{{ $course->id }}" focusable>
                                            <form method="post" action="{{ route('courses.destroy', $course->id) }}"
                                                class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 ms-8">
                                                    {{ __('Вы уверены, что хотите удалить данный курс?') }}
                                                </h2>

                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button class="ms-3 mb-6"
                                                        x-on:click="$dispatch('close')">
                                                        {{ __('Пропустить') }}
                                                    </x-secondary-button>

                                                    <x-danger-button class="ms-3 mb-6 me-3">
                                                        {{ __('Удалить') }}
                                                    </x-danger-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </tr>
                                @endforeach
                                </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
    @else
        У вас нет прав, обращайтесь к администратору!
    @endif
</x-app-layout>
