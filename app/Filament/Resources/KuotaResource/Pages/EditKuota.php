<?php

namespace App\Filament\Resources\KuotaResource\Pages;

use App\Filament\Resources\KuotaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKuota extends EditRecord
{
    protected static string $resource = KuotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
