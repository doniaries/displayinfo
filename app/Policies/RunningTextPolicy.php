<?php

namespace App\Policies;

use App\Models\RunningText;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Mail\Mailables\Content;

class RunningTextPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user, RunningText $runningText): bool
    {
        return $user->is_admin || $user->current_team_id === $runningText->team_id;
    }

    public function update(User $user, RunningText $runningText): bool
    {
        return $user->is_admin || $user->current_team_id === $runningText->team_id;
    }

    public function delete(User $user, RunningText $runningText): bool
    {
        return $user->is_admin || $user->current_team_id === $runningText->team_id;
    }
}
