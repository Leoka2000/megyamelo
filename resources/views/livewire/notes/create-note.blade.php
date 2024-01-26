<?php

use Livewire\Volt\Component;
use App\Models\Note;
use App\Models\User;
use Livewire\WithFileUploads;
use Components\Select\Option;
use Components\Select;
use WireUi\View\Components\Input;
use Illuminate\Support\Facades\Session;

new class extends Component {
    use WithFileUploads;

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
                'cv' => $this->studentCV->store('curriculums', 'public'),
                'linkedin' => $this->studentLinkedin,
             
                    
            ]);
     

         
        
           redirect(route('notes.index'));
    }

    public function universities()
    {
        return ['Health Sciences', 'Economics and Business', 'Engineering', 'Science and Technology', 'Child and Special Needs Education', 'Music', 'Humanities', 'Law', 'Design', 'Informatics', 'Agriculture, Food Sciences and Environmental Management'];
    }
}; ?>

<div>
    <x-card
        title="When you fill out this form, keep in mind that it's your chance to 
show off your skills to potential employers.">
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
                    label="Write a short description of yourself. You can list things such as your career goals and skills."
                    placeholder="I have experience in .... im good at .." wire:model.defer="studentDescription" />
            </div>
            <div class="col-span-1 sm:col-span-2 sm:grid sm:grid-cols-7 sm:gap-5">
                <div class="col-span-1 sm:col-span-4">
                    <label>
                        Please, upload a photo of yourself</label>
                    <input class='w-full text-gray-400' label="Upload a photo of yourself" type='file' type="file"
                        id="Profile Pic" wire:model="studentPhoto" />

                </div>

                <div class="col-span-1 sm:col-span-3">
                    <label>Please, upload your CV (optional) </label>
                    <input class='w-full text-gray-400' label="Selecione uma foto do produto" type='file'
                        type="file" id="exampleInputName" wire:model="studentCV" />

                </div>
            </div>
            <div class='w-full'>
                <div class='flex items-center justify-start gap-1 w-80'>
                    <x-toggle primary wire:model.defer="studentAccept" />
                    I accept the <a href='#' class='text-indigo-500 hover:border-b border-b-indigo-500'> terms and
                        conditions</a>
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
