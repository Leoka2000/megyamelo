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

    public $companyAuthor;
    public $companyTitle;
    public $companyDescription;
    public $companyImage;

    public function submit()
    {
       $validated = $this->validate([
            'companyAuthor' => ['required', 'string', 'min:3'],
            'companyTitle' => ['required', 'string', 'min:3'],
          
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
                'image' => $this->companyImage->store('company', 'public'),
            ]);
        redirect(route('dashboard'));
    }
}; ?>

<div>
    <x-card title="Personal Information">
        <x-wui-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <x-wui-input label="Full name" placeholder="Leo Reus Oli...." wire:model.defer="companyAuthor" />
            <x-wui-input label="Email" placeholder="leo.oli@gmail.com" wire:model.defer="companyTitle" />
            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea
                    label="Write a short description of yourself. You can list things like your career goals and skills."
                    placeholder="I have experience in .... im good at .." wire:model.defer="companyDescription" />
            </div>
            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <label>
                        Please, upload a photo of yourself</label>
                    <input class='w-full text-gray-400' label="Upload a photo of yourself" type='file' type="file"
                        id="Profile Pic" wire:model="companyImage" />

                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button wire:click="submit" label="Save" spinner="save" primary />
            </div>
        </x-slot>
    </x-card>
</div>
