<?php

namespace App\Providers\Filament;

use App\Models\Setting;
use App\Models\Team;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\MenuItem;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Pages\DisplayButton;
use App\Filament\Resources\AgendaResource;
use App\Filament\Resources\BannerResource;
use App\Filament\Resources\InformasiResource;
use App\Filament\Resources\QuotesResource;
use App\Filament\Resources\RunningTextResource;
use App\Filament\Resources\SettingResource;
use App\Filament\Resources\TeamResource;
use App\Filament\Resources\UserResource;
use App\Filament\Resources\VideoResource;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->spa()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Display Informasi')
            ->colors([
                'primary' => Color::Blue,
                'secondary' => Color::Slate,
                'danger' => Color::Rose,
                'warning' => Color::Orange,
                'success' => Color::Emerald,
                'info' => Color::Cyan,
            ])
            ->navigationGroups([
                'Konten',
                'Pengaturan'
            ])
            ->resources([
                AgendaResource::class,
                BannerResource::class,
                InformasiResource::class,
                QuotesResource::class,
                RunningTextResource::class,
                VideoResource::class,
                SettingResource::class,
                TeamResource::class,
                UserResource::class,
            ])
            ->pages([
                Pages\Dashboard::class,
                DisplayButton::class,
            ])
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->tenant(
                Team::class,
                slugAttribute: 'slug',
                ownershipRelationship: 'team',
            )
            ->tenantRoutePrefix('instansi')
            ->tenantMenuItems([
                MenuItem::make()
                    ->label('Settings')
                    ->icon('heroicon-o-cog-6-tooth')
                    ->url(fn() => TeamResource::getUrl('edit', ['record' => auth()->user()?->currentTeam]))
                    ->visible(fn() => auth()->user()?->currentTeam !== null),
            ]);
    }
}