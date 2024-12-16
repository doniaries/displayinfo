<?php

namespace App\Listeners\Banner;

use App\Events\Banner\BannerCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Livewire\Livewire;

class RefreshDisplayBanner
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle($event): void
    {
        // Refresh komponen Livewire DisplayBanner
        Livewire::dispatch('refresh-display-banner');
    }
}
