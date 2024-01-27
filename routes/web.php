<?php

use App\Http\Controllers\ProductController;
use App\Models\Note;
use App\Models\Post;
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

    Route::view('show-jobs', 'notes.jobs')
    ->middleware(['auth'])
    ->name('notes.jobs');

    Route::get('/payment', [ProductController::class, 'index'])->name('notes.payment.payment-index');
                                                      //checkout method here(checkoutfunction)
    Route::post('/checkout', [ProductController::class, 'checkout'])->name('checkout');
    Route::get('/success', [ProductController::class, 'success'])->name('notes.payment.checkout-success');
Route::get('/cancel', [ProductController::class, 'cancel'])->name('notes.payment.checkout-cancel');
Route::post('/webhook', [ProductController::class, 'webhook'])->name('checkout.webhook');


    Route::view('create-post', 'notes.post-create')
    ->middleware(['auth'])
    ->name('notes.post-create');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    Volt::route('profile/{note}/edit', 'notes.edit-note')
    ->middleware(['auth'])
    ->name('notes.edit');


    Volt::route('post/{post}/edit', 'notes.edit-post')
    ->middleware(['auth'])
    ->name('notes.edit-post');

    Route::get('note/{note}', function (Note $note) {
    
        $user = $note->user;
    
        return view('notes.view', ['note' => $note, 'user' => $user]);
    })->name('notes.view');

require __DIR__.'/auth.php';
