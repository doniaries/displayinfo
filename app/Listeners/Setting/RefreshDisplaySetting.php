<?php

namespace App\Listeners\Setting;

use App\Events\Setting\SettingCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Livewire\Livewire;

class RefreshDisplaySetting
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
        // Refresh komponen Livewire DisplaySetting
        Livewire::dispatch('refresh-display-setting');
    }
}
