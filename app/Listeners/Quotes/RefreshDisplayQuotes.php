<?php

namespace App\Listeners\Quotes;

use Illuminate\Support\Facades\Log;
use Livewire\Livewire;

class RefreshDisplayQuotes
{
    public function handle($event): void
    {
        Log::info('RefreshDisplayQuotes: Handling quote event');

        // Dispatch Livewire event
        Livewire::dispatch('refresh-quotes');
    }
}
