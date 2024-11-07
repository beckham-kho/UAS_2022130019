<?php

namespace App\Filament\Resources\KuotaResource\Pages;

use App\Filament\Resources\KuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateKuota extends CreateRecord
{
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected static string $resource = KuotaResource::class;
}
