<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function test () 
    {
    $note = new Note();
$note->toTerminal();
}
}; ?>

<div>
     <x-button wire:click="test" label="Save" spinner="save" primary />
</div>
