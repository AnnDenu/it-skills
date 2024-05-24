<x-app-layout>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Расписание') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Добавить в расписание</h1>
    <form action="{{ route('calendar.create') }}" method="POST" class="space-y-4" >
        @csrf
        <div>
            <label for="sunrise" class="block text-sm font-medium text-gray-700">Время начала</label>
            <input type="time" name="sunrise" id="sunrise" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
        </div>
        <div>
            <label for="date" class="block text-sm font-medium text-gray-700">Дата</label>
            <input type="date" name="date" id="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                  </div>
        <div>
            <label for="content" class="block text-sm font-medium text-gray-700">Содержимое</label>
            <textarea name="content" id="content" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required></textarea>
        </div>
        <div>
            <label for="user_id" class="block text-sm font-medium text-gray-700">Преподаватель</label>
            <select name="user_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                        {{ $user->name }}
                        </option>
                    @endforeach
                </select>
        </div>
        <div>
            <label for="theme_id" class="block text-sm font-medium text-gray-700">Тема</label>
            <select name="theme_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @foreach ($themes as $theme)
                            <option value="{{ $theme->id }}">
                        {{ $theme->name }}
                        </option>
                    @endforeach
                </select>
        </div>
        <div>
            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Добавить</button>
        </div>
    </form>
</div>
        @extends('layouts.formCalendar')
        <script>
            const datepicker = flatpickr("#date-picker", {});
            const calendarContainer = datepicker.calendarContainer;
            const calendarMonthNav = datepicker.monthNav;
            const calendarNextMonthNav = datepicker.nextMonthNav;
            const calendarPrevMonthNav = datepicker.prevMonthNav;
            const calendarDaysContainer = datepicker.daysContainer;

            calendarContainer.className = `${calendarContainer.className} bg-white p-4 border border-blue-gray-50 rounded-lg shadow-lg shadow-blue-gray-500/10 font-sans text-sm font-normal text-blue-gray-500 focus:outline-none break-words whitespace-normal`;

            calendarMonthNav.className = `${calendarMonthNav.className} flex items-center justify-between mb-4 [&>div.flatpickr-month]:-translate-y-3`;

            calendarNextMonthNav.className = `${calendarNextMonthNav.className} absolute !top-2.5 !right-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

            calendarPrevMonthNav.className = `${calendarPrevMonthNav.className} absolute !top-2.5 !left-1.5 h-6 w-6 bg-transparent hover:bg-blue-gray-50 !p-1 rounded-md transition-colors duration-300`;

            calendarDaysContainer.className = `${calendarDaysContainer.className} [&_span.flatpickr-day]:!rounded-md [&_span.flatpickr-day.selected]:!bg-gray-900 [&_span.flatpickr-day.selected]:!border-gray-900`;
        </script>

        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
</x-app-layout>
