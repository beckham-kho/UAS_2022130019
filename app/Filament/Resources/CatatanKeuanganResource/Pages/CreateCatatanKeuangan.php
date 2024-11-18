<?php

namespace App\Filament\Resources\CatatanKeuanganResource\Pages;

use App\Filament\Resources\CatatanKeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCatatanKeuangan extends CreateRecord
{
    protected function getRedirectUrl(): string {
        return $this->getResource()::getUrl('index');
    }
    
    protected static string $resource = CatatanKeuanganResource::class;
}
