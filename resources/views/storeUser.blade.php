
<!--Страница управления пользователями-->
@if (Auth::user()->role == 'admin')
<x-app-layout>
        <h6 class="mt-6 text-2xl font-semibold text-gray-900 dark:text-white text-center my-8">Управление пользователями</h6>
    <form action="{{ route('users.search') }}" method="GET" class="mb-3 ms-9 me-9">
        <div class="flex items-center">
            <input type="text" name="search" value="{{ old('search') }}" placeholder="Поиск пользователей" class="px-4 py-2 border border-gray-300 rounded-md mr-2 w-full">
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Поиск</button>
        </div>
    </form>
    <form action="{{ route('storeUser') }}" method="GET">
        <button type="submit" class=" ms-9 text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Вернуть всех</button>
    </form>
        <div class="mt-8 flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-8 ms-8 me-8">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    ФИО
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Email
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Роль
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Пароль
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Редактирование
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Удаление
                                </th>
                            </tr>
                            </thead>
                            @if ($users->isNotEmpty())
                            @foreach ($users as $user)
                                <tbody>
                                <tr
                                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $user->name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->role }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user->password }}
                                    </td>

                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <x-primary-button x-data=""
                                                          x-on:click.prevent="$dispatch('open-modal', 'confirm-user-update-{{ $user->id }}')">{{ __('Изменить') }}</x-primary-button>

                                        <x-modal name="confirm-user-update-{{ $user->id }}"
                                                 focusable>
                                            <form method="post"
                                                  action="{{ route('users.update', $user->id) }}"
                                                  class="p-6">
                                                @csrf
                                                @method('patch')

                                                <h2
                                                    class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                                                    Измените данные раздела
                                                </h2>
                                                <div>
                                                    <x-input-label for="name" :value="__('ФИО')" />
                                                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"  />
                                                </div>
                                                <div>
                                                    <x-input-label for="email" :value="__('Email')" />
                                                    <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" />
                                                </div>
                                                <div>
                                                    <x-input-label for="password" :value="__('Password')" />
                                                    <x-text-input id="password" name="password" type="password" class="mt-1 block w-full"" />
                                                </div>
                                                <div>
                                                    <x-input-label for="name" :value="__('Роль')" />
                                                    <select name="role" id="name" class="mt-1 block w-full">
                                                        <option value="{{$user->role}}">
                                                            @if($user->role == 'user')
                                                                User
                                                            @else
                                                                Teacher
                                                            @endif
                                                        </option>
                                                        <option value="teacher">Teacher</option>
                                                        <option value="admin">Admin</option>
                                                        <option value="user">User</option>
                                                    </select>
                                                </div>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button
                                                        x-on:click="$dispatch('close')">
                                                        {{ __('Закрыть') }}
                                                    </x-secondary-button>

                                                    <x-primary-button class="ms-3">
                                                        {{ __('Изменить данные пользователя') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>
                                    </td>
                                    <td class="  px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <x-danger-button x-data=""
                                                         x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion-{{ $user->id }}')">{{ __('Удалить') }}</x-danger-button>
                                    </td>
                                    <x-modal name="confirm-user-deletion-{{ $user->id }}" focusable>
                                        <form method="post" action="{{ route('users.destroy', $user->id) }}"
                                              class="p-6">
                                            @csrf
                                            @method('delete')

                                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                                {{ __('Вы уверены, что хотите удалить данного пользователя?') }}
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
                                </tbody>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
            <x-primary-button x-data="" class="mt-8 ms-8"
                              x-on:click.prevent="$dispatch('open-modal', 'confirm-user-create-{{ $user->id }}')">{{ __('Добавить') }}</x-primary-button>

            <x-modal name="confirm-user-create-{{ $user->id }}"
                     focusable>
                <form method="post"
                      action="{{ route('create.user', $user->id) }}"
                      class="p-6">
                    @csrf
                    @method('post')
                    <h2
                        class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                        Добавьте нового пользователя
                    </h2>
                    <div>
                        <x-input-label for="name" :value="__('ФИО')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" hint="Email" />
                    </div>
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" hint="Email" />
                    </div>
                    <div>
                        <x-input-label for="password" :value="__('Пароль')" />
                        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" hint="Password" />
                    </div>
                    <div>
                        <x-input-label for="name" :value="__('Роль')" />
                        <select name="role" id="name" class="mt-1 block w-full">
                            <option value="{{$user->role}}">
                                @if($user->role == 'user')
                                    User
                                @else
                                    Teacher
                                @endif
                            </option>
                            <option value="teacher">Teacher</option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <x-secondary-button
                            x-on:click="$dispatch('close')">
                            {{ __('Закрыть') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-1">
                            {{ __('Добавить') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        </div>
    @else
        Нет пользователей.
    @endif

    @else
        Вы не имеете доступ к этому разделу
    @endif
</x-app-layout>
