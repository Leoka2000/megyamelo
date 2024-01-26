<?php

use Livewire\Volt\Component;
use App\Models\Product;

new class extends Component {
    public function with(): array
    {
        return [
            'products' => Product::all(),
        ];
    }
}; ?>

<div class='flex flex-col gap-2 dark:text-gray-300'>

    @foreach ($products as $product)
        <div class='flex p-2 bg-gray-800 rounded-md'>
            <p>{{ $product->name }}</p>
            <p>{{ $product->price }}</p>
        </div>
    @endforeach

   <form action="{{ route('checkout') }}" method="POST">
   @csrf
            <button >Go to checkout<button>
        </form>
</div>
