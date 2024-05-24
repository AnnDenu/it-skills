<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">Чат</h1>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7lx mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-6 text-gray-900">

                        <ul>
                            @foreach ($users as $user)
                                <a href="{{ route('chat.messages', ['user' => $user->id]) }}">
                                    <li
                                        class ="py-6 shadow appearance-none text-center border rounded  px-3 text-gray-600  focus:outline-none focus:shadow-outline">

                                        {{ $user->name }}

                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-8">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
