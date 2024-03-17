<?php

use Livewire\Volt\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithFileUploads;
use Components\Select\Option;
use Components\Select;
use WireUi\View\Components\Input;
use WireUi\Traits\Actions;

new class extends Component {
    use WithFileUploads;
    use Actions;

    public $showModal = false;
    public $showPaymentModal = false;
    public $showPermanentModal = false;
 
    public $companyAuthor;
    public $companyTitle;
    public $companyDescription;
    public $companyImage;
    public $companyLink;
    public $companyEmail;
    public $companyModality;
    public $companyPayment;
    public $companyContactEmail;
    public $companyAccept;
    public $companyHours;

  

    public function mount()
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin' && $currentUser->role !== 'superadmin') {
            $this->openPermanentModal();
        }
    }
    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function openPermanentModal()
    {
        $this->showPermanentModal = true;
    }

    public function openPaymentModal()
    {
        $this->showPaymentModal = true;
    }

    public function closePaymentModal()
    {
        $this->showPaymentModal = false;
    }

    public function submit()
    {
        if ($this->companyLink) {
            $validated = $this->validate([
                'companyLink' => ['url'],
            ]);
        }

        if ($this->companyImage) {
            $validated = $this->validate([
                'companyImage' => 'image|mimes:png,jpg,pdf|max:102400',
            ]);
        }

        if ($this->companyEmail) {
            $validated = $this->validate([
                'companyEmail' => ['required', 'email'],
            ]);
        }

        $this->closeModal();
        $validated = $this->validate([
            'companyAuthor' => ['required', 'string', 'min:3'],
            'companyTitle' => ['required', 'string', 'min:3'],
            'companyModality' => ['required', 'string', 'min:3'],

            'companyDescription' => ['required', 'string'],
            'companyPayment' => ['required', 'string'],
            'companyContactEmail' => ['required', 'email'],
            'companyAccept' => ['required', 'boolean'],
            'companyHours' => ['required', 'numeric'],
        ]);
        // If user created a post, take out one coin
        $user = auth()->user();
        if ($user->coins <= 0) {
            // User has insufficient coins, display modal
            $this->showPaymentModal = true;
        } else {
            // Decrease the user's coins by one
            $this->authorize('create', Post::class);
            $this->showModal = false;
            $user->coins -= 1;
            $user->save();

            auth()
                ->user()
                ->posts()
                ->create([
                    'author' => $this->companyAuthor,
                    'title' => $this->companyTitle,
                    'description' => $this->companyDescription,
                    'apply_link' => $this->companyLink,
                    'apply_email' => $this->companyEmail,
                    'image' => $this->companyImage->store('company', 'public'),

                    'modality' => $this->companyModality,
                    'payment' => $this->companyPayment,
                    'contact_email' => $this->companyContactEmail,
                    'accept_terms' => $this->companyAccept,
                    'hours' => $this->companyHours,
                ]);

            $this->dialog()->show([
                'icon' => 'success',
                'title' => 'Post created!',
                'description' => 'Your post was successfully created. Now you can view, edit, or delete your post whenever you feel like it.',
            ]);
        }
    }

    public function modalities()
    {
        return ['Remote', 'On-site', 'Hybrid'];
    }

    public function payment()
    {
        return ['No payment', 'Payment included', 'Less than 1,850Ft / Hour', '1900Ft - 2100Ft / Hour', '2100Ft - 2300Ft / Hour', '2300Ft - 2500Ft / Hour', '2500Ft - 2700Ft / Hour', 'More than 2700Ft / Hour'];
    }
}; ?>




