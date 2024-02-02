<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Megy a Meló</title>
 <link rel="icon" type="image/png" href="../../public/logo-top.png"><link rel="preconnect" href="https://fonts.googleapis.com">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <wireui:scripts />
</head>

<body class="font-sans antialiased dark">
 <x-notifications />
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
            <
            {{ $slot }}

            <livewire:coins />

            <div class='absolute top-2 right-2'>
               <livewire:contact />
            </div>
        </main>

 <footer class='z-10 flex flex-col items-center justify-center w-full px-2 py-12 bg-slate-800'>

                <div class="flex flex-col items-center justify-center pb-4 text-center md:w-96">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <div class='flex items-center justify-center mt-2 w-44'>
                            <img class='object-cover w-full h-full rounded-md' src="{{ asset('logo.png') }}"
                                alt="sheesh" title="sheesh" />
                        </div>
                    </a>
            
                    <div class='w-full text-sm ms:text-base dark:text-gray-300'>
                        Check out our <a class='text-violet-600 hover:border-b-violet-600 hover:border-b'
                            href='https://docs.google.com/document/d/1Z3cOg7KyUTWwPHxmVul73IqPZxmYqqHq31vYuj-WmRM/'
                            target='_value'>Privacy Policy (EN) </a>

                    </div>
                    <div class='flex flex-col w-full gap-3'>
                        <x-button class='mt-8' primary icon='clipboard' href="{{ route('notes.create') }}" icon-right="plus" label='Subscribe' />
                        <x-button outline primary icon='shopping-cart' href="{{ route('notes.payment.payment-index') }}"  label="For enterprises" />
                    </div>
                </div>
                <div class="text-sm text-center text-gray-400 dark:text-gray-400 sm:text-start">
                    <div class="flex items-center gap-4">
                        <a href="https://www.linkedin.com/in/leoreus" target='_value'
                            class="inline-flex items-center group hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="w-5 h-5 -mt-px me-1 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            Made by Leo Reus
                        </a>
                    </div>
                </div>
            </footer>

    </div>
</body>

</html>
