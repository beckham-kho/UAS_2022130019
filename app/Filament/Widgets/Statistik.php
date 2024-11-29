<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Faktur;
use App\Models\DetailFakturKuota;
use App\Models\DetailFakturAccessories;
use Carbon\CarbonImmutable;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Illuminate\Database\Eloquent\Builder;

class Statistik extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = $this->filters['tanggalAwal'] ?? null;
        $endDate = $this->filters['tanggalAkhir'] ?? null;

        $omset = Faktur::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->sum('total_harga');

        $subtotalModalKuota = DetailFakturKuota::query()
            ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
            ->sum('subtotal_modal');

        $subtotalModalAccessories = DetailFakturAccessories::query()
        ->when($startDate, fn (Builder $query) => $query->whereDate('created_at', '>=', $startDate))
        ->when($endDate, fn (Builder $query) => $query->whereDate('created_at', '<=', $endDate))
        ->sum('subtotal_modal');

        $pendapatanBersih = $omset - $subtotalModalKuota - $subtotalModalAccessories;

        function checkDivisionZero(int $pendapatanBersih, int $omset) {
            if ($omset == 0 || $pendapatanBersih == 0) {
                return 0;
            } else {
                return round((($pendapatanBersih/$omset) * 100), precision: 2);
            };
        }

        $margin = checkDivisionZero($pendapatanBersih, $omset);

        return [
            Stat::make('Omset', 'Rp '.number_format($omset, 0, ',', '.')),
            Stat::make('Pendapatan Bersih', 'Rp '.number_format($pendapatanBersih, 0, ',', '.')),
            Stat::make('Margin Pendapatan Bersih', $margin.'%'),
        ];
    }
}
