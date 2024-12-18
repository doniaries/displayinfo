<?php

namespace App\Providers;

use App\Models\Team;
use App\Models\User;
use App\Models\Video;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Quotes;
use App\Models\Setting;
use App\Models\Informasi;
use App\Models\RunningText;
use App\Policies\TeamPolicy;
use App\Policies\UserPolicy;
use App\Policies\VideoPolicy;
use App\Policies\AgendaPolicy;
use App\Policies\BannerPolicy;
use App\Policies\QuotesPolicy;
use App\Policies\SettingPolicy;
use App\Policies\InformasiPolicy;
use App\Policies\RunningTextPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Team::class => TeamPolicy::class,
        User::class => UserPolicy::class,
        Video::class => VideoPolicy::class,
        Setting::class => SettingPolicy::class,
        Informasi::class => InformasiPolicy::class,
        Agenda::class => AgendaPolicy::class,
        Quotes::class => QuotesPolicy::class,
        Banner::class => BannerPolicy::class,
        RunningText::class => RunningTextPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();

        // Super Admin Bypass
        Gate::before(function (User $user, string $ability) {
            return $user->is_admin ? true : null;
        });
    }
}