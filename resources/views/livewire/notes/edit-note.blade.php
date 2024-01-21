<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;
use Livewire\WithFileUploads;

new #[Layout('layouts.app')] class extends Component {
    use WithFileUploads;
    public Note $note;

    public $studentName;
    public $studentEmail;
    public $studentUniversity;
    public $studentPhoto;
    public $studentDegree;
    public $studentArea;
    public $studentDescription;
    public $studentCV;
    public $studentLinkedin;


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
            'studentLinkedin' => ['string', 'min:5'],
        ]);

        $this->note->update([
            'name' => $this->studentName,
            'email' => $this->studentEmail,
            'university' => $this->studentUniversity,
            'degree' => $this->studentDegree,
            'area' => $this->studentArea,
            'description' => $this->studentDescription,
            'send_date' => now(),
            'linkedin' => $this->studentLinkedin,
        ]);

        $this->dispatch('note-saved');
    }

    public function universities()
    {
        return ['Health Sciences', 'Economics and Business', 'Engineering', 'Science and Technology', 'Child and Special Needs Education', 'Music', 'Humanities', 'Law', 'Design', 'Informatics', 'Agriculture, Food Sciences and Environmental Management'];
    }
}; ?>
<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Edit Note') }}
    </h2>
</x-slot>

<div class="py-12 lg:px-64 md:px-36 px-4">
    <x-card title="Edit your profile">
        <x-wui-errors class="mb-4" />

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <x-wui-input label="Full name" placeholder="Leo Reus Oli...." wire:model.defer="studentName" />
            <x-wui-input label="Email" placeholder="leo.oli@gmail.com" wire:model.defer="studentEmail" />

            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <x-wui-input label="University" placeholder="University of Debrecen"
                        wire:model.defer="studentUniversity" />
                </div>

                <div class="col-span-1 sm:col-span-3">
                    <x-wui-input label="Degree" placeholder="Biochemical Engineering BSc"
                        wire:model.defer="studentDegree" />
                </div>
            </div>

            <x-wui-select class='z-10' label="Which field best describes your profile?" placeholder="Engineering"
                wire:model.defer="studentArea" :options="$this->universities()" />

            <x-wui-input label="The link to your LinkedIn profile (optional)"
                placeholder="https://www.linkedin.com/in/leoreus/" wire:model.defer="studentLinkedin" />

            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea
                    label="Write a short description of yourself. You can list things like your career goals and skills."
                    placeholder="I have experience in .... im good at .." wire:model.defer="studentDescription" />
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button wire:click="saveNote" label="Save" spinner="save" primary />
                   <x-action-message on="note-saved" />
            </div>
        </x-slot>
    </x-card>
</div>
</div>
