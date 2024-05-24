@extends('layouts.lk')

<h1>Обучение</h1>
@section('content')
    @if ($courses)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mt-3">
            @foreach ($courses as $course)
                <div class="bg-white shadow-md rounded p-4">
                    <h2 class="text-xl font-bold mb-2">Название: {{ $course->name }}</h2>
                    <p class="text-gray-600">Преподаватель: {{ $course->user->name }}</p>
                    <p class="text-gray-600">Описание: {{ $course->description }}</p>
                    <div class="mt-4">
                        <a href="{{ route('course.lk', $course->id) }}"
                            class="text-blue-500 hover:text-blue-700 font-semibold">Подробнее</a>
                        @auth
                            <!-- Проверяем, является ли пользователь владельцем связи с курсом -->
                            @if (auth()->user()->courses()->where('course_id', $course->id)->exists())
                                <x-danger-button class="ms-3" x-data=""
                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-cart-deletion-{{ $course->id }}')">{{ __('Удалить') }}</x-danger-button>
                                <x-modal name="confirm-cart-deletion-{{ $course->id }}" focusable>
                                    <form method="post" action="{{ route('deleteCourse', $course->id) }}" class="p-6">
                                        @csrf
                                        @method('delete')

                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                            {{ __('Вы уверены, что хотите удалить из личного кабинета?') }}
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
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Вы не добавили курсы</p>
    @endif
@endsection
