<?php

namespace App\Filament\Resources\KurirResource\Pages;

use App\Filament\Resources\KurirResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKurir extends CreateRecord
{
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected static string $resource = KurirResource::class;
}
