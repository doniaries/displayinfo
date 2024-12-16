<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Navigation\NavigationItem;

class DisplayButton extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-line';

    protected static ?string $navigationLabel = 'Lihat Display';

    protected static ?string $title = 'Display';

    protected static ?string $slug = 'display-view';

    protected static ?int $navigationSort = -1; // Akan muncul di paling atas

    public static function getNavigationItems(): array
    {
        return [
            NavigationItem::make(static::getNavigationLabel())
                ->url(route('display'), shouldOpenInNewTab: true)
                ->icon(static::$navigationIcon)
                ->sort(static::$navigationSort),
        ];
    }

    public function mount(): void
    {
        redirect()->route('display');
    }
}