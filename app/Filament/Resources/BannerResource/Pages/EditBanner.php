<?php

namespace App\Filament\Resources\BannerResource\Pages;

use App\Filament\Resources\BannerResource;
use Filament\Actions;
use App\Services\DisplayUpdateService;
use Filament\Resources\Pages\EditRecord;

class EditBanner extends EditRecord
{

    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    public static function getDisplayComponent(): string
    {
        return DisplayUpdateService::getComponentName(static::class);
    }

    protected function afterSave(): void
    {
        $this->dispatch('bannersUpdated'); // Trigger the event after saving
    }
}
