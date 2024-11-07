<?php

namespace App\Filament\Resources\PelangganResource\Pages;

use App\Filament\Resources\PelangganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePelanggan extends CreateRecord
{
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected static string $resource = PelangganResource::class;
}
