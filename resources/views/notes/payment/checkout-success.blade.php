<?php

use Livewire\Volt\Component;

new class extends Component {}; ?>

<div>
    <x-app-layout>


        <div class="p-12">
            <div class="flex flex-col items-start max-w-2xl px-4 py-10 mx-auto mt-12 space-y-4 dark:text-gray-300 sm:px-6 lg:px-8">
                <h1 class='text-3xl'>
                   {{__('paymentz.payment-success.1')}}
                </h1>
                <x-button lg icon='arrow-left' href="{{ route('dashboard') }}"> {{__('paymentz.payment-success.2')}} </x-button>
            </div>
        </div>
    </x-app-layout>
</div>
