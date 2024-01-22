<?php

use App\Models\Note;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
    
    Route::view('create-profile', 'notes.create')
    ->middleware(['auth'])
    ->name('notes.create');

    Route::view('students-list', 'notes.index')
    ->middleware(['auth'])
    ->name('notes.index');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Volt::route('profile/{note}/edit', 'notes.edit-note')
    ->middleware(['auth'])
    ->name('notes.edit');

    Route::get('note/{note}', function (Note $note) {
    
        $user = $note->user;
    
        return view('notes.view', ['note' => $note, 'user' => $user]);
    })->name('notes.view');

require __DIR__.'/auth.php';
