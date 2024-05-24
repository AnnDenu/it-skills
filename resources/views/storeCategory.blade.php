<!--Страница управления категориями-->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Управление категориями') }}
        </h2>
    </x-slot>
    <div class="relative dark:bg-gray-700 ">
        <div class="flex items-center justify-center p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <form method="POST" action="{{ route('categories.create') }}" class="p-4 md:p-5 ">
                @csrf
                @method('POST')
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Название
                            категории</label>
                        <input type="text" name="name" id="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Категория..." required="">
                    </div>
                </div>
                <button type="submit"
                    class=" text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Добавить категорию
                </button>
            </form>
            <div class="flex flex-col mt-4">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div
                            class="border rounded-lg divide-y divide-gray-200 dark:border-gray-700 dark:divide-gray-700">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
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
                                        @foreach ($categories as $category)
                                            <tr>
                                                <form method="POST" action="{{ route('categories.update', $category->id) }}">
                                                    @csrf
                                                    @method('PATCH')

                                                    <td
                                                        class=" border border-slate-300 px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                        <input type = "text" name="name" value= "{{ $category->name }}">
                                                    </td>
                                                    <td
                                                        class="  px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                        <button type="submit"
                                                            class=" m-2 p-2 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Изменить</button>
                                                    </td>
                                                </form>
                                                <td
                                                    class="  px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                                <x-danger-button
                                                    x-data=""
                                                    x-on:click.prevent="$dispatch('open-modal', 'confirm-category-deletion-{{ $category->id }}')"
                                                >{{ __('Удалить') }}</x-danger-button>
                                                </td>
                                                <x-modal name="confirm-category-deletion-{{ $category->id }}" focusable>
                                                    <form method="post" action="{{ route('categories.destroy', $category->id) }}" class="p-6">
                                                        @csrf
                                                        @method('delete')

                                                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                            {{ __('Вы уверены, что хотите удалить данную категорию?') }}
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
                                        @endforeach
                                        </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('course.show') }}" :active="request() -> routeIs('course.show')"
                    class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 mt-4">Вернуться
                    назад</a>
            </div>
        </div>
    </div>

</x-app-layout>
