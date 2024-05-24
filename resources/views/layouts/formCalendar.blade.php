<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Расписание</title>
</head>
<div class="container mx-auto px-4 rounded-lg shadow mb-8">
        <h1 class="text-2xl font-bold mb-4">События, которые вы добавили</h1>
        @foreach($shedules as $shedule)
        <div class="mt-8 p-4 bg-white rounded-lg shadow">
            <table class="w-full text-left">
                <tbody>
                    <tr>
                        <th class="w-1/3 px-4 py-2">Дата</th>
                        <td class="px-4 py-2">{{ $shedule->date }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2">Время</th>
                        <td class="px-4 py-2">{{ $shedule->sunrise }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2">Содержимое</th>
                        <td class="px-4 py-2">{{ $shedule->content }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2">Преподаватель</th>
                        <td class="px-4 py-2">{{ $shedule->user->name }}</td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2">Тема</th>
                        <td class="px-4 py-2">{{ $shedule->theme->name }}</td>
                    </tr>
                    <tr>
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-shedule-update-{{ $shedule->id }}')">{{ __('Изменить') }}</x-primary-button>
                                        <x-modal name="confirm-shedule-update-{{ $shedule->id }}"
                                                 focusable>
                                            <form method="post"
                                                  action="{{ route('calendar.update', $shedule->id) }}"
                                                  class="p-6">
                                                @csrf
                                                @method('patch')

                                                <h2
                                                    class="text-lg font-medium text-gray-900 dark:text-gray-100 text-center">
                                                    Измените данные 
                                                </h2>
                                                <div>
                                                    <x-input-label for="sunrise" :value="__('Время')" />
                                                    <x-text-input id="time" name="sunrise" type="sunrise" class="mt-1 block w-full" value="{{$shedule->sunrise}}" />
                                                </div>
                                                <div>
                                                    <x-input-label for="date" :value="__('Дата')" />
                                                    <x-text-input id="date" name="date" type="date" class="mt-1 block w-full" value="{{$shedule->date}}" />
                                                </div>
                                                <div>
                                                    <x-input-label for="content" :value="__('Содержание')" />
                                                    <x-text-input id="text" name="content" type="text" class="mt-1 block w-full" value="{{$shedule->content}}" />
                                                </div>
                                                <div>
                                                    <x-input-label for="name" class="me-3":value="__('Преподаватель')" />
                                                        <select name="user_id">
                                                            <option value="{{ $shedule->user_id }}">
                                                                {{ $shedule->user->name }}
                                                            </option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">
                                                        {{ $user->name }}
                                                    </option>
                                                @endforeach
                                                        </select>
                                                    </div>
                                                <div>
                                                    <x-input-label for="name" class="me-3":value="__('Тема')" />
                                                        <select name="theme_id">
                                                            <option value="{{ $shedule->theme_id }}">
                                                                {{ $theme->name }}
                                                            </option>
                                                        </select>
                                                    </div>
                                                <div class="mt-6 flex justify-end">
                                                    <x-secondary-button
                                                        x-on:click="$dispatch('close')">
                                                        {{ __('Закрыть') }}
                                                    </x-secondary-button>

                                                    <x-primary-button class="ms-3">
                                                        {{ __('Изменить данные ') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        </x-modal>
                    </tr>
                    <tr
                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                        <x-danger-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-shedule-deletion-{{ $shedule->id }}')">{{ __('Удалить') }}</x-danger-button>
                            </td>
                            <x-modal name="confirm-shedule-deletion-{{ $shedule->id }}" focusable>
                            <form method="post"
                            action="{{ route('calendar.destroy', $shedule->id) }}"
                            class="p-6">
                            @csrf
                            @method('delete')
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Вы уверены, что хотите удалить?') }}
                            </h2>
                            <div class="mt-6 flex justify-end">
                            <x-secondary-button
                            x-on:click="$dispatch('close')">
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
            </table>
        </div>
@endforeach
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>