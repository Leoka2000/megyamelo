<?php

use Livewire\Volt\Component;
use App\Models\Note;
use App\Models\User;
use Livewire\WithFileUploads;
use Components\Select\Option;
use Components\Select;
use WireUi\View\Components\Input;
use Illuminate\Support\Facades\Session;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\Mail;
use App\Mail\Referral;
use Illuminate\Support\Str;

new class extends Component {
    use Actions;
    use WithFileUploads;
    public $showModal;

    public $studentName;
    public $studentEmail;
    public $studentUniversity;
    public $studentPhoto;
    public $studentDegree;
    public $studentArea;
    public $studentDescription;
    public $studentCV;
    public $studentLinkedin;
    public $studentAccept;
    public $studentOther_links;
    public $referralCodeGiving;

    // REFERRAL EMAIL
    public $name;
    public $email;
    public $referral;

    public function mount()
    {
        $this->openModal();
    }

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function generateReferralCode()
    {
        return Str::random(15); // Generates a random 6-character string
    }

    public function submitEmail()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
        ]);

        $referral = $this->generateReferralCode();

        Mail::to('megymelo4@gmail.com')->send(new Referral($validatedData['name'], $validatedData['email'], $referral));

        Mail::to($validatedData['email'])->send(new Referral($validatedData['name'], $validatedData['email'], $referral));

        $this->dispatch('Message successfully sent!');
    }

    public function submit()
    {
        if ($this->studentLinkedin) {
            $validated = $this->validate([
                'studentLinkedin' => ['url'],
            ]);
        }
        if ($this->studentCV) {
            $validated = $this->validate([
                'studentCV' => 'file|mimes:png,jpg,pdf|max:102400',
            ]);
        }
        if ($this->studentOther_links) {
            $validated = $this->validate([
                'studentOther_links' => ['url'],
            ]);
        }

        $this->authorize('create', Note::class);
        $validated = $this->validate([
            'studentName' => ['required', 'string', 'min:3'],
            'studentEmail' => ['required', 'email'],
            'studentUniversity' => ['required', 'string', 'min:3'],
            'studentPhoto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:102400',
            'studentDegree' => ['required', 'string', 'min:5'],
            'studentArea' => ['required', 'string'],
            'studentDescription' => ['required', 'string', 'min:5'],
            'studentAccept' => ['required', 'boolean'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'name' => $this->studentName,
                'email' => $this->studentEmail,
                'university' => $this->studentUniversity,
                'photo' => $this->studentPhoto->store('photos', 'public'),
                'degree' => $this->studentDegree,
                'area' => $this->studentArea,
                'description' => $this->studentDescription,
                'accept' => $this->studentAccept,
                'referral' => $this->referralCodeGiving,
            ]);

        if ($this->studentCV) {
            auth()
                ->user()
                ->notes()
                ->where('email', $this->studentEmail) // Assuming email is unique and used as a reference to find the note
                ->update(['cv' => $this->studentCV->store('curriculums', 'public')]);
        }

        if ($this->studentLinkedin) {
            auth()
                ->user()
                ->notes()
                ->where('email', $this->studentEmail) // Assuming email is unique and used as a reference to find the note
                ->update(['linkedin' => $this->studentLinkedin]);
        }
        if ($this->studentOther_links) {
            auth()
                ->user()
                ->notes()
                ->where('email', $this->studentEmail) // Assuming email is unique and used as a reference to find the note
                ->update(['other_links' => $this->studentOther_links]);
        }

        $this->dialog()->show([
            'icon' => 'success',
            'title' => 'Profile created!',
            'description' => 'Your profile was successfully created. Now you can view, edit, or delete your profile whenever you feel like it.',
        ]);
    }

    public function universities()
    {
        return ['Health Sciences', 'Economics and Business', 'Engineering', 'Science and Technology', 'Child and Special Needs Education', 'Music', 'Humanities', 'Law', 'Design', 'Informatics', 'Agriculture, Food Sciences and Environmental Management'];
    }
}; ?>

