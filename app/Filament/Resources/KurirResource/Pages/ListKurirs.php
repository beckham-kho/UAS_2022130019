<?php

namespace App\Filament\Resources\KurirResource\Pages;

use App\Filament\Resources\KurirResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKurirs extends ListRecords
{
    protected static string $resource = KurirResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
