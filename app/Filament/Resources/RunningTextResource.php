<?php

namespace App\Filament\Resources;

use App\Filament\Resources\RunningTextResource\Pages;
use App\Filament\Resources\RunningTextResource\RelationManagers;
use App\Models\RunningText;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RunningTextResource extends Resource
{
    protected static ?string $model = RunningText::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';
    protected static ?string $navigationLabel = 'Running Text';
    protected static ?string $modelLabel = 'Running Text';
    protected static ?string $pluralModelLabel = 'Running Text';
    protected static ?int $navigationSort = 5;
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
                Forms\Components\TextInput::make('text')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListRunningTexts::route('/'),
            'create' => Pages\CreateRunningText::route('/create'),
            'edit' => Pages\EditRunningText::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning'; // Warna kuning
    }
}