<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Quotes;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuotesPolicy
{
    use HandlesAuthorization;


    public function view(User $user, Quotes $quotes): bool
    {
        return $user->is_admin || $user->current_team_id === $quotes->team_id;
    }

    public function update(User $user, Quotes $quotes): bool
    {
        return $user->is_admin || $user->current_team_id === $quotes->team_id;
    }

    public function delete(User $user, Quotes $quotes): bool
    {
        return $user->is_admin || $user->current_team_id === $quotes->team_id;
    }
}
