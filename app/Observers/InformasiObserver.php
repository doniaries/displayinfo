<?php

namespace App\Observers;

use App\Models\Informasi;
use Filament\Notifications\Notification;
use Livewire\Livewire;

class InformasiObserver
{
    public function created(Informasi $informasi): void
    {
        Livewire::dispatch('refresh-informasi');

        Notification::make()
            ->title('Informasi berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(Informasi $informasi): void
    {
        Livewire::dispatch('refresh-informasi');

        Notification::make()
            ->title('Informasi berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(Informasi $informasi): void
    {
        Livewire::dispatch('refresh-informasi');

        Notification::make()
            ->title('Informasi berhasil dihapus')
            ->success()
            ->send();
    }
}
