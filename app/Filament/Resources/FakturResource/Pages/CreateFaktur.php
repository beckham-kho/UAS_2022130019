<?php

namespace App\Filament\Resources\FakturResource\Pages;

use App\Filament\Resources\FakturResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFaktur extends CreateRecord
{
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected static string $resource = FakturResource::class;
}
