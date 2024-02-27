<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Megy a Meló</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <wireui:scripts />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased dark dark:bg-gray-900">
    <div
        class="relative min-h-screen bg-gray-100 bg-center sm:flex sm:justify-center sm:items-center bg-dots-darker dark:bg-dots-lighter dark:bg-gray-900 selection:bg-indigo-600 selection:text-white">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif

        <main class="flex flex-col items-center justify-center w-full mx-auto ">
            <section
                class='relative flex items-center justify-center w-full border-b border-gray-800 py-60 sm:pt-52 sm:pb-64 dark:bg-gray-900'>
                <div class="flex flex-col justify-center text-center">
                    <a href="{{ route('dashboard') }}" class='flex items-center justify-center w-full h-full'
                        wire:navigate>
                        <div class='flex items-center justify-center mt-2 md:h-64'>
                            <img class='object-cover h-32 rounded-md opacity-80 w-60 md:w-full md:h-full'
                                src="{{ asset('logo.png') }}" alt="logo" title="logo" />
                        </div>
                    </a>
                    <p class='text-2xl italic text-gray-300 md:text-3xl'>{{ __('welcome.hero_slogan') }}</p>
                    <x-button icon='arrow-right' class='mt-8' href="{{ route('notes.create') }}" primary rounded lg
                        icon-right="plus">{{ __('welcome.landing-5') }}</x-button>

                </div>
                <span class='absolute overflow-hidden -z-0 w-52 sm:-top-24 sm:-right-0 -right-0 -top-40'
                    id="silhouette">
                    <svg width="400" height="400" viewBox="0 0 590 590" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="294.897" cy="294.897" r="293.332" stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M529.831 294.898C529.831 424.876 424.643 530.24 294.893 530.24C165.143 530.24 59.9549 424.876 59.9549 294.898C59.9549 164.92 165.143 59.557 294.893 59.557C424.643 59.557 529.831 164.92 529.831 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M469.527 294.898C469.527 395.314 391.286 476.611 294.901 476.611C198.515 476.611 120.275 395.314 120.275 294.898C120.275 194.482 198.515 113.185 294.901 113.185C391.286 113.185 469.527 194.482 469.527 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                    </svg>

                </span>
                <span class='absolute z-0 sm:-bottom-40 sm:-left-40 -bottom-52 -left-52' id="silhouette">
                    <svg width="400" height="400" viewBox="0 0 590 590" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="294.897" cy="294.897" r="293.332" stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M529.831 294.898C529.831 424.876 424.643 530.24 294.893 530.24C165.143 530.24 59.9549 424.876 59.9549 294.898C59.9549 164.92 165.143 59.557 294.893 59.557C424.643 59.557 529.831 164.92 529.831 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M469.527 294.898C469.527 395.314 391.286 476.611 294.901 476.611C198.515 476.611 120.275 395.314 120.275 294.898C120.275 194.482 198.515 113.185 294.901 113.185C391.286 113.185 469.527 194.482 469.527 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                    </svg>

                </span>

            </section>
            {{-- SECTION BREAK --}}
            {{-- SECTION BREAK --}}
            {{-- SECTION BREAK --}}
            {{-- SECTION BREAK --}}
            <section class='z-10 w-full py-20 dark:bg-gray-900 dark:text-gray-300'>
                <div class="flex flex-col items-center justify-center px-3 mb-5">
                    <header class='max-w-4xl pb-12 mb-5 text-xl text-center md:text-4xl'>
                        <h1>{{ __('welcome.landing-1') }}</h1>
                    </header>
                    <main class="flex flex-col gap-4 sm:flex-row landing-main">
                        <div
                            class='flex flex-col justify-between px-8 py-10 border border-gray-800 dark:bg-gray-800 rounded-xl sm:w-72 lg:w-96'>
                            <span><svg width="140" height="140" viewBox="0 0 140 140" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_4014_33508)">
                                        <circle cx="70" cy="70" r="69" fill="lightgray" stroke="#0C0C0C"
                                            stroke-width="2" />
                                        <rect x="42.7419" y="40.4346" width="57.9224" height="57.9224"
                                            stroke="#7F6AFF" />
                                        <path
                                            d="M94.4146 62.5949C103.778 62.5949 111.369 55.004 111.369 45.6402C111.369 36.2764 103.778 28.6855 94.4146 28.6855C85.0508 28.6855 77.46 36.2764 77.46 45.6402C77.46 55.004 85.0508 62.5949 94.4146 62.5949Z"
                                            fill="#0C0C0C" />
                                        <path
                                            d="M70 82.9412C72.233 78.3681 75.7056 74.514 80.0221 71.8181C84.3386 69.1222 89.3255 67.6929 94.4147 67.6929C99.5039 67.6929 104.491 69.1222 108.807 71.8181C113.124 74.514 116.596 78.3681 118.829 82.9412"
                                            fill="#0C0C0C" />
                                        <path
                                            d="M45.5853 84.3258C54.9491 84.3258 62.54 76.735 62.54 67.3712C62.54 58.0074 54.9491 50.4165 45.5853 50.4165C36.2215 50.4165 28.6306 58.0074 28.6306 67.3712C28.6306 76.735 36.2215 84.3258 45.5853 84.3258Z"
                                            fill="#7F6AFF" stroke="#7F6AFF" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M21.1707 104.672C23.4037 100.099 26.8762 96.245 31.1928 93.5491C35.5093 90.8532 40.4962 89.4238 45.5854 89.4238C50.6746 89.4238 55.6615 90.8532 59.978 93.5491C64.2945 96.245 67.7671 100.099 70.0001 104.672"
                                            fill="#7F6AFF" stroke="#7F6AFF" stroke-width="2" stroke-linecap="square"
                                            stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4014_33508">
                                            <rect width="140" height="140" fill="lightgray" />
                                        </clipPath>
                                    </defs>
                                </svg></span>
                            <div class='my-3'>
                                <h1 class='text-lg'>{{ __('welcome.landing-2') }}
                                </h1>
                            </div>
                            <x-button class='w-full' href="{{ route('notes.post-create') }}" primary
                                icon="shopping-cart">{{ __('welcome.landing-3') }} </x-button>
                        </div>
                        <div
                            class='flex flex-col justify-between px-6 py-10 border border-gray-800 dark:bg-gray-800 sm:w-72 rounded-xl lg:w-96'>
                            <span>
                                <svg width="140" height="140" viewBox="0 0 140 140" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_4014_33527)">
                                        <circle cx="70" cy="70" r="69" fill="lightgray"
                                            stroke="#0C0C0C" stroke-width="2" />
                                        <circle cx="70.0001" cy="60.7476" r="31.8537" stroke="#7F6AFF"
                                            stroke-width="1.49398" />
                                        <rect x="61.9763" y="96.5801" width="16.0478" height="15.2729"
                                            fill="#0C0C0C" />
                                        <circle cx="70.0001" cy="60.7479" r="26.6474" fill="#7F6AFF"
                                            stroke="lightgray" stroke-width="1.55545" />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_4014_33527">
                                            <rect width="140" height="140" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg></span>

                            <div class='my-3'>
                                <h1 class='text-lg'>{{ __('welcome.landing-4') }} </h1>
                            </div>
                            <x-button href="{{ route('notes.create') }}" class='w-full' primary
                                icon="user">{{ __('welcome.landing-5') }} </x-button>
                        </div>
                    </main>
                </div>
            </section>
            {{-- SECTION BREAK --}}
            {{-- SECTION BREAK --}}
            {{-- SECTION BREAK --}}
            {{-- SECTION BREAK --}}
            <section class='relative w-full pb-64 border-t border-gray-700 pt-52 '>
                <div class='flex flex-col items-center w-full gap-4'>
                    <header class='max-w-4xl px-2 mb-12 text-2xl text-center lg:w-96 md:text-4xl dark:text-gray-300'>
                        <h1>{{ __('welcome.faq-1') }}</h1>
                    </header>
                    <main class="flex flex-col max-w-4xl gap-4 px-3">
                        <div>
                            <div class="p-6 border border-gray-800 rounded-lg shadow-lg dark:bg-gray-800">
                                <div class="flex items-center">
                                    <div class='flex items-center justify-start gap-4'>
                                        <span class='p-2 rounded-md text-slate-300 bg-slate-700'><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                            </svg>
                                        </span>
                                        <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-300">
                                            {{ __('welcome.faq-2') }} </p>
                                    </div>
                                </div>
                                <div class="mt-6">

                                    <p class="text-sm leading-9 text-gray-900 dark:text-gray-300">
                                        {{ __('welcome.faq-3') }} </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="p-6 border border-gray-800 rounded-lg shadow-lg dark:bg-gray-800">
                                <div class="flex items-center">
                                    <div class='flex items-center justify-start gap-4'>
                                        <span class='p-2 rounded-md text-slate-300 bg-slate-700'><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                            </svg>
                                        </span>
                                        <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-300">
                                            {{ __('welcome.faq-4') }}
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <p class="text-sm leading-9 text-gray-900 dark:text-gray-300">
                                        {{ __('welcome.faq-5') }} <a href="{{ route('notes.create') }}"
                                            class='text-indigo-600 hover:border-b hover:border-b-indigo-500'>
                                            {{ __('welcome.faq-5.1') }} </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="p-6 border border-gray-800 rounded-lg shadow-lg dark:bg-gray-800">
                                <div class="flex items-center">
                                    <div class='flex items-center justify-start gap-4'>
                                        <span class='p-2 rounded-md text-slate-300 bg-slate-700'><svg
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                                            </svg>
                                        </span>
                                        <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-300">
                                            {{ __('welcome.faq-6') }}</p>
                                    </div>
                                </div>
                                <div class="mt-6">
                                    <p class="text-sm leading-9 text-gray-900 dark:text-gray-300">
                                        {{ __('welcome.faq-7') }} <a href="{{ route('notes.create') }}"
                                            class='text-indigo-600 hover:border-b hover:border-b-indigo-500'>{{ __('welcome.faq-7.1') }}</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>

                <span class='absolute z-0 overflow-hidden w-52 lg:-top-42 -top-56 -right-0 lg:-right-0'
                    id="silhouette">
                    <svg width="400" height="400" viewBox="0 0 590 590" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="294.897" cy="294.897" r="293.332" stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M529.831 294.898C529.831 424.876 424.643 530.24 294.893 530.24C165.143 530.24 59.9549 424.876 59.9549 294.898C59.9549 164.92 165.143 59.557 294.893 59.557C424.643 59.557 529.831 164.92 529.831 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M469.527 294.898C469.527 395.314 391.286 476.611 294.901 476.611C198.515 476.611 120.275 395.314 120.275 294.898C120.275 194.482 198.515 113.185 294.901 113.185C391.286 113.185 469.527 194.482 469.527 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                    </svg>

                </span>
                <span class='absolute z-0 lg:-bottom-40 lg:-left-40 -bottom-56 -left-48' id="silhouette">
                    <svg width="400" height="400" viewBox="0 0 590 590" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <circle cx="294.897" cy="294.897" r="293.332" stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M529.831 294.898C529.831 424.876 424.643 530.24 294.893 530.24C165.143 530.24 59.9549 424.876 59.9549 294.898C59.9549 164.92 165.143 59.557 294.893 59.557C424.643 59.557 529.831 164.92 529.831 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                        <path
                            d="M469.527 294.898C469.527 395.314 391.286 476.611 294.901 476.611C198.515 476.611 120.275 395.314 120.275 294.898C120.275 194.482 198.515 113.185 294.901 113.185C391.286 113.185 469.527 194.482 469.527 294.898Z"
                            stroke="#7F6AFF" stroke-width="3.12971" />
                    </svg>

                </span>
            </section>

            <footer class='z-10 flex flex-col items-center justify-center w-full px-2 py-12 bg-slate-800'>

                <div class="flex flex-col items-center justify-center pb-4 text-center md:w-96">
                    <a href="{{ route('dashboard') }}" wire:navigate>
                        <div class='flex items-center justify-center mt-2 w-44'>
                            <img class='object-cover w-full h-full rounded-md opacity-90' src="{{ asset('logo.png') }}"
                                alt="logo" title="logo" />
                        </div>
                    </a>

                    <div class='w-full text-sm ms:text-base dark:text-gray-300'>
                        {{ __('welcome.footer-1') }} <a
                            class='text-indigo-600 hover:border-b-indigo-600 hover:border-b'
                            href='https://docs.google.com/document/d/1Z3cOg7KyUTWwPHxmVul73IqPZxmYqqHq31vYuj-WmRM/edit'
                            target='_value'> {{ __('welcome.footer-2') }} </a>
                    </div>
                     <div class='w-full text-sm ms:text-base dark:text-gray-300'>
                        {{ __('welcome.footer-1') }} <a
                            class='text-indigo-600 hover:border-b-indigo-600 hover:border-b'
                            href='https://docs.google.com/document/d/1kIyryix2maBfMEm3BJUJltVEL0fZh6Cm4pZxTPxzVeM/edit'
                            target='_value'> {{ __('welcome.footer-2.1') }} </a>
                    </div>
                    
                    <div class='flex flex-col w-full gap-2'>
                        <x-button class='mt-8' primary icon='clipboard' href="{{ route('notes.create') }}"
                            icon-right="plus" label="{{ __('welcome.footer-3') }}" />
                        <x-button outline primary icon='shopping-cart'
                            href="{{ route('notes.post-create') }}"
                            label="{{ __('welcome.footer-4') }}" />
                    </div>
                </div>
                <div class="text-sm text-center text-gray-400 dark:text-gray-400 sm:text-start">
                    <div class="flex items-center gap-4">
                        <a href="https://www.linkedin.com/in/leoreus" target='_value'
                            class="inline-flex items-center group hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5"
                                class="w-5 h-5 -mt-px me-1 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                            </svg>
                            {{ __('welcome.footer-5') }} Leo Reus
                        </a>
                    </div>
                </div>
            </footer>
        </main>



    </div>
</body>

</html>
