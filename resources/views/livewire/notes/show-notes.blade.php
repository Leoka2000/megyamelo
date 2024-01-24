<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {

public $selectedArea = 'None';
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
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
        return ($this->selectedArea == 'None') ? Note::all() : Note::where('area', $this->selectedArea)->get();
    }

    

    
}; ?>



<div>
    <style>
        .custom-shadow {
            box-shadow: rgba(0, 0, 0, 0.09) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
        }

        .custom-shadow:hover {
            box-shadow: rgb(38, 57, 77) 0px 20px 30px -10px;

        }

        @media (max-width: 1270px) {

            .responsive {

                justify-content: center;
                gap: 1.5rem
            }
        }

        
    </style>

    

    <div class="space-y-2 responsive-flex ">
    
          <x-button class='' wire:navigate icon="arrow-left" class="mb-8" href="{{ route('dashboard') }}">Back</x-button>
        
        <select wire:model="selectedArea" wire:change="$refresh">
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
</select>
        <div class="flex justify-center mb-2">
          
            <div class="flex flex-wrap gap-3 px-26 dark:text-gray-300 responsive">
                @foreach ($notes as $note)
                    <div class='relative flex flex-col justify-center pb-3 bg-white border border-gray-700 w-80 custom-shadow sm:w-96 dark:bg-gray-800 hover:bg-gray-600 rounded-xl '
                        wire:key='{{ $note->id }}'>
                        <div class='flex flex-col justify-center w-full pb-3'>

                            <div class='flex justify-center w-full p-4 h-80'>
                                <img src="{{ asset('storage/' . $note->photo) }}" alt="profile pic" title="bruuvynsons"
                                    class='object-cover w-full h-full img rounded-b-2xl rounded-t-xl' />
                            </div>
                            @can('update', $note)
                                <div class='flex items-center justify-between p-3 pt-1'>
                                    <p class="overflow-hidden text-2xl font-bold text-left">
                                        {{ Str::limit($note->name, 30) }}</p>
                                    <x-button.circle href="{{ route('notes.edit', $note) }}" wire:navigate
                                        icon="pencil-alt"></x-button.circle>
                                </div>
                            @else
                                <p class="p-3 px-3 overflow-hidden text-2xl font-bold text-left">
                                    {{ Str::limit($note->name, 30) }}
                                </p>
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
                                        <x-button.circle icon="eye"
                                            href="{{ route('notes.view', $note) }}"></x-button.circle>
                                        <x-button.circle icon="trash"
                                            wire:click="delete('{{ $note->id }}')"></x-button.circle>
                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        {{-- <a download="Download-CV" href="{{ asset('storage/'. $note->cv) }}" id="student-download">download</a> --}}
        {{-- <a href="{{($note->linkedin) }}" target="_blank">Link:</a> --}}
