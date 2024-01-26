<?php

use Livewire\Volt\Component;
use App\Models\User;

new class extends Component {
    public $coins;
     public $showModal = false;

     public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function mount()
    {
        $user = User::find(\Auth::id());
        $this->coins = $user->coins;
             $this->userRole = $user->role;
    }
}; ?>


<div>
    <style>
        .custom {
            top: -3.15rem
        }
    </style>

    @if ($this->userRole  === 'admin')
      @if ($this->coins  === 0)
       <x-button class='absolute z-20 h-8 custom right-3 ' href="{{ route('notes.payment-index') }}" icon="currency-dollar" red md
    >Advertisements left: {{ $this->coins }}</x-button>
        
        @else
            <x-button class='absolute z-20 h-8 custom right-3' href="{{ route('notes.payment-index') }}" icon="currency-dollar" green md
       >Advertisements left: {{ $this->coins }} </x-button>
       @endif

       
        
    @endif
</div>
