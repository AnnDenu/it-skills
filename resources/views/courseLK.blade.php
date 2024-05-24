<!--Страница карточки курса-->
@extends('layouts.lk')
@section('content')
    <div class="overflow-hidden bg-dark:blue-400 sm:py-5">
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
                        <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                            Описание: {{ $course->description }}
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
                                        @foreach ($chapter->theme as $theme)
                                            <div class="bg-gray-100 rounded-lg p-4 my-4 flex justify-between items-center"
                                                data-id="{{ $theme->id }}">
                                                <div>
                                                    <p class="text-lg font-semibold mb-2 text-gray-800">
                                                        {{ $theme->content }} - {{ $theme->type_of_activity }}
                                                    </p>
                                                    @if (auth()->check())
                                                        @if (Auth::user()->role === 'teacher' ||
                                                                Auth::user()->role === 'admin' ||
                                                                Auth::user()->courses()->wherePivot('course_id', $course->id)->exists())
                                                            <a href="{{ route('themes.download', $theme->id) }}"
                                                                class="text-lime-700 block mt-2">Скачать документ</a>
                                                        @endif
                                                    @endif
                                                </div>
                                                <div>
                                                    @if (auth()->check())
                                                    <a href="{{ route('theme.lk', $theme->id) }}"
                                                        class="text-blue-500 hover:text-blue-700 font-semibold">Подробнее</a>
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('[data-collapse-target]').on('click', function() {
                var target = $(this).attr('data-collapse-target');
                $(`[data-collapse="${target}"]`).toggleClass('h-0');
                $(this).find('i').toggleClass('rotate-180');
            });
        });
    </script>
@endsection
