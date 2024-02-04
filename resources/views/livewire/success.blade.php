<?php

use Livewire\Volt\Component;
use Illuminate\Support\Facades\Session;
use WireUi\Traits\Actions;

new class extends Component {
     use Actions;
    //
}; ?>

<div>
  @if(session('success_message'))
    <x-dialog :data="session('success_message')" />
@endif
</div>
