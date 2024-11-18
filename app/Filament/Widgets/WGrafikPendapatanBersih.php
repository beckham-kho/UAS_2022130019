<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Faktur;
use App\Models\DetailFakturKuota;
use App\Models\DetailFakturAccessories;

class WGrafikPendapatanBersih extends ChartWidget
{
    protected static ?string $heading = 'Grafik Omset';
    protected static string $color = 'secondary';

    protected function getData(): array
    {
        //pakai Trend
        //install composer require flowframe/laravel-trend

        $dataOmset = Trend::model(Faktur::class)
            ->between(
                start: now()->startOfMonth(),
                end: now(),
            )
            ->perDay()
            ->sum('total_harga');

        $nominalModalKuota = Trend::model(DetailFakturKuota::class)
        ->between(
            start: now()->startOfMonth(),
            end: now(),
        )
        ->perDay()
        ->sum('subtotal_modal');

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
