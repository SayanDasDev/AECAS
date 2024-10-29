<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnergySourceResource\Pages;
use App\Filament\Resources\EnergySourceResource\RelationManagers;
use App\Models\EnergySource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EnergySourceResource extends Resource
{
    protected static ?string $model = EnergySource::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Energy Source')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('particular_id')
                    ->relationship('particular', 'name')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('unit')
                    ->required()
                    ->live()
                    ->maxLength(255),
                Forms\Components\TextInput::make('energy_equivalent')
                    ->suffix(fn (Get $get): string => ' MJ/' . ($get('unit') ?? 'unit'))
                    ->required()
                    ->numeric()
                    ->numeric(),
                Forms\Components\TextInput::make('reference')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('citation')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('particular.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Energy Source')
                    ->searchable(),
                Tables\Columns\TextColumn::make('energy_equivalent')
                    ->suffix(fn (EnergySource $record): string => ' MJ/' . $record->unit)
                    ->numeric(decimalPlaces: 2)
                    ->sortable(),
                Tables\Columns\TextColumn::make('reference')
                    ->searchable(),
                Tables\Columns\TextColumn::make('citation')
                    ->wrap()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageEnergySources::route('/'),
        ];
    }
}
