<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agenda;
use Illuminate\Auth\Access\HandlesAuthorization;

class AgendaPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Agenda $agenda): bool
    {
        return $user->is_admin || $user->current_team_id === $agenda->team_id;
    }

    public function update(User $user, Agenda $agenda): bool
    {
        return $user->is_admin || $user->current_team_id === $agenda->team_id;
    }

    public function delete(User $user, Agenda $agenda): bool
    {
        return $user->is_admin || $user->current_team_id === $agenda->team_id;
    }
}
