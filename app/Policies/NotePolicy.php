<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session; 
use WireUi\Traits\WireUiActions;

class NotePolicy

{
    
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Note $note): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(): bool
    {
        
        
            $userVariable = auth()->user();
            $numberNotes = $userVariable->notes()->get()->count();
            
            if ($numberNotes >= 1) {
                // Display an error message to the user
                
                Log::info('You cannot create more than oone BIIITCH!');
                throw new \Illuminate\Auth\Access\AuthorizationException('You can not create more than one profile.');
                return false;
                
            } else {
                Log::info('youre allowed!');
                
                return true;
            }
    }
    

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

 

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Note $note): bool
    {
        return $user->id === $note->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Note $note): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Note $note): bool
    {
        //
    }
}



 /*
     
     
    */