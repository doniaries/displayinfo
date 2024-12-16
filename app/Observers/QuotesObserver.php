<?php

namespace App\Observers;

use App\Models\Quotes;
use App\Events\Quotes\QuoteCreated;
use App\Events\Quotes\QuoteUpdated;
use App\Events\Quotes\QuoteDeleted;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class QuotesObserver
{
    public function created(Quotes $quotes): void
    {
        // Log untuk debugging
        Log::info('Quote created: ' . $quotes->id);

        // Dispatch event
        event(new QuoteCreated($quotes));

        Notification::make()
            ->title('Quote berhasil dibuat')
            ->success()
            ->send();
    }

    public function updated(Quotes $quotes): void
    {
        Log::info('Quote updated: ' . $quotes->id);

        event(new QuoteUpdated($quotes));

        Notification::make()
            ->title('Quote berhasil diupdate')
            ->success()
            ->send();
    }

    public function deleted(Quotes $quotes): void
    {
        Log::info('Quote deleted: ' . $quotes->id);

        event(new QuoteDeleted($quotes));

        Notification::make()
            ->title('Quote berhasil dihapus')
            ->success()
            ->send();
    }
}
