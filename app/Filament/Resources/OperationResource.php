<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages;
use App\Filament\Resources\OperationResource\RelationManagers;
use App\Models\EnergySource;
use App\Models\Operation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OperationResource extends Resource
{
    protected static ?string $model = Operation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('particular.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('energySource.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('land_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('weight')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('time_of_operation')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('frequency')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('lifespan')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('MU_count')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fuel_consumption_rate')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('energy')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ManageOperations::route('/'),
        ];
    }
}
