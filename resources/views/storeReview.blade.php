<!--Страница управления отзывами-->
<x-app-layout>
    @if (Auth::user()->role == 'admin')
        <h6 class="mt-6 text-2xl font-semibold text-gray-900 dark:text-white text-center my-8">Управление отзывами</h6>
        <div class="mt-8 flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Содержимое отзыва
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Отправитель
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Редактирование
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Удаление
                                    </th>
                                </tr>
                            </thead>
                            @foreach ($reviews as $review)
                                <tbody>
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $review->text }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $review->user()->first()->name }}
                                        </td>
                                        <td
                                        class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <x-primary-button x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'confirm-review-update-{{ $review->id }}')">{{ __('Изменить') }}</x-primary-button>

                                        <x-modal name="confirm-review-update-{{ $review->id }}"
                                            focusable>
                                            <form method="post"
                                                action="{{ route('reviews.update', $review->id) }}"
                                                class="p-6">
                                                @csrf
                                                @method('patch')

                                                <h2
                                                    class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                                                    Измените данные раздела
                                                </h2>
                                                <div>
                                                    <x-input-label for="text" :value="__('ФИО')" />
                                                    <x-text-input id="text" name="text" type="text" class="mt-1 block w-full" value="{{$review->text}}" />
                                                </div>
                                                <div>
                                                    <x-input-label for="user" :value="__('Отправитель')" />
                                                    <x-text-input id="user" name="user" type="user" class="mt-1 block w-full" value="{{$review->user()->first()->name}}" />
                                                </div>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button
                                                        x-on:click="$dispatch('close')">
                                                        {{ __('Закрыть') }}
                                                    </x-secondary-button>

                                                    <x-primary-button class="ms-3">
                                                        {{ __('Изменить данные отзыва') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                        <td class="  px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <x-danger-button x-data=""
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-review-deletion-{{ $review->id }}')">{{ __('Удалить') }}</x-danger-button>
                                        </td>
                                        <x-modal name="confirm-review-deletion-{{ $review->id }}" focusable>
                                            <form method="post" action="{{ route('reviews.destroy', $review->id) }}"
                                                class="p-6">
                                                @csrf
                                                @method('delete')

                                                <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                    {{ __('Вы уверены, что хотите удалить?') }}
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
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    @else
        Вы не имеете доступ к этому разделу
    @endif
</x-app-layout>
