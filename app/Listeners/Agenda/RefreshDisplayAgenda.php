<?php

namespace App\Listeners\Agenda;

use App\Events\Agenda\AgendaCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Livewire\Livewire;

class RefreshDisplayAgenda
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
        // Refresh komponen Livewire DisplayAgenda
        Livewire::dispatch('refresh-display-agenda');
    }
}
