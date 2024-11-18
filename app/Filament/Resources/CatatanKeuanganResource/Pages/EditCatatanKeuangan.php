<?php

namespace App\Filament\Resources\CatatanKeuanganResource\Pages;

use App\Filament\Resources\CatatanKeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatatanKeuangan extends EditRecord
{
    protected static string $resource = CatatanKeuanganResource::class;

    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
