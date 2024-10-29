<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages;
use App\Filament\Resources\OperationResource\RelationManagers;
use App\Models\Operation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OperationResource extends Resource
{
    protected static ?string $model = Operation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('particular_id')
                    ->relationship('particular', 'name')
                    ->native(false)
                    ->required(),
                Forms\Components\Select::make('energy_source_id')
                    ->relationship('energySource', 'name')
                    ->native(false)
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('land_amount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('weight')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('time_of_operation')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('frequency')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('lifespan')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('MU_count')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fuel_consumption_rate')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('energy')
                    ->required()
                    ->numeric(),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
