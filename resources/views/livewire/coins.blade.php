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

    @if ($this->userRole  === 'admin' || $this->userRole === 'superadmin')
      @if ($this->coins  === 0)
       <x-button sm class='absolute z-20 h-8 custom right-3 ' href="{{ route('notes.payment.payment-index') }}" icon="currency-dollar" red 
    > {{__('company.advertisements_left')}} {{ $this->coins }}</x-button>
        
        @else
            <x-button sm class='absolute z-20 h-8 custom right-3' href="{{ route('notes.payment.payment-index') }}" icon="currency-dollar" green 
       >Advertisements left: {{ $this->coins }} </x-button>
       @endif

       
        
    @endif
</div>
