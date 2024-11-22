<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\CatatanKeuangan;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;

class StatistikKeuangan extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = $this->filters['tanggalAwal'] ?? null;
        $endDate = $this->filters['tanggalAkhir'] ?? null;

        $tambahahanDana = CatatanKeuangan::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where('kategori', 'Tambahan Dana')
            ->sum('nominal');
        $pemasukan = CatatanKeuangan::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where('kategori', 'Pemasukan')
            ->sum('nominal');
        $pengeluaran = CatatanKeuangan::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->where('kategori', 'Pengeluaran')
            ->sum('nominal');

        return [
            Stat::make('Total Tambahan Dana', $tambahahanDana),
            Stat::make('Pemasukan', $pemasukan),
            Stat::make('Pengeluaran', $pengeluaran),
        ];
    }
}
