<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;
    use Actions;
    public Note $note;

    public $studentName;
    public $studentEmail;
    public $studentUniversity;
    public $studentDegree;
    public $studentArea;
    public $studentDescription;
    public $studentLinkedin;
    public $studentPhoto;
    public $studentCV;
    public $studentOther_links;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->studentName = $note->name;
        $this->studentEmail = $note->email;
        $this->studentUniversity = $note->university;
        $this->studentDegree = $note->degree;
        $this->studentArea = $note->area;
        $this->studentDescription = $note->description;
        $this->studentLinkedin = $note->linkedin;
        $this->studentOther_links = $note->other_links;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'studentName' => ['string', 'min:2'],
            'studentEmail' => ['email'],
            'studentUniversity' => ['string', 'min:2'],
            'studentDegree' => ['string', 'min:3'],
            'studentArea' => ['string', 'min:3'],
            'studentDescription' => ['string', 'min:5'],
            'studentLinkedin' => ['url'],
        ]);
        if ($this->studentPhoto) {
            $validated = $this->validate([
                'studentPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            ]);
        }
        if ($this->studentCV) {
            $validated = $this->validate([
                'studentCV' => 'file|mimes:png,jpg,pdf|max:102400',
            ]);
        }

        if ($this->studentPhoto) {
            $this->note->update([
                'photo' => $this->studentPhoto->store('photos', 'public'),
            ]);
        }
        if ($this->studentCV) {
            $this->note->update([
                'cv' => $this->studentCV->store('curriculums', 'public'),
            ]);
        }
        $this->note->update([
            'name' => $this->studentName,
            'email' => $this->studentEmail,
            'university' => $this->studentUniversity,
            'degree' => $this->studentDegree,
            'area' => $this->studentArea,
            'description' => $this->studentDescription,
            'send_date' => now(),
            'linkedin' => $this->studentLinkedin,
            'other_links' => $this->studentOther_links,
        ]);

        $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Profile edited!',
        ]);
    }

    public function universities()
    {
        return ['Health Sciences', 'Economics and Business', 'Engineering', 'Science and Technology', 'Child and Special Needs Education', 'Music', 'Humanities', 'Law', 'Design', 'Informatics', 'Agriculture, Food Sciences and Environmental Management'];
    }
}; ?>

<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-300">
            {{ __('create-note.note-edit.1') }}
        </h2>
    </x-slot>

    <div class="px-4 py-20 lg:px-64 md:px-36">
        <x-button wire:navigate icon="arrow-left" class="mb-8" href="{{ route('notes.index') }}">
            {{ __('create-note.create-1') }} </x-button>
        <x-card title="{{ __('create-note.note-edit.1') }}">
            <x-wui-errors class="mb-4" />

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                <x-wui-input label="{{ __('create-note.create-3') }}" placeholder="Leo Reus Oli...."
                    wire:model.defer="studentName" />
                <x-wui-input label="{{ __('create-note.create-4') }}" placeholder="leo.oli@gmail.com"
                    wire:model.defer="studentEmail" />

                <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                    <div class="col-span-1 sm:col-span-4">
                        <x-wui-input label="{{ __('create-note.create-5') }}" placeholder="University of Debrecen"
                            wire:model.defer="studentUniversity" />
                    </div>

                    <div class="col-span-1 sm:col-span-3">
                        <x-wui-input label="{{ __('create-note.create-6') }}" placeholder="Biochemical Engineering BSc"
                            wire:model.defer="studentDegree" />
                    </div>
                </div>

                <x-wui-select class='z-10' label="{{ __('create-note.create-7') }}" placeholder="Engineering"
                    wire:model.defer="studentArea" :options="$this->universities()" />

                <x-wui-input label="{{ __('create-note.create-8') }}" placeholder="https://www.linkedin.com/in/leoreus/"
                    wire:model.defer="studentLinkedin" />

                <x-wui-input label="{{ __('create-note.create-9') }}" placeholder="https://www.myportfolio.com"
                    wire:model.defer="studentOther_links" />

                <div class="col-span-1 sm:col-span-2">
                    <x-wui-textarea label="{{ __('create-note.create-10') }}"
                        placeholder="I have experience in .... im good at .." wire:model.defer="studentDescription" />
                </div>
                <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                    <div class="col-span-1 sm:col-span-4">
                        <label>
                            {{ __('create-note.create-11') }}</label>
                        <input class='w-full text-gray-400' label="Upload a photo of yourself" type='file'
                            type="file" id="Profile Pic" wire:model="studentPhoto" />
                    </div>

                    <div class="col-span-1 sm:col-span-3">
                        <label>{{ __('create-note.create-12') }}</label>
                        <input class='w-full text-gray-400' label="Selecione uma foto do produto" type='file'
                            type="file" id="exampleInputName" wire:model="studentCV" />
                    </div>
                </div>
            </div>

            <x-slot name="footer">
                <div class="flex items-center justify-end gap-x-3">
                    <x-button rounded class='w-full h-12 md:w-44' right-icon='bookmark' wire:click="saveNote"
                        label="{{ __('create-note.note-edit.2') }}" spinner primary />

                </div>
            </x-slot>
        </x-card>
    </div>
</div>
