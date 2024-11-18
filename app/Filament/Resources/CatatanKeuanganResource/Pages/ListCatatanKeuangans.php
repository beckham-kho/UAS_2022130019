<?php

namespace App\Filament\Resources\CatatanKeuanganResource\Pages;

use App\Filament\Resources\CatatanKeuanganResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\StatistikKeuangan;
use App\Filament\Widgets\WGrafikKeuangan;

class ListCatatanKeuangans extends ListRecords
{
    protected static string $resource = CatatanKeuanganResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getHeaderWidgets(): array
    {
        return [
            StatistikKeuangan::class,
            WGrafikKeuangan::class,
        ];
    }
}
