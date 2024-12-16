<?php

namespace App\Listeners\Video;

use App\Events\Video\VideoCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Livewire\Livewire;

class RefreshDisplayVideo
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
        // Refresh komponen Livewire DisplayVideo
        Livewire::dispatch('refresh-display-video');
    }
}
