<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuotesResource\Pages;
use App\Filament\Resources\QuotesResource\RelationManagers;
use App\Models\Quotes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Events\Quotes\QuotesCreated;
use Livewire\Livewire;

class QuotesResource extends Resource
{
    protected static ?string $model = Quotes::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?int $navigationSort = 4;
    protected static ?string $tenantOwnershipRelationshipName = 'team';
    protected static ?string $navigationGroup = 'Konten';

    public static function shouldRegisterNavigation(): bool
    {
        // Tampilkan untuk semua user yang memiliki team
        return auth()->check() && (auth()->user()->is_admin || auth()->user()->current_team_id !== null);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        // Jika bukan admin, filter berdasarkan team
        if (!auth()->user()->is_admin) {
            return $query->whereBelongsTo(auth()->user()->currentTeam);
        }

        return $query;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('quote')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('quote'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuotes::route('/'),
            'create' => Pages\CreateQuotes::route('/create'),
            'edit' => Pages\EditQuotes::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger'; // Warna merah
    }

    public static function afterSave(): void
    {
        Livewire::dispatch('refresh-quotes');
    }

    public static function afterDelete(): void
    {
        Livewire::dispatch('refresh-quotes');
    }
}