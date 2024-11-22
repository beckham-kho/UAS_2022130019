<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Faktur;
use App\Models\DetailFakturKuota;
use App\Models\DetailFakturAccessories;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Carbon\Carbon;

class WGrafikPendapatanBersih extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Grafik Omset';
    protected static string $color = 'secondary';

    protected function getData(): array
    {
        //pakai Trend
        //install composer require flowframe/laravel-trend

        $startDate = $this->filters['tanggalAwal'] ?? null;
        $endDate = $this->filters['tanggalAkhir'] ?? null;

        $dataOmset = Trend::model(Faktur::class)
            ->between(
                start: $startDate ? Carbon:: parse($startDate) : now()->startOfMonth(),
                end: $startDate ? Carbon:: parse($endDate) : now(),
            )
            ->perDay()
            ->sum('total_harga');

        return [
            'datasets' => [
                [
                    'label' => 'Omset',
                    'data' => $dataOmset->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#F0AD4E',
                    'borderColor' => '#F0AD4E',
                ],
            ],
            'labels' => $dataOmset->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
