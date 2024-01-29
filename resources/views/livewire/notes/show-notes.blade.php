<?php

use Livewire\Volt\Component;
use App\Models\Note;
use WireUi\Traits\Actions;

new class extends Component {
     use Actions;
     
    public $selectedArea = 'None';
    public $showModal = false;
    public $noteToDelete;

    public function openModal($noteId)
    {
        $this->noteToDelete = Note::find($noteId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
        $this->closeModal();

         $this->notification()->error(
            $title = 'Post deleted',
            $description = 'Your post was deleted'
        ); 
    }

    public function with(): array
    {
        $notes = $this->getFilteredNotes();
        return [
            'notes' => $notes,
        ];
    }

    private function getFilteredNotes()
    {
        // Filter notes based on the selected area
        return $this->selectedArea == 'None' ? Note::all() : Note::where('area', $this->selectedArea)->get();
    }
}; ?>



<div class='flex justify-center'>
    <style>
       
        .custom-shadow:hover {
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;

        }

        @media (max-width: 1270px) {

            .responsive {


                gap: 0.5rem
            }
        }

        @media (max-width: 1070px) {

            .responsive {
                justify-content: center
            }
        }
    </style>



    <div class="flex flex-col max-w-5xl space-y-2 ">


        <header class='flex justify-center'>
            <div class='flex flex-col items-center mb-8 max-w-56'>
                <x-button class='w-full mb-8 ' wire:navigate icon="arrow-left"
                    href="{{ route('dashboard') }}">Back</x-button>
                <x-native-select label='Filter by area' class='shadow-md max-w-56 shadow-black ' wire:model="selectedArea" wire:change="$refresh">
                    <option value="None">All Areas</option>
                    <option value="Health Sciences">Health Sciences</option>
                    <option value="Economics and Business">Economics and Business</option>
                    <option value="Engineering">Engineering</option>
                    <option value="Science and Technology">Science and Technology</option>
                    <option value="Child and Special Needs Education">Child and Special Needs Education</option>
                    <option value="Music">Music</option>
                    <option value="Humanities">Humanities</option>
                    <option value="Law">Law</option>
                    <option value="Design">Design</option>
                    <option value="Informatics">Informatics</option>
                    <option value="Agriculture, Food Sciences and Environmental Management">Agriculture, Food
                        Sciences and Environmental Management</option>
                </x-native-select>
            </div>
        </header>

        <div class="flex flex-wrap justify-start gap-2 sm:px-26 dark:text-gray-300 responsive">
            @foreach ($notes as $note)
                <div class='relative flex flex-col justify-start pb-3 bg-white border border-gray-600 rounded-lg shadow-xl min-w-72 custom-shadow sm:w-80 dark:bg-gray-800 hover:bg-gray-600 shadow-black '
                    wire:key='{{ $note->id }}'>
                    <div class='flex flex-col justify-center w-full pb-3'>

                        <div class='flex justify-center p-4 w-80 h-80'>
                            <img src="{{ asset('storage/' . $note->photo) }}" alt="profile pic" title="bruuvynsons"
                                class='object-cover w-full h-full rounded-t-lg img rounded-b-xl' />
                        </div>
                        @can('update', $note)
                            <div class='flex items-center justify-between p-3 pt-1'>
                                <p class="overflow-hidden text-2xl font-bold text-left">
                                    {{ Str::limit($note->name, 30) }}</p>
                                <x-button.circle href="{{ route('notes.edit', $note) }}" green outline
                                    icon="pencil-alt"></x-button.circle>
                            </div>
                        @else
                            <div class='flex items-center justify-between p-3 pt-1'>
                                <p class="overflow-hidden text-2xl font-bold text-left">
                                    {{ Str::limit($note->name, 30) }}</p>
                                <x-button.circle href="{{ route('notes.edit', $note) }}"
                                    icon="pencil-alt"></x-button.circle>
                            </div>
                        @endcan
                    </div>
                    <div class='flex flex-col justify-between w-full px-3'>
                        <div class="w-full">
                            <div class='flex flex-col w-full pb-3'>
                                <p class="text-sm text-left break-words ">
                                    {{ Str::limit($note->description, 120) }}</p>
                            </div>
                            <div class="flex flex-col items-end justify-between">
                                <div class='flex flex-col w-full mb-4'>
                                    <p class="overflow-hidden text-sm font-bold text-left">Field: <span
                                            class='text-sm font-normal'>{{ $note->area }} </span></p>
                                    <p class="text-sm font-bold">University: <span
                                            class="text-sm font-normal ">{{ $note->university }}</span>
                                    </p>
                                </div>
                                <div class='flex justify-end w-full gap-4'>
                                    <x-button.circle icon="eye" primary outline
                                        href="{{ route('notes.view', $note) }}"></x-button.circle>
                                    @can('delete', $note)
                                        <x-button.circle icon="trash" red outline
                                            wire:click="openModal('{{ $note->id }}')"></x-button.circle>
                                    @else
                                        <x-button.circle icon="trash"
                                            wire:click="delete('{{ $note->id }}')"></x-button.circle>
                                    @endcan
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
                @if ($showModal)
                    <x-modal wire:model="showModal" class="" title="Simple Modal">
                        <div class='flex flex-col h-auto gap-2 p-12 bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
                            <p class='mb-4 sm:text-base'>Are you sure you want to delete the profile?</p>
                            <x-button primary icon='arrow-left' wire:click="closeModal">Back</x-button>
                            <x-button flat negative outline icon='trash'
                                wire:click="delete('{{ $noteToDelete->id }}')">Delete</x-button>
                        </div>
                    </x-modal>
                @endif
            @endforeach


        </div>
    </div>

    {{-- <a download="Download-CV" href="{{ asset('storage/'. $note->cv) }}" id="student-download">download</a> --}}
    {{-- <a href="{{($note->linkedin) }}" target="_blank">Link:</a> --}}
