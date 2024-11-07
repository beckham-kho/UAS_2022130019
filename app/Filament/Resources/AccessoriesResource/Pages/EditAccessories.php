<?php

namespace App\Filament\Resources\AccessoriesResource\Pages;

use App\Filament\Resources\AccessoriesResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAccessories extends EditRecord
{
    protected static string $resource = AccessoriesResource::class;

    protected function getRedirectUrl(): ?string {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
