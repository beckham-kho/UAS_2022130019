<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Faktur;
use App\Models\DetailFakturKuota;
use App\Models\DetailFakturAccessories;

class Statistik extends BaseWidget
{
    protected function getStats(): array
    {
        $omset = Faktur::sum('total_harga');
        $pendapatanBersih = Faktur::sum('total_harga') - DetailFakturKuota::sum('subtotal_modal') - DetailFakturAccessories::sum('subtotal_modal');
        $margin = round((($pendapatanBersih/Faktur::sum('total_harga')) * 100), precision: 2);
        return [
            Stat::make('Omset', $omset),
            Stat::make('Pendapatan Bersih', $pendapatanBersih),
            Stat::make('Margin Pendapatan Bersih', $margin.'%'),
        ];
    }
}
