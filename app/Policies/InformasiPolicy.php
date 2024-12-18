<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Informasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class InformasiPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Informasi $informasi): bool
    {
        return $user->is_admin || $user->current_team_id === $informasi->team_id;
    }

    public function update(User $user, Informasi $informasi): bool
    {
        return $user->is_admin || $user->current_team_id === $informasi->team_id;
    }

    public function delete(User $user, Informasi $informasi): bool
    {
        return $user->is_admin || $user->current_team_id === $informasi->team_id;
    }
}
