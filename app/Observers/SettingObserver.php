<?php

namespace App\Observers;

use App\Models\Setting;
use Filament\Notifications\Notification;
use Livewire\Livewire;

class SettingObserver
{
    public function created(Setting $setting): void
    {
        Livewire::dispatch('refresh-setting');

        Notification::make()
            ->title('Setting berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(Setting $setting): void
    {
        Livewire::dispatch('refresh-setting');

        Notification::make()
            ->title('Setting berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(Setting $setting): void
    {
        Livewire::dispatch('refresh-setting');

        Notification::make()
            ->title('Setting berhasil dihapus')
            ->success()
            ->send();
    }
}
