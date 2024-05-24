<!--Страница отображения избранного-->
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Избранное') }}
        </h2>
    </x-slot>

    <body>
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <h2 class="text-center text-xl mt-8 font-semibold">Курсы, которые вы добавили</h2>
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 gap-x-8 gap-y-16 sm:gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-1">
                @foreach ($favorites as $favorite)
                    <div
                        class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $favorite->course->name }}</h5>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $favorite->course->description }}
                        </p>
                        @if ($favorite->course)
                            <a href="{{ route('cart', $favorite->course->id) }}"
                                class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Проcмотреть курс
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        @endif
                        <td class="  px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                            <x-danger-button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'confirm-favorite-deletion-{{ $favorite->id }}')">{{ __('Удалить') }}
                                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </x-danger-button>
                        </td>
                        <x-modal name="confirm-favorite-deletion-{{ $favorite->id }}" focusable>
                            <form method="post" action="{{ route('destroy', $favorite->id) }}" class="p-6">
                                @csrf
                                @method('delete')

                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                    {{ __('Удалить из избранного?') }}
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
                    </div>
                @endforeach
                <a href="{{ route('course.show') }}"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Вернуться
                    в каталог курсов</a>
            </div>
        </div>
    </body>
</x-app-layout>
