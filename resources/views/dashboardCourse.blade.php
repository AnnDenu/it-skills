<!--Страница отображения курсов с категориями-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Курсы') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="bg-white ">
                        <h2 class="text-2xl font-bold tracking-tight text-center text-gray-900 mt-6 mb-6">Все курсы</h2>

                        {{-- Форма поиска --}}
                        <form class="mt-1">
                            <label for="default-search"
                                   class="mb-1 text-sm font-medium text-gray-900 sr-only dark:text-white">Поиск</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                </div>
                                <input type="search" id="default-search"
                                       class="block w-full p-4 ps-8 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                       name="search" value="{{ request('search') }}" required>
                            </div>
                        </form>
                         <div class="flex items-center justify-center py-4 md:py-8 flex-wrap">
                            @foreach ($categories as $category)
                                <a href="{{route('course.category', $category->id)}}" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300
                                    rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900
                                    dark:focus:ring-blue-800">{{$category->name}}</a>
                            @endforeach
                            <a href="{{route('course.show')}}" class="text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300
                                rounded-full text-base font-medium px-5 py-2.5 text-center mr-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-white-500 dark:bg-gray-900
                                dark:focus:ring-blue-800">Назад</a>
                        </div>
                    </div>
                                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900 dark:text-gray-100">
                                    <div class="bg-white ">
                                        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
                                            <div class="h-50 w-196 grid grid-cols-1 gap-4 content-normal">
                                                <div class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-2 xl:gap-x-8">
                                                    @foreach ($courses as $course)
                                                        <a href="{{ route('cart', $course->id) }}" class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                                                            <div>
                                                                <div class="col-md-4">
                                                                    <img src="{{ Storage::url($course->image) }}" alt="Course Image" class="w-64 h-64 object-cover">
                                                                </div>
                                                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">{{$course->name}}</h2>
                                                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                                                    {{$course->description}}
                                                                </p>
                                                            </div>
                                                        </a>
                                                    @endforeach
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
                                </div>
    @include('layouts.footer')
</x-app-layout>
