<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
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

    public function with(): array
    {
        return [
            'notes' => Note::all()
        ];
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
    @media (max-width: 1060px) {
      
    .responsive {
      grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    }
  
    @media (max-width: 700px) {
      .responsive {
        grid-template-columns: repeat(1, minmax(0, 1fr));
      }
    }
</style>
    <div class="space-y-2 ">
        @if ($notes->isEmpty())
            <div class="text-center dark:text-gray-300">
                <p class="text-xl  font-bold">No notes yet</p>
                <p class="text-sm">Let's create your first note to send.</p>
                <x-button primary icon-right="plus" class="mt-6" href="{{ route('notes.create') }}" wire:navigate>Create
                    note</x-button>
            </div>
        @else
            <div class="grid dark:text-gray-300 grid-cols-3 gap-4 responsive">
                @foreach ($notes as $note)
                    <div class='relative flex flex-col custom-shadow  justify-between pb-3 bg-white border border-gray-700 w-96 dark:bg-gray-800 hover:bg-gray-600 custom-shadow rounded-xl '
                wire:key='{{ $note->id }}'>
                <div class='flex flex-col justify-center w-full pb-3'>

                    <div class='flex justify-center w-full h-80 p-4'>
                        <img src="{{ asset('storage/' . $note->photo) }}" alt="profile pic" title="bruuvynsons"
                            class='object-cover w-full h-full img rounded-b-2xl rounded-t-xl' />
                    </div>
                    @can('update', $note)
                        <div class='flex items-center justify-between p-3 pt-1'>
                            <p class="overflow-hidden text-2xl font-bold text-left">{{ Str::limit($note->name, 30) }}</p>
                            <x-button.circle href="{{ route('notes.edit', $note) }}" wire:navigate icon="pencil-alt"></x-button.circle>
                        </div>
                    @else
                        <p class="p-3 px-3 overflow-hidden text-2xl font-bold text-left">{{ Str::limit($note->name, 30) }}
                        </p>
                    @endcan
                </div>
                <div class='flex flex-col justify-between w-full px-3'>
                    <div class="w-full">
                        <div class='flex flex-col w-full pb-3'>
                            <p class="text-sm text-left break-words ">{{ Str::limit($note->description, 120) }}</p>
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
                        <x-button.circle icon="eye" href="{{ route('notes.view', $note) }}"></x-button.circle>
                                <x-button.circle icon="trash"
                                    wire:click="delete('{{ $note->id }}')"></x-button.circle>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        @endforeach
</div>
@endif
</div>

{{-- <a download="Download-CV" href="{{ asset('storage/'. $note->cv) }}" id="student-download">download</a> --}}
{{-- <a href="{{($note->linkedin) }}" target="_blank">Link:</a> --}}