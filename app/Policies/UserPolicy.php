<?php

namespace App\Policies;

use App\Models\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;
    public function viewAny(User $user): bool
    {
        return $user->is_admin;
    }

    public function view(User $user, AdminModel $model): bool
    {
        return $user->is_admin;
    }

    public function create(User $user): bool
    {
        return $user->is_admin;
    }

    public function update(User $user, AdminModel $model): bool
    {
        return $user->is_admin;
    }

    public function delete(User $user, AdminModel $model): bool
    {
        return $user->is_admin;
    }
}