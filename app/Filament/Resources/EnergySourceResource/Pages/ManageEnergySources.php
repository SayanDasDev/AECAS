<?php

namespace App\Filament\Resources\EnergySourceResource\Pages;

use App\Filament\Resources\EnergySourceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageEnergySources extends ManageRecords
{
    protected static string $resource = EnergySourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
