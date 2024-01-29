<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight dark:text-gray-300">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl px-4 mx-auto space-y-4 sm:px-6 dark:text-gray-300 lg:px-16">
            {{-- <x-button icon="arrow-left" class="mb-8" href="{{ route('note.post-create') }}">Back</x-button> --}}
            <div class='flex flex-col gap-2 dark:text-gray-300'>

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


            </div>

        </div>
</x-app-layout>
