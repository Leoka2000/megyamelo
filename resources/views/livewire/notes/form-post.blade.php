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
    public $companyLink;

    public function mount()
    {
        $currentUser = auth()->user();

        if ($currentUser->role !== 'admin') {
            abort(403, 'You do not have permission to access this component.');
        }
 $this->redirect('/', navigate: true);

 
    }


    public function submit()
    {
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

<script>
    document.addEventListener('livewire:load', function () {
        Livewire.on('redirectToDashboard', function () {
            setTimeout(function () {
                window.location.href = '{{ route('dashboard') }}';
            }, 3000); // 3000 milliseconds (3 seconds) delay
        });
    });
</script>

<div>


    <x-card title="Post a job advertisement">
        <x-wui-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <x-wui-input label="Your company's name" placeholder="Company ABC Kft" wire:model.defer="companyAuthor" />
            <x-wui-input label="Title " placeholder="Title of your advertisement" wire:model.defer="companyTitle" />
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
                <x-button wire:click="submit" label="Post" spinner="save" primary />
            </div>
        </x-slot>
    </x-card>
</div>
