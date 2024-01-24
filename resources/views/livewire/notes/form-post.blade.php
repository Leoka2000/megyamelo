<?php

use Livewire\Volt\Component;
use App\Models\Post;
use App\Models\User;
use Livewire\WithFileUploads;
use Components\Select\Option;
use Components\Select;
use WireUi\View\Components\Input;

new class extends Component {
    use WithFileUploads;


public $showModal = false;
    public $companyAuthor;
    public $companyTitle;
    public $companyDescription;
    public $companyImage;
    public $companyLink;

    public function mount()
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin') {
            abort(403, 'You do not have permission to access this component.');
            
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


    public function submit()
    {
         $this->authorize('create', Post::class);
        $validated = $this->validate([
            'companyAuthor' => ['required', 'string', 'min:3'],
            'companyTitle' => ['required', 'string', 'min:3'],
            'companyLink' => ['required', 'string', 'min:3'],

            'companyImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'companyDescription' => ['required', 'string', 'min:5'],
        ]);

        auth()
            ->user()
            ->posts()
            ->create([
                'author' => $this->companyAuthor,
                'title' => $this->companyTitle,
                'description' => $this->companyDescription,
                'apply_link' => $this->companyLink,
                'image' => $this->companyImage->store('company', 'public'),
            ]);
        redirect(route('dashboard'));
    }
}; ?>



<div>
<div>


    @if ($showModal)
        <x-modal wire:model="showModal" class="" title="Simple Modal">
            <div class='flex flex-col h-auto gap-2 p-12 bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                <p class='mb-4 sm:text-base'>Are you sure that you want to spend a coin creating this post?</p>
                <x-button outlined icon='arrow-left' wire:click="closeModal">Back</x-button>
                <x-button wire:click='submit' primary icon='plus'>Post</x-button>
            </div>
        </x-modal>
    @endif
</div>

    <x-card title="Post a job advertisement">
        <x-wui-errors class="mb-4" />

        <div class="flex flex-col gap-6">
            <x-wui-input label="Your company's name" placeholder="Company ABC Kft" wire:model.defer="companyAuthor" />

            <p class='font-semibold'>Details of your post</p>
                 <x-wui-input label="Title" placeholder="Software Engineer Part Time" wire:model.defer="companyTitle" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea
                    label="Description of your advertisement"
                    placeholder="We are hiring for a accounts payable intern at the Budapest office this summer, your roles will be ... you are expected to..." wire:model.defer="companyDescription" />
            </div>
            <div class='col-span-1'> <x-wui-input label="Link to apply" placeholder="https://example.com/apply"
                    wire:model.defer="companyLink" /></div>
            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <label >
                        You can include a photo in your post</label>
                    <input class='w-full text-gray-400' label="Upload a photo of yourself" type='file' type="file"
                        id="Profile Pic" wire:model="companyImage" />

                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button wire:click="openModal" label="Post" spinner="save" primary />
            </div>
        </x-slot>
    </x-card>
</div>
