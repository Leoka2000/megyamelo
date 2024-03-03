<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Megy a Meló</title>
    <script>
        window.themeSwitcher = function() {
            return {
                switchOn: JSON.parse(localStorage.getItem('isDark')) || false,
                switchTheme() {
                    if (this.switchOn) {
                        document.documentElement.classList.add('dark')
                    } else {
                        document.documentElement.classList.remove('dark')
                    }
                    localStorage.setItem('isDark', this.switchOn)
                }
            }
        }
    </script>
    <link rel="icon" type="image/png" href="../../public/logo-top.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <wireui:scripts />

</head>

<body x-data="themeSwitcher()"  :class="{ 'dark': switchOn } relative">

    <x-notifications z-index="z-50" />
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        <livewire:layout.navigation />
        <x-dialog />

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow dark:bg-gray-800">
                <div class="px-2 py-6 mx-auto max-w-7xl sm:px-3 lg:px-4">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main class='relative'>
            {{ $slot }}
            <livewire:coins />
            <div class='absolute top-2 dark:text-gray-300 right-2'>
                <livewire:change-language />
            </div>
            <div class='absolute top-2 sm:left-2 left-3'>
                <livewire:contact />
            </div>
            <div class='absolute right-0 top-9'>
                <div class='flex items-center justify-center gap-1' x-data="window.themeSwitcher()" x-init="switchTheme()"
                    @keydown.window.tab="switchOn = false" class="flex items-center justify-center">
                    <input id="thisId" type="checkbox" name="switch" class="hidden" :checked="switchOn">

                    <button x-ref="switchButton" type="button" @click="switchOn = ! switchOn; switchTheme()"
                        :class="switchOn ? 'bg-indigo-600' : 'bg-neutral-200'"
                        class="relative inline-flex h-6 py-0.5 ml-4 focus:outline-none rounded-full w-10">
                        <span :class="switchOn ? 'translate-x-[18px]' : 'translate-x-0.5'"
                            class="w-5 h-5 duration-200 ease-in-out bg-white rounded-full shadow-md"></span>
                    </button>
                    <label @click="$refs.switchButton.click(); $refs.switchButton.focus()" :id="$id('switch')"
                        :class="{ 'text-blue-600': switchOn, 'text-gray-500': !switchOn }" class="text-sm select-none">

                    </label>
                    <x-icon name="moon" class="w-5 h-5 text-gray-400" />
                </div>
            </div>
        </main>

        <footer class='z-10 flex flex-col items-center justify-center w-full px-2 py-12 bg-gray-400 border-t border-t-gray-300 dark:border-none dark:bg-slate-800'>

            <div class="flex flex-col items-center justify-center pb-4 text-center md:w-96">
                <a href="{{ route('dashboard') }}" wire:navigate>
                    <div class='flex items-center justify-center mt-2 w-44'>
                        <img class='object-cover w-full h-full rounded-md opacity-90' src="{{ asset('logo.png') }}"
                            alt="logo" title="logo" />
                    </div>
                </a>

                <div class='w-full text-sm ms:text-base dark:text-gray-300'>
                    {{ __('welcome.footer-1') }} <a class='text-indigo-600 hover:border-b-indigo-600 hover:border-b'
                        href='https://docs.google.com/document/d/1Z3cOg7KyUTWwPHxmVul73IqPZxmYqqHq31vYuj-WmRM/edit'
                        target='_value'> {{ __('welcome.footer-2') }} </a>

                </div>
                <div class='w-full text-sm ms:text-base dark:text-gray-300'>
                    {{ __('welcome.footer-1') }} <a class='text-indigo-600 hover:border-b-indigo-600 hover:border-b'
                        href='https://docs.google.com/document/d/1kIyryix2maBfMEm3BJUJltVEL0fZh6Cm4pZxTPxzVeM/edit'
                        target='_value'> {{ __('welcome.footer-2.1') }} </a>
                </div>
                <div class='flex flex-col w-full gap-2'>
                    <x-button rounded class='h-12 mt-8' primary right-icon='user' href="{{ route('notes.create') }}"
                        icon-right="plus" label="{{ __('welcome.footer-3') }}" />
                    <x-button rounded class='h-12' primary right-icon='shopping-cart' href="{{ route('notes.post-create') }}"
                        label="{{ __('welcome.footer-4') }}" />
                </div>
            </div>
            <div class="text-sm text-center text-gray-700 dark:text-gray-500 sm:text-start">
                <div class="flex items-center gap-4">
                    <a href="https://www.linkedin.com/in/leoreus" target='_value'
                        class="inline-flex items-center group hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            class="w-5 h-5 -mt-px me-1 stroke-gray-700 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                        </svg>
                        {{ __('welcome.footer-5') }} Leo Reus
                    </a>
                </div>
            </div>
        </footer>

    </div>
</body>

</html>
