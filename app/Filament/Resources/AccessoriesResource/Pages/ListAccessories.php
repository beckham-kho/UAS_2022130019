<?php

namespace App\Filament\Resources\AccessoriesResource\Pages;

use App\Filament\Resources\AccessoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAccessories extends ListRecords
{
    protected static string $resource = AccessoriesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
