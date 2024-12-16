<?php

namespace App\Observers;

use App\Models\RunningText;
use Filament\Notifications\Notification;
use Livewire\Livewire;

class RunningTextObserver
{
    public function created(RunningText $runningText): void
    {
        Livewire::dispatch('refresh-running-text');

        Notification::make()
            ->title('Running Text berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(RunningText $runningText): void
    {
        Livewire::dispatch('refresh-running-text');

        Notification::make()
            ->title('Running Text berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(RunningText $runningText): void
    {
        Livewire::dispatch('refresh-running-text');

        Notification::make()
            ->title('Running Text berhasil dihapus')
            ->success()
            ->send();
    }
}
