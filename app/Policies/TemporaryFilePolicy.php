<?php

namespace App\Policies;

use App\Models\Participant;
use App\Models\TemporaryFile;
use Illuminate\Auth\Access\Response;

class TemporaryFilePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Participant $participant): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Participant $participant, TemporaryFile $temporaryFile): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Participant $participant): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Participant $participant, TemporaryFile $temporaryFile): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Participant $participant, TemporaryFile $temporaryFile): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Participant $participant, TemporaryFile $temporaryFile): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Participant $participant, TemporaryFile $temporaryFile): bool
    {
        //
    }
}
