<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->email === 'superadmin@gmail.com';
    }

    public function view(User $user, User $model): bool
    {
        return $user->email === 'superadmin@gmail.com';
    }

    public function create(User $user): bool
    {
        return $user->email === 'superadmin@gmail.com';
    }

    public function update(User $user, User $model): bool
    {
        return $user->email === 'superadmin@gmail.com';
    }

    public function delete(User $user, User $model): bool
    {
        return $user->email === 'superadmin@gmail.com';
    }
}
