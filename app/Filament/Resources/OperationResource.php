<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OperationResource\Pages;
use App\Filament\Resources\OperationResource\RelationManagers;
use App\Forms\Components\EnergyValue;
use App\Http\Helper;
use App\Models\EnergySource;
use App\Models\Operation;
use Filament\Forms;
use Filament\Forms\Components\Wizard\Step;
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
            ->schema([]);
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
                Tables\Actions\EditAction::make()
                    ->steps([
                        Step::make('Details')
                            ->description('Give the required energy input')
                            ->schema([
                                Forms\Components\Select::make('particular_id')
                                    ->relationship('particular', 'name')
                                    ->native(false)
                                    ->preload()
                                    ->live()
                                    ->afterStateUpdated(fn(Set $set) => $set('energy_source_id', null))
                                    ->searchable()
                                    ->required(),
                                Forms\Components\Select::make('energy_source_id')
                                    ->options(
                                        fn(Get $get) => EnergySource::query()
                                            ->where('particular_id', $get('particular_id'))
                                            ->pluck('name', 'id')
                                    )
                                    ->label('Energy Source')
                                    ->searchable()
                                    ->native(false)
                                    ->required(),
                                Forms\Components\TextInput::make('land_amount')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('weight')
                                    ->suffix('kg')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('time_of_operation')
                                    ->suffix('hr')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('frequency')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('lifespan')
                                    ->suffix('hr')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('MU_count')
                                    ->label('MU Count')
                                    ->required()
                                    ->numeric(),
                                Forms\Components\TextInput::make('fuel_consumption_rate')
                                    ->suffix('lit/hr')
                                    ->required()
                                    ->numeric(),
                            ])
                            ->columns(2)
                            ->afterValidation(fn(Set $set, Get $get) => $set('energy', Helper::calculateEnergy(
                                $get('land_amount'),
                                $get('weight'),
                                $get('time_of_operation'),
                                $get('frequency'),
                                $get('lifespan'),
                                $get('MU_count'),
                                $get('fuel_consumption_rate')
                            ))),
                        Step::make('Result')
                            ->description('You can save the operation')
                            ->schema([
                                EnergyValue::make('energy')
                                    ->required(),
                            ]),
                    ]),
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
