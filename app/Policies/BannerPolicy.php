<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Banner;
use Illuminate\Auth\Access\HandlesAuthorization;

class BannerPolicy
{
    use HandlesAuthorization;

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