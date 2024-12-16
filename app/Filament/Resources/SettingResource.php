<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingResource\Pages;
use App\Filament\Resources\SettingResource\RelationManagers;
use App\Models\Setting;
use App\Models\Team;
use App\Services\LocationService;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SettingResource extends Resource
{
    protected static ?string $model = Setting::class;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationLabel = 'Identitas Aplikasi';
    protected static ?string $navigationGroup = 'Pengaturan';
    protected static ?string $tenantOwnershipRelationshipName = 'team';

    public static function form(Form $form): Form

    {

        $locationService = new LocationService();
        $locations = $locationService->getLocations();


        return $form
            ->schema([
                Forms\Components\TextInput::make('nama_aplikasi')
                    // ->hidden()
                    ->default(' Display Informasi')
                    ->maxLength(255),
                Forms\Components\Select::make('nama_institusi')
                    ->autofocus()
                    ->options(function () {
                        return Team::orderBy('name')->pluck('name', 'name');
                    })
                    ->required(),
                Forms\Components\TextInput::make('alamat')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('lokasi')
                    ->required()
                    ->options($locations)
                    ->searchable()
                    ->label('Lokasi Jadwal Sholat')
                    ->helperText('Pilih kota untuk jadwal sholat'),
                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->required()
                    ->preserveFilenames()
                    ->acceptedFileTypes(['image/png', 'image/jpeg', 'image/jpg']),
                Forms\Components\TextInput::make('kecepatan_teks')
                    ->required()
                    ->label('Kecepatan Running Teks')
                    ->helperText('1=lambat, 5=normal, 10=cepat')
                    ->numeric()
                    ->default(5),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_aplikasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nama_institusi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lokasi')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('logo')
                    ->width(30)
                    ->height(30)
                    ->label('Logo'),
                Tables\Columns\TextColumn::make('kecepatan_teks')
                    ->label('Kecepatan Running Teks')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSetting::route('/create'),
            'edit' => Pages\EditSetting::route('/{record}/edit'),
        ];
    }

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()->whereBelongsTo(auth()->user()->currentTeam);
    // }
}