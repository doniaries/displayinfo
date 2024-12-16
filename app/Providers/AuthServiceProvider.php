<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

use App\Models\Team;
use App\Models\User;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;


protected $policies = [
    Team::class => TeamPolicy::class,
    User::class => UserPolicy::class,
];

public function boot()
{
    $this->registerPolicies();

    // Gate::define('owns-team', function (User $user, Team $team) {
    //     return $user->id === $team->user_id;
    // });
}