<?php

namespace App\Listeners\Informasi;

use App\Events\Informasi\InformasiCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Livewire\Livewire;

class RefreshDisplayInformasi
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
        // Refresh komponen Livewire DisplayInformasi
        Livewire::dispatch('refresh-display-informasi');
    }
}
