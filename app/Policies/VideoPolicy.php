<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Video;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideoPolicy
{
    use HandlesAuthorization;

    public function view(User $user, video $video): bool
    {
        return $user->is_admin || $user->current_team_id === $video->team_id;
    }

    public function update(User $user, video $video): bool
    {
        return $user->is_admin || $user->current_team_id === $video->team_id;
    }

    public function delete(User $user, video $video): bool
    {
        return $user->is_admin || $user->current_team_id === $video->team_id;
    }
}
