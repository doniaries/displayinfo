<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Video $video): bool
    {
        return $user->is_admin || $user->current_team_id === $video->team_id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Video $video): bool
    {
        return $user->is_admin || $user->current_team_id === $video->team_id;
    }

    public function delete(User $user, Video $video): bool
    {
        return $user->is_admin || $user->current_team_id === $video->team_id;
    }
}