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
    public function viewAny(User $user): bool
    {
        return true; // Semua user bisa lihat list
    }

    public function view(User $user, Content $content): bool
    {
        return $user->is_admin || $user->current_team_id === $content->team_id;
    }

    public function create(User $user): bool
    {
        return true; // Semua user bisa create
    }

    public function update(User $user, Content $content): bool
    {
        return $user->is_admin || $user->current_team_id === $content->team_id;
    }

    public function delete(User $user, Content $content): bool
    {
        return $user->is_admin || $user->current_team_id === $content->team_id;
    }
}