<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SettingPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // User dapat melihat setting jika memiliki team
        return $user->current_team_id !== null;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Setting $setting): bool
    {
        // User hanya dapat melihat setting dari team mereka
        return $user->current_team_id === $setting->team_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // User dapat membuat setting jika memiliki team
        return $user->current_team_id !== null;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Setting $setting): bool
    {
        // User hanya dapat mengupdate setting dari team mereka
        return $user->current_team_id === $setting->team_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Setting $setting): bool
    {
        // User hanya dapat menghapus setting dari team mereka
        return $user->current_team_id === $setting->team_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Setting $setting): bool
    {
        // User hanya dapat memulihkan setting dari team mereka
        return $user->current_team_id === $setting->team_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Setting $setting): bool
    {
        // User hanya dapat menghapus permanen setting dari team mereka
        return $user->current_team_id === $setting->team_id;
    }
}