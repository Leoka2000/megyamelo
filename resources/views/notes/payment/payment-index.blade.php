<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight dark:text-gray-300">
            {{ __('paymentz.payment-01') }}
        </h2>
    </x-slot>

    <div class="py-28">


        @foreach ($products as $product)
            <div class="max-w-2xl px-4 mx-auto space-y-4 sm:px-6 dark:text-gray-300 lg:px-16">
                <x-button icon="arrow-left" class="mb-8"
                    href="{{ route('dashboard') }}">{{ __('paymentz.payment-02') }}</x-button>

                <div
                    class='flex flex-col gap-2 border border-gray-200 rounded-lg shadow-md dark:border-gray-700 dark:text-gray-300'>
                    <x-card>
                        <x-slot name="title" class='w-full px-0'>
                            <div class='flex items-center justify-between w-full'>
                                <p class='text-2xl italic font-bold'>
                                    9999,99ft + {{ __('paymentz.payment-03') }}
                                </p>

                            </div>
                        </x-slot>

                        <div class='flex justify-start py-5'>
                            <ul class='flex flex-col w-full gap-2 mb-4 text-sm sm:text-base'>
                                <li class='flex items-center w-full gap-1'>
                                    <x-icon name="check" class="w-5 h-5" />{{ __('paymentz.payment-1') }}
                                </li>
                                <li class='flex items-center gap-1'>
                                    <x-icon name="check" class="w-5 h-5" />{{ __('paymentz.payment-2') }}
                                </li>
                                <li class='flex items-center gap-1'>
                                    <x-icon name="check" class="w-5 h-5" />{{ __('paymentz.payment-3') }}
                                </li>
                                <li class='flex items-center gap-1'>
                                    <x-icon name="check" class="w-5 h-5" />{{ __('paymentz.payment-4') }}
                                </li>
                            </ul>
                        </div>


                        <x-slot name="footer" class="flex items-center justify-between w-full">
                            <form action="{{ route('checkout') }}" class='flex w-full'method="POST">
                                @csrf
                                <x-button green type='submit' spinner class='w-full' md rounded
                                    icon='shopping-cart'>{{ __('paymentz.payment-01') }}</x-button>
                            </form>

                        </x-slot>
                    </x-card>
                </div>
            </div>
        @endforeach
</x-app-layout>


{{-- 
                @foreach ($products as $product)
                    <x-card class='bg-gray-800 rounded-lg'>
                        <main class='flex flex-col p-2'>
                            <header class='flex items-center justify-between'>
                                <h1 class='text-2xl font-bold sm:text-4xl'>{{ $product->price }}Ft + VAT<h1>
                                        <a wire:click='goToIndex'>
                                            <div class='flex items-center justify-center h-auto mt-2 w-28 opacity-80'>
                                                <img class='object-cover w-full h-full rounded-md'
                                                    src="{{ asset('logo.png') }}" alt="sheesh" title="sheesh" />
                                            </div>
                                        </a>
                            </header>
                            <div class='flex justify-start py-5'>
                                <ul class='flex flex-col gap-2 mb-4 text-sm w-80 sm:text-base'>
                                    <x-badge icon="check" positive md rounded label="Two advertisements" />
                                    <x-badge icon="check" positive md rounded label="30 days job ad" />
                                    <x-badge icon="check" positive md rounded label="Any kind of job" />
                                    <x-badge icon="check" positive md rounded
                                        label="Jobs are also posted on our instagram" />
                                    <x-badge icon="check" positive md rounded label="Unlimited applicants per post" />
                            </div>
                            </ul>
                            <form action="{{ route('checkout') }}" class='flex w-full'method="POST">
                                @csrf
                                <x-button type='submit' sm class='w-full' md primary icon='shopping-cart'>Go to
                                    checkout</x-button>
                            </form>
                        </main>
                        </x-card>
                @endforeach

 --}}
