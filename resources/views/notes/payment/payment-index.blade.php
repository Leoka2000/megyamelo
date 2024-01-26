<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight dark:text-gray-300">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl px-4 mx-auto space-y-4 sm:px-6 dark:text-gray-300 lg:px-8">
            {{-- <x-button icon="arrow-left" class="mb-8" href="{{ route('note.post-create') }}">Back</x-button> --}}
          <div class='flex flex-col gap-2 dark:text-gray-300'>

    @foreach ($products as $product)
        <div class='flex p-2 bg-gray-800 rounded-md'>
            <p>{{ $product->name }}</p>
            <p>{{ $product->price }}</p>
        </div>
    @endforeach

   <form action="{{ route('checkout') }}" method="POST">
   @csrf
            <x-button type='submit' lg primary icon='shopping-cart' >Go to checkout</x-button>
        </form>
</div>

    </div>
</x-app-layout>
