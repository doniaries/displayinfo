<?php

namespace App\Listeners\RunningText;

use App\Events\RunningText\RunningTextCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Livewire\Livewire;

class RefreshDisplayRunningText
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
        // Refresh komponen Livewire DisplayRunningText
        Livewire::dispatch('refresh-display-running-text');
    }
}
