<?php

use Livewire\Volt\Component;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReferralReward;
use App\Models\User; // Import the User model
use App\Models\Note;

new class extends Component {
    use Actions;
    public $showModal = false;
    public $name;
    public $email;
    public $referral;
    public $typeReward;
    public $allowModal = false;
    public $user;

    public function mount()
    {
        $this->user = auth()->user(); // Get currently logged in user
    }

    public function openModal()
    {
        $referralCount = Note::where('referral', $this->user->referral_code)->count();

        if ($referralCount >= 3) {
            $this->showModal = true;
        } else {
            $this->openAllowModal();
        }
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    public function openAllowModal()
    {
        $this->allowModal = true;
    }

    public function closeAllowModal()
    {
        $this->allowModal = false;
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'referral' => ['required', 'string'],
            'typeReward' => ['required', 'string'],
        ]);

        #Mail::to('megymelo4@gmail.com')->send(new ReferralReward($validatedData['name'], $validatedData['email'], $validatedData['referral'], $validatedData['typeReward']));

        Mail::to($validatedData['email'])->send(new ReferralReward($validatedData['name'], $validatedData['email'], $validatedData['referral'], $validatedData['typeReward']));

        $this->dispatch('Message successfully sent!');
    }

    public function typeReward()
    {
        return ['Mentorship (complete package)', 'Review of LinkedIn, CV, and Cover Letter review'];
    }
};

?>





<div>
    <x-card title="DISCLAIMER:">
        <header class='flex flex-col p-3 text-sm text-gray-600 dark:text-gray-500 sm:text-lg md:p-6'>

            <p>If you have already referred enough people to get the mentorship, then click on the
                button below and claim your reward!
            <p>

        </header>

        <x-slot name="footer">
            <div class="flex items-center justify-between">
                <x-button rounded class='w-full h-12' right-icon="gift" wire:click='openModal' teal> Claim reward
                </x-button>
            </div>
        </x-slot>

    </x-card>
    @if ($showModal)
        <x-modal wire:model="showModal" title="Simple Modal">

            <div
                class='relative flex flex-col items-center justify-center gap-2 p-5 mb-2 bg-white rounded-md dark:bg-gray-800 dark:text-gray-400 '>

                <p class='w-64 text-lg font-bold text-center dark:text-gray-400'>
                    Claim your reward
                </p>

                <form class='flex flex-col w-full text-sm sm:text-base ' wire:submit.prevent="submit">
                    <x-button.circle class='absolute -right-1 -top-1' flat xl icon='x-circle' label="Cancel"
                        x-on:click="close" />
                    <!-- Correct order of form inputs -->
                    <label class='mb-1' for="name">Name</label>
                    <x-wui-input placeholder='Lajos Kovács' icon='user' type="text" id="name" class="mb-2"
                        wire:model.defer="name" />

                    <label class='mb-1' for="email">Email (the same one you utilized during referral)</label>
                    <x-wui-input placeholder='myemail@gmail.com' icon="mail" type="text" class="mb-2"
                        id="email" wire:model.defer="email" />

                    <label class='mb-1' for="topic">Inform the referral code you utilized to refer your
                        friends</label>
                    <x-wui-input icon='gift' placeholder='PAJDpksbPSJ' type="text" class="mb-2" id="topic"
                        wire:model.defer="referral" />

                    <label for="typeReferral" class='mb-1' for="topic">Inform the referral code you utilized to
                        refer your
                        friends</label>
                    <x-wui-select id="typeReferral" icon='identification' class='z-10' placeholder="Mentorship"
                        wire:model.defer="typeReward" :options="$this->typeReward()" />

                    <div class='flex flex-col justify-between gap-2 mt-5 text-center'>
                        <x-action-message class="text-center text-green-500 text-md" on="Message successfully sent!" />
                        <x-button rounded class='w-full h-10' right-icon="gift" teal spinner="submit"
                            type="submit">Claim reward</x-button>
                    </div>
                </form>

            </div>
        </x-modal>
    @endif

    @if ($allowModal)
        <x-modal blur wire:model.defer="allowModal">
            <x-card>
                <main class='flex flex-col items-center justify-center p-6 sm:py-24'>
                <x-badge.circle negative icon="x" />
                    <p>You can't claim your prize because you have not referred three friends yet </p> 
                </main>
            </x-card>
        </x-modal>
    @endif
</div>
