<?php

namespace App\Filament\Resources\AccessoriesResource\Pages;

use App\Filament\Resources\AccessoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateAccessories extends CreateRecord
{
    protected static string $resource = AccessoriesResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
}
