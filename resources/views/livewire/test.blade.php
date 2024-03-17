<?php

use Livewire\Volt\Component;
use App\Models\User; // Import the User model
use App\Models\Note;
use Illuminate\Support\Facades\Log;

new class extends Component {
    public $user;

    public function mount()
    {
        $this->user = auth()->user(); // Get currently logged in user
    }

     public function checkReferrals()
    {
        $referralCount = Note::where('referral', $this->user->referral_code)->count();

        if ($referralCount >= 3) {
            dd("You have 3 or more referrals! (true)" . " " . $referralCount );
        } else {
            dd("You have less than 3 referrals. (false)".  " " . $referralCount );
        }
    }
}; ?>

<div class='relative'>
    <x-button class='absolute top-10 left-24' wire:click="checkReferrals"> test button</x-button>
</div>