<div class='mb-4 shadow-md dark:shadow-black'>
    <x-card title=" {{ __('create-note.create-2') }} ">
        <x-wui-errors class="px-2 mb-4 shadow-xl shadow-gray-black" />

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <x-wui-input icon='user' label="{{ __('create-note.create-3') }}" placeholder="Kovács László"
                wire:model.defer="studentName" />
            <x-wui-input icon='mail' label="{{ __('create-note.create-4') }}" placeholder="leo.oli@gmail.com"
                wire:model.defer="studentEmail" />

            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <x-wui-input icon='academic-cap' label="{{ __('create-note.create-5') }}"
                        placeholder="University of Debrecen" wire:model.defer="studentUniversity" />
                </div>

                <div class="col-span-1 sm:col-span-3">
                    <x-wui-input icon='academic-cap' label="{{ __('create-note.create-6') }}"
                        placeholder="Biochemical Engineering BSc" wire:model.defer="studentDegree" />
                </div>

            </div>
            <div>
                <x-wui-input icon='microphone' label="Were you referred? Please, inform your code" placeholder=""
                    wire:model.defer="referralCodeGiving" />
            </div>

            <x-wui-select icon='identification' class='z-10' label="{{ __('create-note.create-7') }}"
                placeholder="Engineering" wire:model.defer="studentArea" :options="$this->universities()" />

            <x-wui-input icon='link' label="{{ __('create-note.create-8') }}"
                placeholder="https://www.linkedin.com/in/leoreus/" wire:model.defer="studentLinkedin" />


            <x-wui-input icon='link' label="{{ __('create-note.create-9') }}" placeholder="https://myportfolio.com"
                wire:model.defer="studentOther_links" />

            <div class="col-span-1 sm:col-span-2">
                <x-wui-textarea icon="pencil" label="{{ __('create-note.create-10') }}" placeholder=""
                    wire:model.defer="studentDescription" />
            </div>
            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 mb-6 sm:mb-0 sm:col-span-4">

                    <x-wui-input icon='camera' right-icon='plus' class='w-full text-gray-400'
                        label="{{ __('create-note.create-11') }}" type='file' type="file" id="Profile Pic"
                        wire:model="studentPhoto" />
                </div>
                <div class="col-span-1 sm:col-span-3">

                    <x-wui-input icon='folder-open' right-icon='plus' class='w-full text-gray-400'
                        label="{{ __('create-note.create-12') }}" type='file' type="file" id="exampleInputName"
                        wire:model="studentCV" />
                </div>
            </div>
            <div class='w-full mt-5'>
                <div
                    class='flex flex-col items-start justify-start w-full sm:gap-1 sm:items-center sm:flex-row sm:w-96'>
                    <x-toggle primary wire:model.defer="studentAccept" />
                    {{ __('create-note.create-13') }} <a target='_blank'
                        href='https://docs.google.com/document/d/1Z3cOg7KyUTWwPHxmVul73IqPZxmYqqHq31vYuj-WmRM/edit'
                        class='text-indigo-500 hover:border-b border-b-indigo-500'>
                        {{ __('create-note.create-14') }}</a>
                </div>
            </div>
        </div>

        <x-slot name="footer">
            <div class="flex items-center justify-end gap-x-3">
                <x-button rounded right-icon='plus' class='w-full h-12' wire:click="submit"
                    label="{{ __('create-note.create-15') }}" primary />
            </div>
        </x-slot>
    </x-card>
    @if ($showModal)
        <x-modal class='relative' wire:model="showModal">
            <div class='flex flex-col gap-3'>
                <div class='relative flex flex-col'>
                    <x-card title="Introducing our referral system!">
                        <div class="p-3 md:p-6">
                            <x-button.circle class='absolute -right-1 -top-1' flat xl icon='x-circle' label="Cancel"
                                x-on:click="close" />
                            <p class="text-sm text-gray-600 dark:text-gray-500 sm:text-lg">
                                Invite three friends to create a profile on Megy a Meló and get a mentorship with
                                <a>Emily
                                    Natsumi
                                    Kusano</a>, an HR specialist who has 7+ years of experience with Human Resources who
                                will
                                help
                                you get jobs abroad! <a href="{{ route('notes.natsumi') }}"
                                    class='text-indigo-600 border-b border-b-indigo-600 pointer'>To know more about her,
                                    click
                                    here</a>
                                <br />  <br />
                                Alternatively, if you invite five friends, you and a friend of your choice will get a free review on your CV, LinkedIn, and cover letter
                            </p>

                            <form accept-charset="UTF-8" class='flex flex-col w-full mt-10'
                                wire:submit.prevent="submitEmail">
                                <x-wui-errors class="mb-4" />
                                <!-- Correct order of form inputs -->
                                <div class='flex flex-col items-center gap-4 sm:flex-row'>
                                    <div class='flex-row w-full'>
                                        <label class="mb-1" for="name"> Name </label>
                                        <x-wui-input placeholder='Virág László' class="mb-2" type="text"
                                            icon='user' id="name" wire:model.defer="name" />
                                    </div>
                                    <div class='flex-row w-full'>
                                        <label class="mb-1" for="companyEmail"> Your contact email</label>
                                        <x-wui-input placeholder='youremail@gmail.com' icon="mail" class="mb-2"
                                            type="text" id="email" wire:model.defer="email" />
                                    </div>
                                </div>
                            </form>
                            <x-slot name="footer">
                                <div class="relative flex flex-col justify-center gap-2 mx-4">
                                    <x-action-message class="text-center text-green-500 text-md"
                                        on="Message successfully sent!" />
                                    <x-button teal rounded class='h-12 sm:w-full' wire:click='submitEmail'
                                        spinner="submitEmail" right-icon='mail' label="Submit referral request" />
                                </div>
                            </x-slot>
                        </div>
                    </x-card>


                </div>
                <div>
                    <livewire:notes.referral-reward.referral-claim />
                </div>
            </div>
        </x-modal>
    @endif
</div>
