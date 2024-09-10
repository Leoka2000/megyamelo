<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use App\Models\Note;
use WireUi\Traits\Actions;

new class extends Component {
    use Actions, WithPagination;

    public $selectedArea = 'None';
    public $showModal = false;
    public $noteToDelete;

    public function openModal($noteId)
    {
        $this->noteToDelete = Note::find($noteId);
        $this->showModal = true;
    }

    public function mount()
    {
        // Retrieve the selectedArea from localStorage if available
        $this->selectedArea = session('selected_area', 'None');
    }

    public function updatedSelectedArea($value)
    {
        // Store the selected area value in the session
        session(['selected_area' => $value]);
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

        $this->notification()->error($title = 'Post deleted', $description = 'Your post was deleted');
    }



    private function getFilteredNotes()
    {
        return $this->selectedArea == 'None'
            ? Note::orderBy('created_at', 'desc')->paginate(3)->onEachSide(5)  // 3 notes per page
            : Note::where('area', $this->selectedArea)
            ->orderBy('created_at', 'desc')
            ->paginate(6)->onEachSide(5);
    }

    public function with(): array
    {
        $storedArea = session('selected_area', 'None');

        $notes = $this->getFilteredNotes();
        return [
            'notes' => $notes,
        ];
    }

    public function placeholder()
    {
        return <<<'HTML'
                <div role="status">
            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
        HTML;
    }

    public function placeholderForImage()
    {
        return <<<'HTML'

           <span class="loader"></span>

        HTML;
    }
}; ?>




