<?php

namespace App\Providers;

use App\Livewire\DisplayAgenda;
use App\Livewire\DisplayBanner;
use App\Livewire\DisplayInformasi;
use App\Livewire\DisplayJadwalSholat;
use App\Livewire\DisplayRunningText;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Livewire::component('display-banner', DisplayBanner::class);
        Livewire::component('display-running-text', DisplayRunningText::class);
        Livewire::component('display-agenda', DisplayAgenda::class);
        Livewire::component('display-jadwal-sholat', DisplayJadwalSholat::class);
        Livewire::component('display-informasi', DisplayInformasi::class);
    }
}
