<!--Страница карточки курса-->

<x-app-layout>
    <div class="overflow-hidden bg-dark:blue-400 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-1">
                <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                    <div class="mr-auto place-self-center lg:col-span-7">

                        <h1
                            class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                            {{ $course->name }}
                        </h1>
                        <p
                            class="max-w-2xl mb-4 text-4xl font-semibold tracking-tight leading-none md:text-5xl xl:text-xl dark:text-white">
                            Преподаватель: {{ $course->user->name }}
                        </p>
                        <p
                            class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                            После прохождения курса:</p>
                        <p
                            class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                            {{ $course->description }}
                        </p>
                    </div>
                    <div class="lg:col-span-5">
                        <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image" class="w-full h-auto">
                    </div>
                    <!--Testimonial-->
                    <div class="md:flex md:flex-row">
                        <div class="md:ml-6">

                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:pr-8 lg:pt-4">
                <p class="text-4xl text-gray-900 dark:text-gray-600 my-8"> Программа курса </p>
                @foreach ($chapters as $chapter)
                    <div class="relative mb-3">
                        <h6 class="mb-0">
                            <button
                                class="relative flex items-center w-full p-4 font-semibold text-2xl text-left transition-all ease-in border-b border-solid cursor-pointer border-slate-100 text-slate-700 rounded-t-1 group text-dark-500"
                                data-collapse-target="animated-collapse-{{ $chapter->id }}">
                                <span>{{ $chapter->name }}</span>
                                <i
                                    class="absolute right-0 pt-1 text-base transition-transform fa fa-chevron-down group-open:rotate-180"></i>
                            </button>
                        </h6>
                        <div data-collapse="animated-collapse-{{ $chapter->id }}"
                            class="h-0 overflow-hidden transition-all duration-300 lease-in-out">
                            <div class="p-4 text-sm leading-normal text-blue-gray-500/80 flex flex-wrap">
                                <div class="w-full pr-4">
                                    <div class="bg-white shadow-md rounded-lg p-6">
                                        <p class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-400">
                                            {{ $chapter->content }}
                                        </p>
                                        {{-- <div id="sortable"> --}}
                                        @foreach ($chapter->theme as $theme)
                                            <div class="bg-gray-100 rounded-lg p-4 my-4" data-id="{{ $theme->id }}">
                                                <p class="text-lg font-semibold mb-2 text-gray-800">
                                                    {{ $theme->content }} - {{ $theme->type_of_activity }}
                                                </p>
                                                @if (auth()->check())
                                                    @if (Auth::user()->role === 'teacher' ||
                                                            Auth::user()->role === 'admin' ||
                                                            // wherePivot - метод, который фильтрует связи по значению поля course_id в промежуточной таблиц
                                                            Auth::user()->courses()->wherePivot('course_id', $course->id)->exists())
                                                        <a href="{{ route('themes.download', $theme->id) }}"
                                                            class="text-lime-700 block mt-2">Скачать документ</a>
                                                    @endif
                                                @endif
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
                                            </div>
                                        @endforeach
                                        {{-- </div> --}}

                                        {{-- <button id="saveOrder"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Сохранить
                                            порядок</button> --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            @if (Auth::check())
                {{-- Если пользователь уже добавил курс, то возвращает страницу без кнопки --}}

                @if (!$userCourse)
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-course')"
                        class="bg-customBlue hover:bg-customBlue-dark">{{ __('Начать обучение') }}</x-primary-button>


                    {{--  не пуст ли массив ошибок, связанных с добавлением курса в ЛК --}}
                    <x-modal name="confirm-user-course" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('addCourse.to.cart', $course->id) }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Начать обучение по курсу?') }}
                            </h2>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Отмена') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Начать') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                @endif
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
                @if (!$favourite)
                    <x-primary-button x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-favourite')">{{ __('Добавить в избранное') }}</x-primary-button>

                    <x-modal name="confirm-user-favourite" :show="$errors->userDeletion->isNotEmpty()" focusable>
                        <form method="post" action="{{ route('update', $course->id) }}" class="p-6">
                            @csrf

                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Добавить курс в избранное?') }}
                            </h2>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    {{ __('Отмена') }}
                                </x-secondary-button>

                                <x-primary-button class="ms-3">
                                    {{ __('Добавить') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </x-modal>
                @endif
            @endif
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1
                    class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                    Как проходит обучение</h1>
            </div>
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex float-left">
                <img src="https://static.tildacdn.com/tild6232-6339-4733-a562-323335306561/casual-life-3d-works.png"
                    alt="mockup">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <section class="rounded-md p-6 text-center md:p-12 md:text-left">
                    <div class="flex justify-center">
                        <div class="max-w-3xl">
                            <div class="m-4 block rounded-lg bg-lightblue p-6 dark:bg-neutral-800 dark:shadow-black/20">
                                <!--Testimonial-->
                                <div class="md:flex md:flex-row">
                                    <div class="md:ml-6">
                                        <p class="mb-2 text-3xl font-semibold text-neutral-800 dark:text-neutral-200">
                                            Онлайн-платформа для обучения и выполнения заданий
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex float-left">
                <img src="https://static.tildacdn.com/tild6666-3035-4561-b833-366364666532/casual-life-3d-boy-s.png"
                    alt="mockup">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <section class="rounded-md p-6 text-center md:p-12 md:text-left">
                    <div class="flex justify-center">
                        <div class="max-w-3xl">
                            <div class="m-4 block rounded-lg bg-lightblue p-6 dark:bg-neutral-800 dark:shadow-black/20">
                                <!--Testimonial-->
                                <div class="md:flex md:flex-row">
                                    <div class="md:ml-6">
                                        <div class="mb-2 text-3xl font-semibold text-neutral-800 dark:text-neutral-200">
                                            Связь с преподавателем
                                            <p>(Преподаватель расскажет вам весь материал)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex float-left">
                <img src="https://framerusercontent.com/images/bszDs0Tq8EpSiDfDgCRU3RulA.png" alt="mockup">
            </div>
            <div class="mr-auto place-self-center lg:col-span-7">
                <section class="rounded-md p-6 text-center md:p-12 md:text-left">
                    <div class="flex justify-center">
                        <div class="max-w-3xl">
                            <div class="m-4 block rounded-lg bg-lightblue p-6 dark:bg-neutral-800 dark:shadow-black/20">
                                <!--Testimonial-->
                                <div class="md:flex md:flex-row">
                                    <div class="md:ml-6">
                                        <p class="mb-2 text-3xl font-semibold text-neutral-800 dark:text-neutral-200">
                                            Чат с другими обучающимися
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <section class="bg-white dark:bg-gray-900 py-8 lg:py-16 antialiased">
            <div class="max-w-2xl mx-auto px-4">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg lg:text-2xl font-bold text-gray-900 dark:text-white">Оставьте свой отзыв</h2>
                </div>
                <form class="mb-6" method="post" action="{{ route('review.course', ['id' => $course->id]) }}">
                    @csrf
                    <div
                        class="py-2 px-4 mb-4 bg-white rounded-lg rounded-t-lg border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
                        <textarea name="text" id="body" rows="6"
                            class="px-0 w-full text-sm text-gray-900 border-0 focus:ring-0 focus:outline-none dark:text-white dark:placeholder-gray-400 dark:bg-gray-800"
                            placeholder="Напишите отзыв..." required></textarea>
                    </div>
                    <button
                        class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Добавить</button>

                </form>
                @foreach ($reviews as $review)
                    @if ($review->course_id == $course->id)
                        <article class="p-6 text-base bg-white rounded-lg dark:bg-gray-900 max-w-2xl mx-auto">
                            <footer class="flex justify-between items-center mb-2">
                                <div class="flex items-center">
                                    <p
                                        class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white font-semibold">
                                        {{ $review->user()->first()->name }}</p>
                                </div>
                            </footer>
                            <p class="text-gray-500 dark:text-gray-400">{{ $review->text }}</p>
                            <div class="flex items-center mt-4 space-x-4">
                                <button type="button"
                                    class="flex items-center text-sm text-gray-500 hover:underline dark:text-gray-400 font-medium">
                                    <svg class="mr-1.5 w-3.5 h-3.5" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                                    </svg>
                                    Ответить
                                </button>
                                @if (auth()->check() && (auth()->user()->role == 'admin' || auth()->user()->id == $review->user_id))
                                    <form method="post" action="/reviews/{{ $review->id }}/destroy">
                                        @csrf
                                        @method('delete')
                                        <button
                                            class="bg-transparent hover:bg-rose-600 text-rose-700 font-semibold hover:text-white py-1 px-3 border border-rose-500 hover:border-transparent rounded place-items-end">Удалить</button>
                                    </form>
                                @endif
                            </div>
                        </article>
                    @endif
                @endforeach
            </div>
            <script src="node_modules/@material-tailwind/html/scripts/collapse.js"></script>
            <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>

            @include('layouts.footer')
</x-app-layout>
