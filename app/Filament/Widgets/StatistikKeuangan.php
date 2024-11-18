<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\CatatanKeuangan;

class StatistikKeuangan extends BaseWidget
{
    protected function getStats(): array
    {
        $tambahahanDana = CatatanKeuangan::where('kategori', 'Tambahan Dana')->sum('nominal');
        $pemasukan = CatatanKeuangan::where('kategori', 'Pemasukan')->sum('nominal');
        $pengeluaran = CatatanKeuangan::where('kategori', 'Pengeluaran')->sum('nominal');

        return [
            Stat::make('Total Tambahan Dana', $tambahahanDana),
            Stat::make('Pemasukan', $pemasukan),
            Stat::make('Pengeluaran', $pengeluaran),
        ];
    }
}
