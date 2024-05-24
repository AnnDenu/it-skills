<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('welcome') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('course.show')" :active="request()->routeIs('course.show')">
                        {{ __('Курсы') }}
                    </x-nav-link>
                    <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                        {{ __('О нас') }}
                    </x-nav-link>
                    <x-nav-link :href="route('review.list')" :active="request()->routeIs('review.list')">
                        {{ __('Отзывы') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="flex items-center lg:order-2 ms-9">
                @if (Route::has('login'))
                    @auth
                    @else
                        <a href="{{ route('login') }}"
                            class="text-white bg-gradient-to-r from-teal-400 via-teal-500 to-teal-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-teal-300 dark:focus:ring-teal-800 shadow-lg shadow-teal-500/50 dark:shadow-lg dark:shadow-teal-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Авторизация</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="text-white bg-gradient-to-r from-cyan-400 via-cyan-500 to-cyan-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 shadow-lg shadow-cyan-500/50 dark:shadow-lg dark:shadow-cyan-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Регистрация</a>
                        @endif
                    @endauth
                @endif
            </div>
            {{--  --}}
            @if (Auth::check())

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-6 ">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger" class="ms-8">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <img src="{{ Auth::user()->avatar }}" alt="User Avatar"
                                    style="width:40px; background-color:lavender;">
                                <div class="ms-3">{{ Auth::user()->name }}</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @if (Auth::user()->role == 'user')
                                <x-dropdown-link :href="route('student.index')">
                                    {{ __('Личный кабинет') }}
                                </x-dropdown-link>
                            @endif
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Управление профилем') }}
                            </x-dropdown-link>
                            <!--Доступ только администратору с преподавателем-->
                            @if (Auth::user()->role == 'admin')
                                <x-dropdown-link :href="route('categories')">
                                    {{ __('Управление категориями') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('courses')">
                                    {{ __('Управление курсами') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('storeUser')">
                                    {{ __('Управление пользователями') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('chapters')">
                                    {{ __('Управление разделами') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('themes')">
                                    {{ __('Управление темами') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('calendar')">
                                    {{ __('Расписание') }}
                                </x-dropdown-link>
                            @endif
                            @if (Auth::user()->role == 'teacher')
                                <x-dropdown-link :href="route('chapters')">
                                    {{ __('Управление разделами') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('themes')">
                                    {{ __('Управление темами') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('chats.index')">
                                    {{ __('Чаты') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('calendar')">
                                    {{ __('Расписание') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('works')" :active="request()->routeIs('works')">
                                    {{ __('Задания') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('works')" :active="request()->routeIs('works')">
                                    {{ __('Участники') }}
                                </x-dropdown-link>
                            @endif
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                               this.closest('form').submit();">
                                    {{ __('Выйти') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
        </div>
    </div>
    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="px-4">
            <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
            <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
        </div>
        <div class="pt-2 pb-3 space-y-1">
            @if (Auth::user()->role == 'admin')
            <x-responsive-nav-link :href="route('categories')" :active="request()->routeIs('categories')">
                {{ __('Управление категориями') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('courses')" :active="request()->routeIs('courses')">
                {{ __('Управление курсами') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('storeUser')" :active="request()->routeIs('storeUser')">
                {{ __('Управление пользователями') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('chapters')" :active="request()->routeIs('chapters')">
                {{ __('Управление разделами') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('themes')" :active="request()->routeIs('themes')">
                {{ __('Управление темами') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('review.list')" :active="request()->routeIs('review.list')">
                {{ __('Управление отзывами') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                {{ __('Расписание') }}
            </x-responsive-nav-link>
            @endif
            @if (Auth::user()->role == 'teacher')
            <x-responsive-nav-link :href="route('chapters')" :active="request()->routeIs('chapters')">
                {{ __('Управление разделами') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('themes')" :active="request()->routeIs('themes')">
                {{ __('Управление темами') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('calendar')" :active="request()->routeIs('calendar')">
                {{ __('Расписание') }}
            </x-responsive-nav-link>
            @endif
            <x-responsive-nav-link :href="route('chats.index')" :active="request()->routeIs('chats.index')">
                {{ __('Чаты') }}
            </x-responsive-nav-link>
        </div>
        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Профиль') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('course.show')">
                    {{ __('Курсы') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('about')">
                    {{ __('О нас') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('review.list')">
                    {{ __('Отзывы') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault();
                                       this.closest('form').submit();">
                        {{ __('Выход') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
    @endif
</nav>
