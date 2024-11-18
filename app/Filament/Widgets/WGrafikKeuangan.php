<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\CatatanKeuangan;
class WGrafikKeuangan extends ChartWidget
{
    protected static ?string $heading = 'Grafik Arus Kas';
    protected static string $color = 'secondary';

    protected function getData(): array
    {
        $tambahahanDana = Trend::query(CatatanKeuangan::where('kategori', 'Tambahan Dana'))
        ->between(
            start: now()->startOfMonth(),
            end: now(),
        )
        ->perDay()
        ->sum('nominal');

        $pemasukan = Trend::query(CatatanKeuangan::where('kategori', 'Pemasukan'))
        ->between(
            start: now()->startOfMonth(),
            end: now(),
        )
        ->perDay()
        ->sum('nominal');

        $pengeluaran = Trend::query(CatatanKeuangan::where('kategori', 'Pengeluaran'))
        ->between(
            start: now()->startOfMonth(),
            end: now(),
        )
        ->perDay()
        ->sum('nominal');

        return [
            'datasets' => [
                [
                    'label' => 'Tambahan Dana',
                    'data' => $tambahahanDana->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#5CB85C',
                    'borderColor' => '#5CB85C',
                ],
                [
                    'label' => 'Pemasukan',
                    'data' => $pemasukan->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#0275D8',
                    'borderColor' => '#0275D8',
                ],
                [
                    'label' => 'Pengeluaran',
                    'data' => $pengeluaran->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#D9534F',
                    'borderColor' => '#D9534F',
                ],
            ],
            'labels' => $tambahahanDana->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
