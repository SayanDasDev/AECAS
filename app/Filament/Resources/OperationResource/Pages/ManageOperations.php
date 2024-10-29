<?php

namespace App\Filament\Resources\OperationResource\Pages;

use App\Filament\Resources\OperationResource;
use App\Forms\Components\EnergyValue;
use App\Http\Helper;
use App\Models\EnergySource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Pages\ManageRecords;
use Ramsey\Uuid\Type\Decimal;

class ManageOperations extends ManageRecords
{
  protected static string $resource = OperationResource::class;

  protected function getHeaderActions(): array
  {
    return [
      Actions\CreateAction::make()
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
    ];
  }
}
