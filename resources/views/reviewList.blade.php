<!--Страница отображения курсов с категориями-->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Отзывы') }}
        </h2>
    </x-slot>

    <body>
        <div class="container mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold mb-4">Все отзывы</h1>
            <div class="flex justify-between mb-8">
                <form class="mb-8" action="{{ route('review.list') }}" method="GET">
                    @csrf
                    <select class="block w-full p-2 border border-gray-300 rounded-md" name="course_id" id="course_id">
                        <option value="">Все курсы</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}" {{ $selectedCourse == $course->id ? 'selected' : '' }}>
                                {{ $course->name }}
                            </option>
                        @endforeach
                    </select>
                    <button class="flex-1 px-4 py-2 bg-blue-500 text-white rounded-md mt-4"
                        type="submit">Фильтр</button>
                </form>

                <form class="flex-4" action="{{ route('review.list') }}" method="GET">
                    @csrf
                    <button
                        class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800"
                        type="submit">Вернуть обратно все отзывы</button>
                </form>
            </div>
            @if ($reviews->isNotEmpty())
                <ul class="space-y-2">
                    @foreach ($reviews as $review)
                        <li class="p-2 border border-gray-300 rounded-md">
                            <h2 class="text-xl font-bold mb-2">{{ $review->user->name }}</h2>
                            <p class="text-gray-600">Курс: {{ $review->course->name }}</p>
                            <p class="text-gray-600">Отзыв: {{ $review->text }}</p>
                            @if (auth()->check() && (auth()->user()->id === $review->user_id || auth()->user()->role === 'admin'))
                                <form method="post" action="/reviews/{{ $review->id }}/destroy">
                                    @csrf
                                    @method('delete')
                                    <button type="submit"
                                        class="bg-transparent hover:bg-rose-600 text-rose-700 font-semibold hover:text-white py-1 px-3 border border-rose-500 hover:border-transparent rounded place-items-end">Удалить</button>
                                </form>
                                <x-primary-button x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-review-update-{{ $review->id }}')">{{ __('Изменить') }}</x-primary-button>

                                    <x-modal name="confirm-review-update-{{ $review->id }}" focusable>
                                        <form method="POST" action="{{ route('reviews.update', $review->id) }}" class="p-6">
                                            @csrf
                                            @method('PATCH')
                                    
                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                                                Измените данные раздела
                                            </h2>
                                            <div>
                                                <x-input-label for="text" :value="__('Содержание')" />
                                                <x-text-input id="text" name="text" type="text" class="mt-1 block w-full" :value="old('text', $review->text)" />
                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Закрыть') }}
                                                </x-secondary-button>
                                    
                                                <x-primary-button class="ms-3">
                                                    {{ __('Изменить данные') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-600">Пользователи не писали отзывы..(</p>
            @endif
        </div>
    </body>
</x-app-layout>