<div class='shadow-md dark:shadow-black'>
    <div class=''>


        @if ($showModal)
            <x-modal wire:model="showModal" title="Simple Modal">
                <div class='flex flex-col h-auto gap-2 p-4 bg-gray-100 dark:text-gray-300 sm:p-12 dark:bg-gray-900 w-96 rounded-xl '>
                    <p class='mb-4 sm:text-base'> {{ __('job.create-modal.1') }}</p>
                    <x-button outlined icon='arrow-left'
                        wire:click="closeModal">{{ __('show-notes.show-notes-2') }}</x-button>
                    <x-button wire:click='submit' primary icon='plus'>{{ __('job.create-modal.2') }}</x-button>
                </div>
            </x-modal>
        @endif
        @if ($showPermanentModal)
            <x-modal wire:model="showPermanentModal" blur="sm" persistent title="Simple Modal">
                <div
                    class='inline-block h-auto gap-2 p-6 text-lg text-center bg-gray-100 sm:p-12 dark:bg-gray-900 dark:text-gray-400 w-96 rounded-xl'>
                    <strong class='inline-block dark:text-gray-300'> {{ __('job.create-job.1') }}</strong>
                    {{ __('job.create-job.2') }}

                    {{ __('job.create-job.4') }}
                    </p>
                    <div class='flex flex-col gap-2 mt-5'>
                        <livewire:company-access.request-button />
                        <x-button href="{{ route('dashboard') }}" outlined red outline
                            icon='arrow-left'>{{ __('show-notes.show-notes-2') }}</x-button>
                    </div>
                </div>
            </x-modal>
        @endif

        @if ($showPaymentModal)
            <x-modal wire:model="showPaymentModal" class="" title="PAYMENT MODAL">
                <div
                    class='flex flex-col h-auto gap-2 p-12 bg-white dark:bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                    <span class='flex justify-center w-full'>
                        <x-badge.circle lg negative icon="x" />
                    </span>
                    <p class='mb-4 sm:text-base'> {{ __('job.no-coins.1') }} </p>
                    <x-button outlined icon='arrow-left'
                        wire:click="closePaymentModal">{{ __('show-notes.show-notes-2') }}</x-button>
                    <x-button href="{{ route('notes.payment.payment-index') }}" green
                        icon='shopping-cart'>{{ __('job.no-coins.2') }} </x-button>
                </div>
            </x-modal>
        @endif
    </div>

    <x-card title="{{ __('job.post-job.1') }}">
        <x-wui-errors class="mb-4" />
        <div class="flex flex-col gap-6">
            <x-wui-input icon='user' label="{{ __('job.post-job.2') }}" placeholder="Company ABC Kft"
                wire:model.defer="companyAuthor" />
            <x-wui-input label="{{ __('job.post-job.new-post-job.1') }}" icon='mail' placeholder="példa@gmail.com"
                wire:model.defer="companyContactEmail" />

            <x-wui-input right-icon="plus" class='h-52' icon='camera' class='w-full text-gray-400'
                label="{{ __('job.post-job.7') }}" type='file' type="file" id="Profile Pic"
                wire:model="companyImage" />


            <p class='pb-2 font-medium border-b border-gray-300 dark:border-none'>{{ __('job.post-job.3') }}</p>
            <x-wui-input icon='tag' label="{{ __('job.post-job.4') }}" placeholder="Software Engineer Part Time"
                wire:model.defer="companyTitle" />
            <x-wui-select icon='identification' class='z-30' placeholder="Remote"
                label="{{ __('job.post-job.new-post-job.2') }}" wire:model.defer="companyModality" :options="$this->modalities()" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea class='h-52' label="{{ __('job.post-job.5') }}"
                    placeholder="We are hiring for a accounts payable intern at the Budapest office this summer, your roles will be ... you are expected to..."
                    wire:model.defer="companyDescription" />
            </div>



            <x-wui-select icon='currency-dollar' class='z-30' placeholder="Payment Included"
                label="{{ __('job.post-job.new-post-job.3') }}" wire:model.defer="companyPayment" :options="$this->payment()" />

            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.6') }}" icon='link'
                    placeholder="https://example.com/apply" wire:model.defer="companyLink" />
            </div>
            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.6.1') }}" icon='mail'
                    placeholder="azenvallalkozasom@gmail.com" wire:model.defer="companyEmail" /></div>

            <div class='col-span-1'> <x-wui-input label="{{ __('job.post-job.new-post-job.4') }}" icon='clock'
                    placeholder="25" wire:model.defer="companyHours" /></div>



            <div class='w-full mt-5'>
                <div
                    class='flex flex-col items-start justify-start w-full text-sm sm:gap-1 sm:items-center sm:flex-row '>
                    <x-toggle primary wire:model.defer="companyAccept" />
                    {{ __('create-note.create-13') }} <a target='_blank'
                        href='https://docs.google.com/document/d/1Z3cOg7KyUTWwPHxmVul73IqPZxmYqqHq31vYuj-WmRM/edit'
                        class='text-indigo-500 hover:border-b border-b-indigo-500'>
                        {{ __('welcome.footer-2.1') }}</a>
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button rounded right-icon='plus' class='w-full h-12 sm:w-36' lazy wire:click="openModal"
                    label="{{ __('job.post-job.8') }}" primary />
            </div>
        </x-slot>
    </x-card>
</div>
