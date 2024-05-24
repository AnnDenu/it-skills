<!--Страница о нас-->

<x-app-layout>
    <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1
                class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                ITSkills - это надёжность в прочных знаниях!</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Это
                новая, полностью автоматизированная платформа, которая поможет вам прокачать навыки IT.
                Наша система позволит вам в динамичной форме овладеть языками программирования, свободно мыслить и
                говорить об IT.</p>
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://static.tildacdn.com/tild6534-3566-4032-b435-626162323161/casual-life-3d-femal.png"
                alt="mockup">
        </div>
        <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
            <img src="https://avtoringer.ru/static/images/for-who.webp" alt="mockup">
        </div>
        <div class="mr-auto place-self-center lg:col-span-7">
            <h1
                class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white">
                Для тех, кто сам хочет строить свою жизнь и стремится к мечте!</h1>
            <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">Наша
                платформа подойдет для школьников и студентов, бизнесменов и путешественников, амбициозных
                предпринимателей
                и находчивых эмигрантов. Мы дадим вам основы и прочные знания языков за ваше свободное время и в
                удобном месте.</p>
        </div>

    </div>
    @include('layouts.footer')
</x-app-layout>
