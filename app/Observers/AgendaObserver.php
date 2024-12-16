<?php

namespace App\Observers;

use App\Models\Agenda;
use Filament\Notifications\Notification;
use Livewire\Livewire;

class AgendaObserver
{
    public function created(Agenda $agenda): void
    {
        // Gunakan nama event yang konsisten
        Livewire::dispatch('refresh-display-agenda');

        Notification::make()
            ->title('Agenda berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(Agenda $agenda): void
    {
        Livewire::dispatch('refresh-display-agenda');

        Notification::make()
            ->title('Agenda berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(Agenda $agenda): void
    {
        Livewire::dispatch('refresh-display-agenda');

        Notification::make()
            ->title('Agenda berhasil dihapus')
            ->success()
            ->send();
    }
}