<div class='flex justify-center'>

    <style>
        .loader {
            width: 100%;
            height: 100%;
            display: block;
            margin: auto;
            position: relative;
            background: #FFF;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .loader::after {
            content: '';
            width: calc(100% - 30px);
            height: calc(100% - 30px);
            top: 15px;
            left: 15px;
            position: absolute;
            background-image: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.5) 50%, transparent 100%),
                radial-gradient(circle 50px, #DDD 100%, transparent 0),
                linear-gradient(#DDD 16px, transparent 0),
                linear-gradient(#DDD 24px, transparent 0);
            background-repeat: no-repeat;
            background-size: 75px 175px, 100% 100px, 80% 16px, 80% 16px;
            background-position: -185px 0, center 10px, center 125px, center 155px;
            box-sizing: border-box;
            animation: animloader 1s linear infinite;
            /* Adjusted animation duration */
        }

        @keyframes animloader {
            to {
                background-position: 185px 0, center 10px, center 125px, center 155px;
            }
        }


        .right-custom {
            right: 120px
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



    <div class="flex flex-col max-w-6xl space-y-2 dark:text-gray-300 ">

        <header class='block max-w-96'>
            <div
                class='flex max-w-full mb-5 md:max-w-96 xl:max-w-3xl '>
                <x-card title="{{ __('create-note.create-001') }}">
                    <x-slot name="action">
                        <x-icon sm name="information-circle" class="w-6 h-6 font-thin text-orange-500" />

                    </x-slot>
                    <div class=''>
                        <x-button md class='w-full mt-5' primary icon='user' href="{{ route('notes.create') }}"
                            icon-right="plus" label="{{ __('welcome.footer-3') }}" />
                    </div>
                </x-card>
            </div>

            <div class='flex flex-col justify-end w-full mb-4'>

                <x-native-select label="{{__('show-notes.show-notes-2.1')}}" class='w-full shadow-'
                    wire:model="selectedArea" wire:change="$refresh">
                    <option value="None">{{ __('show-notes.show-notes-3') }}</option>
                    <option value="Health Sciences">{{ __('show-notes.show-notes-6.1') }}</option>
                    <option value="Economics and Business">{{ __('show-notes.show-notes-6.2') }}</option>
                    <option value="Engineering">{{ __('show-notes.show-notes-6.3') }}</option>
                    <option value="Science and Technology">{{ __('show-notes.show-notes-6.4') }}</option>
                    <option value="Child and Special Needs Education">{{ __('show-notes.show-notes-6.5') }}</option>
                    <option value="Music">{{ __('show-notes.show-notes-6.6') }}</option>
                    <option value="Humanities">{{ __('show-notes.show-notes-6.7') }}</option>
                    <option value="Law">{{ __('show-notes.show-notes-6.8') }}</option>
                    <option value="Design">Design</option>
                    <option value="Informatics">{{ __('show-notes.show-notes-6.10') }}</option>
                    <option value="Agriculture, Food Sciences and Environmental Management">
                        {{ __('show-notes.show-notes-6.11') }}
                    </option>
                </x-native-select>
            </div>


        </header>
        <div class="my-8">
            {{ $notes->links(data: ['scrollTo' => false]) }} <!-- Tailwind CSS pagination controls -->
        </div>

        <div class="grid justify-center grid-cols-1 gap-3 md:grid-cols-2 lg:grid-cols-3">
            @foreach ($notes as $note)
            <div class='relative flex flex-col justify-start pb-3 transition-all bg-white border rounded-lg shadow-lg dark:border-gray-900 md:w-72 sm:w-96 hover:shadow-2xl dark:hover:bg-gray-800   dark:bg-gray-900 '
                wire:key='{{ $note->id }}'>
                <div class='flex flex-col justify-center w-full pb-3'>
                    <div class='flex items-center justify-center '>
                        <div class="relative p-4 h-80 w-80" x-data="{ loaded: false }">
                            <img x-ref="lazyImage" src="{{ asset('storage/' . $note->photo) }}" alt="profile pic"
                                title="profile image"
                                class='object-cover w-full h-full rounded-t-lg brightness-75 rounded-b-xl'
                                loading="lazy" @load="loaded = true" />
                            <div class='absolute top-0 right-0 w-full h-full' x-show="!loaded" x-cloak>
                                {!! $this->placeholderForImage() !!}
                            </div>
                        </div>
                    </div>
                    @can('update', $note)
                    <div class='flex items-center justify-between p-3 pt-1'>
                        <p class="overflow-hidden text-2xl font-bold text-left">
                            {{ Str::limit($note->name, 30) }}
                        </p>
                        <x-button.circle href="{{ route('notes.edit', $note) }}" green outline
                            icon="pencil-alt"></x-button.circle>
                    </div>

                    @endcan
                </div>
                <div class='flex flex-col justify-between w-full px-3'>
                    <div class="w-full">
                        <div class='flex flex-col w-full pb-3'>
                            <p class="text-sm text-left break-words max-w-64 dark:text-gray-400">
                                {{ Str::limit($note->description, 120) }}
                            </p>
                        </div>
                        <div class="flex flex-col items-end justify-between">
                            <div class='flex flex-col w-full mb-4'>
                                <p class="overflow-hidden text-sm font-bold text-left">
                                    {{ __('show-notes.show-notes-4') }} <span
                                        class='text-sm font-normal dark:text-gray-400'>{{ $note->area }}
                                    </span>
                                </p>
                                <p class="text-sm font-bold"> {{ __('show-notes.show-notes-5') }} <span
                                        class="text-sm font-normal dark:text-gray-400 ">{{ $note->degree }}</span>
                                </p>
                            </div>
                            <div class='flex justify-end w-full gap-4'>
                                <x-button.circle icon="eye" primary outline
                                    href="{{ route('notes.view', $note) }}"></x-button.circle>
                                @can('delete', $note)
                                <x-button.circle icon="trash" red outline
                                    wire:click="openModal('{{ $note->id }}')"></x-button.circle>

                                @endcan
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            @if ($showModal)
            <x-modal wire:model="showModal" class="" title="Simple Modal">
                <div class='flex flex-col h-auto gap-2 p-12 bg-gray-300 dark:bg-gray-900 dark:text-gray-300 w-96 rounded-xl '>
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