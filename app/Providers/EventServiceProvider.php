<?php

namespace App\Providers;

use App\Models\Video;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Quotes;
use App\Models\Setting;
use App\Models\Informasi;
use App\Models\RunningText;
use App\Observers\VideoObserver;
use App\Observers\AgendaObserver;
use App\Observers\BannerObserver;
use App\Observers\QuotesObserver;
use App\Observers\SettingObserver;
use App\Observers\InformasiObserver;
use App\Observers\RunningTextObserver;
use Illuminate\Auth\Events\Registered;
use App\Listeners\Quotes\RefreshDisplayQuotes;
use App\Events\Quotes\QuoteCreated;
use App\Events\Quotes\QuoteUpdated;
use App\Events\Quotes\QuoteDeleted;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        QuoteCreated::class => [
            RefreshDisplayQuotes::class,
        ],
        QuoteUpdated::class => [
            RefreshDisplayQuotes::class,
        ],
        QuoteDeleted::class => [
            RefreshDisplayQuotes::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Register Model Observers
        Agenda::observe(AgendaObserver::class);
        Banner::observe(BannerObserver::class);
        Informasi::observe(InformasiObserver::class);
        Quotes::observe(QuotesObserver::class);
        RunningText::observe(RunningTextObserver::class);
        Setting::observe(SettingObserver::class);
        Video::observe(VideoObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
