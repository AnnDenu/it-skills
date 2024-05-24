<!--Главная страница веб приложения-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>IT-Skills</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<header>
    <nav class="bg-white border-gray-200 px-4 lg:px-6 py-2.5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
            <a href="{{ route('welcome') }}" class="flex items-center">
                <svg width="156" height="86" viewBox="0 0 78 26" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M18.5 6.64868C14 9.64868 8.5 7.64868 8 12.1487C3.02944 12.1487 3.5 10.1487 0.5 6.64868C4.5 4.14868 8 4.14868 9 0.648682C14.5 3.14868 15.5 3.64868 18.5 6.64868Z"
                        fill="#4ACBB4" />
                    <path
                        d="M60.6834 16.0453C61.1163 17.8134 62.243 20.0875 63.7899 21.3339C65.3369 22.5803 65.2055 22.8682 67.1642 23.027C69.1228 23.1858 70.1786 22.2403 71.6597 21.2394C73.1409 20.2385 72.8767 20.5545 73.2079 18.8482C73.5392 17.142 77.3974 16.0026 76.4284 14.3656C75.4593 12.7287 73.4842 12.3285 71.6548 11.504C69.8254 10.6795 66.1617 11.8861 64.3025 12.2484C62.4432 12.6106 67.8211 14.9842 66.7761 16.3687L69.0678 17.3694L68.0892 17.8871L60.6834 16.0453Z"
                        fill="#6698F8" />
                    <path
                        d="M29.6834 12.0453C30.1164 13.8134 31.243 16.0875 32.7899 17.3339C34.3369 18.5803 34.2056 18.8682 36.1642 19.027C38.1228 19.1858 39.1786 18.2403 40.6598 17.2394C42.1409 16.2385 41.8767 16.5545 42.2079 14.8482C42.5392 13.142 46.3974 12.0026 45.4284 10.3656C44.4593 8.72871 42.4842 8.32851 40.6548 7.50401C38.8254 6.6795 35.1617 7.88614 33.3025 8.24837C31.4432 8.6106 36.8211 10.9842 35.7761 12.3687L38.0678 13.3694L37.0892 13.8871L29.6834 12.0453Z"
                        fill="#2D5E7A" />
                    <path
                        d="M4.056 18V6.48H5.368V18H4.056ZM11.8619 18V7.776H6.74188V6.48H18.2619V7.776H13.1579V18H11.8619ZM19.5065 13.92V12.608H25.7465V13.92H19.5065ZM29.5321 18C29.1801 18 28.8548 17.9147 28.5561 17.744C28.2681 17.5627 28.0335 17.328 27.8521 17.04C27.6815 16.7413 27.5961 16.416 27.5961 16.064V15.936H28.9081V16.064C28.9081 16.2347 28.9668 16.384 29.0841 16.512C29.2121 16.6293 29.3615 16.688 29.5321 16.688H35.1001C35.2708 16.688 35.4148 16.6293 35.5321 16.512C35.6601 16.384 35.7241 16.2347 35.7241 16.064V14.64C35.7241 14.4693 35.6601 14.3253 35.5321 14.208C35.4148 14.08 35.2708 14.016 35.1001 14.016H29.5321C29.1801 14.016 28.8548 13.9307 28.5561 13.76C28.2681 13.5787 28.0335 13.344 27.8521 13.056C27.6815 12.7573 27.5961 12.432 27.5961 12.08V10.656C27.5961 10.304 27.6815 9.984 27.8521 9.696C28.0335 9.39733 28.2681 9.16267 28.5561 8.992C28.8548 8.81067 29.1801 8.72 29.5321 8.72H35.1001C35.4628 8.72 35.7881 8.81067 36.0761 8.992C36.3748 9.16267 36.6095 9.39733 36.7801 9.696C36.9615 9.984 37.0521 10.304 37.0521 10.656V10.784H35.7241V10.656C35.7241 10.4853 35.6601 10.3413 35.5321 10.224C35.4148 10.096 35.2708 10.032 35.1001 10.032H29.5321C29.3615 10.032 29.2121 10.096 29.0841 10.224C28.9668 10.3413 28.9081 10.4853 28.9081 10.656V12.08C28.9081 12.2507 28.9668 12.4 29.0841 12.528C29.2121 12.6453 29.3615 12.704 29.5321 12.704H35.1001C35.4628 12.704 35.7881 12.7947 36.0761 12.976C36.3748 13.1467 36.6095 13.3813 36.7801 13.68C36.9615 13.968 37.0521 14.288 37.0521 14.64V16.064C37.0521 16.416 36.9615 16.7413 36.7801 17.04C36.6095 17.328 36.3748 17.5627 36.0761 17.744C35.7881 17.9147 35.4628 18 35.1001 18H29.5321ZM38.4265 18V5.68H39.7385V12.704H42.2985L45.9465 8.72H47.6745V8.736L43.4665 13.36L47.6585 17.984V18H45.9465L42.2985 14.016H39.7385V18H38.4265ZM48.7383 18V8.72H50.0503V18H48.7383ZM48.7383 6.992V5.68H50.0503V6.992H48.7383ZM54.0024 18C53.6504 18 53.325 17.9147 53.0264 17.744C52.7384 17.5627 52.5037 17.328 52.3224 17.04C52.1517 16.7413 52.0664 16.416 52.0664 16.064V5.68H53.3784V16.064C53.3784 16.2347 53.437 16.384 53.5544 16.512C53.6824 16.6293 53.8317 16.688 54.0024 16.688H55.5704V18H54.0024ZM58.8305 18C58.4785 18 58.1532 17.9147 57.8545 17.744C57.5665 17.5627 57.3318 17.328 57.1505 17.04C56.9798 16.7413 56.8945 16.416 56.8945 16.064V5.68H58.2065V16.064C58.2065 16.2347 58.2652 16.384 58.3825 16.512C58.5105 16.6293 58.6598 16.688 58.8305 16.688H60.3985V18H58.8305ZM63.5946 18C63.2426 18 62.9173 17.9147 62.6186 17.744C62.3306 17.5627 62.096 17.328 61.9146 17.04C61.744 16.7413 61.6586 16.416 61.6586 16.064V15.936H62.9706V16.064C62.9706 16.2347 63.0293 16.384 63.1466 16.512C63.2746 16.6293 63.424 16.688 63.5946 16.688H69.1626C69.3333 16.688 69.4773 16.6293 69.5946 16.512C69.7226 16.384 69.7866 16.2347 69.7866 16.064V14.64C69.7866 14.4693 69.7226 14.3253 69.5946 14.208C69.4773 14.08 69.3333 14.016 69.1626 14.016H63.5946C63.2426 14.016 62.9173 13.9307 62.6186 13.76C62.3306 13.5787 62.096 13.344 61.9146 13.056C61.744 12.7573 61.6586 12.432 61.6586 12.08V10.656C61.6586 10.304 61.744 9.984 61.9146 9.696C62.096 9.39733 62.3306 9.16267 62.6186 8.992C62.9173 8.81067 63.2426 8.72 63.5946 8.72H69.1626C69.5253 8.72 69.8506 8.81067 70.1386 8.992C70.4373 9.16267 70.672 9.39733 70.8426 9.696C71.024 9.984 71.1146 10.304 71.1146 10.656V10.784H69.7866V10.656C69.7866 10.4853 69.7226 10.3413 69.5946 10.224C69.4773 10.096 69.3333 10.032 69.1626 10.032H63.5946C63.424 10.032 63.2746 10.096 63.1466 10.224C63.0293 10.3413 62.9706 10.4853 62.9706 10.656V12.08C62.9706 12.2507 63.0293 12.4 63.1466 12.528C63.2746 12.6453 63.424 12.704 63.5946 12.704H69.1626C69.5253 12.704 69.8506 12.7947 70.1386 12.976C70.4373 13.1467 70.672 13.3813 70.8426 13.68C71.024 13.968 71.1146 14.288 71.1146 14.64V16.064C71.1146 16.416 71.024 16.7413 70.8426 17.04C70.672 17.328 70.4373 17.5627 70.1386 17.744C69.8506 17.9147 69.5253 18 69.1626 18H63.5946Z"
                        fill="black" />
                </svg>
            </a>
            <div class="flex items-center lg:order-2">
                @if (Route::has('login'))
                    @auth
                    <div class="mb-4">
                        <a href="{{ url()->previous() }}" class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">Вернуться назад</a>
                    </div>
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
            <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('course.show') }}"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Курсы</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">О
                            нас</a>
                    </li>
                    <li>
                        <a href="{{ route('review.list') }}"
                            class="block py-2 pr-4 pl-3 text-gray-700 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700">Отзывы</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<body class="antialiased">

    <div
        class="relative sm:flex sm:justify-center  min-h-screen bg-dots-darker bg-center dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <section class="bg-white dark:bg-gray-900">
                <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                    <div class="mr-auto place-self-center lg:col-span-7">
                        <h1
                            class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                            Обучайтесь в IT-Skills. Онлайн курсы для IT</h1>
                        <p
                            class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                            Образовательная платформа, на которой можно с нуля освоить востребованную профессию, а также
                            получить знания и навыки для перехода на новый уровень в карьере.</p>
                        <a href="{{ route('about') }}"
                            class="mt-11 transition delay-150 duration-300 ease-in-out text-gray-900 bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                            Подробнее о нас
                        </a>
                    </div>
                    <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                        <img src="https://static.tildacdn.com/tild3265-3434-4261-a239-393731363431/casual-life-3d-man-w.png"
                            alt="mockup">
                    </div>
                </div>
                <a href="{{ route('course.show') }}"
                    class="lg:col-span-7 relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
                    <span
                        class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                        Все курсы
                    </span>
                </a>
                <div class="mt-16">
                    <div class="grid grid-cols-1 md:grid-cols-2  gap-6 lg:gap-8">
                        <a href="{{ route('course.show') }}"
                            class="scale-100 p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-green-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-green-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-green-500">
                            <div>
                                <div
                                    class="h-16 w-16 bg-green-50 dark:bg-green-800/20 flex items-center justify-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-7 h-7 stroke-green-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                </div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Курсы</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Интенсивные занятия, с помощью которых слушатель осваивает профессиональные знания
                                    или навыки и сразу применяет их на практике.
                                </p>
                            </div>
                        </a>
                        <a href="#"
                            class="scale-100 p-6 bg-white dark:bg-blue-800/50 dark:bg-gradient-to-bl from-blue-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-blue-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-blue-500">
                            <div>
                                <div
                                    class="h-16 w-16 bg-blue-50 dark:bg-blue-800/20 flex items-center justify-center rounded-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-7 h-7 stroke-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                                    </svg>
                                </div>
                                <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Новости</h2>
                                <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                                    Последние новости онлайн-платформ обучения.
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                        <div class="mr-auto place-self-center lg:col-span-7">
                            <h1
                                class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                                Что говорят о нас обучающиеся?</h1>
                        </div>
                        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                            <div class="mr-auto place-self-center lg:col-span-7">
                                <a href="{{ route('review.list') }}"
                                    class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                                    Все отзывы
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                    <div class="hidden lg:mt-0 lg:col-span-5 lg:flex float-left">
                        <img src="https://sun9-50.userapi.com/impg/8IjoI9JuDu5vwng55aLyu6QWNE3WIRjDDUUwNg/BYPVpx4cMMU.jpg?size=807x607&quality=96&sign=bd6b14a486456378ca9386e12aa5112c&c_uniq_tag=MMVHcnBVRiB3fKPaHNzpYy8d0YCMve6O4Sh9d8qepJI&type=album"
                            alt="mockup">
                    </div>
                    <div class="mr-auto place-self-center lg:col-span-7">
                        <section class="rounded-md p-6 text-center md:p-12 md:text-left">
                            <div class="flex justify-center">
                                <div class="max-w-3xl">
                                    <div
                                        class="m-4 block rounded-lg bg-lightblue p-6 dark:bg-neutral-800 dark:shadow-black/20">
                                        <!--Вывод отзывов-->
                                        @foreach ($reviews as $item)
                                            <div class="md:flex md:flex-row">
                                                <div class="md:ml-6">
                                                    <p
                                                        class="mb-2 text-xl font-semibold text-neutral-800 dark:text-neutral-200">
                                                        {{ $item->user->name }}
                                                    </p>
                                                    <p
                                                        class="mb-0 font-semibold text-neutral-500 dark:text-neutral-400">
                                                        {{ $item->course->name }}
                                                    </p>
                                                    <p class="mb-6 font-light text-neutral-500 dark:text-neutral-300">
                                                        {{ $item->text }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
</body>
@include('layouts.footer')

</html>
