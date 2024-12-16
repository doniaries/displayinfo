<?php

namespace App\Observers;

use App\Models\Video;
use Filament\Notifications\Notification;
use Livewire\Livewire;

class VideoObserver
{
    public function created(Video $video): void
    {
        Livewire::dispatch('refresh-video');

        Notification::make()
            ->title('Video berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(Video $video): void
    {
        Livewire::dispatch('refresh-video');

        Notification::make()
            ->title('Video berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(Video $video): void
    {
        Livewire::dispatch('refresh-video');

        Notification::make()
            ->title('Video berhasil dihapus')
            ->success()
            ->send();
    }
}
