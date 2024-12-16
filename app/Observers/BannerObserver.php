<?php

namespace App\Observers;

use App\Models\Banner;
use Filament\Notifications\Notification;
use Livewire\Livewire;

class BannerObserver
{
    public function created(Banner $banner): void
    {
        Livewire::dispatch('refresh-display-banner');

        Notification::make()
            ->title('Banner berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(Banner $banner): void
    {
        Livewire::dispatch('refresh-display-banner');

        Notification::make()
            ->title('Banner berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(Banner $banner): void
    {
        Livewire::dispatch('refresh-display-banner');

        Notification::make()
            ->title('Banner berhasil dihapus')
            ->success()
            ->send();
    }
}
