<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Banner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Banner $banner): bool
    {
        return $user->is_admin || $user->current_team_id === $banner->team_id;
    }

    public function update(User $user, Banner $banner): bool
    {
        return $user->is_admin || $user->current_team_id === $banner->team_id;
    }

    public function delete(User $user, Banner $banner): bool
    {
        return $user->is_admin || $user->current_team_id === $banner->team_id;
    }
}
