<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\CatatanKeuangan;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Carbon\Carbon;
class WGrafikKeuangan extends ChartWidget
{
    use InteractsWithPageFilters;
    protected static ?string $heading = 'Grafik Arus Kas';
    protected static string $color = 'secondary';

    protected function getData(): array
    {
        //pakai Trend
        //install composer require flowframe/laravel-trend

        $startDate = $this->filters['tanggalAwal'] ?? null;
        $endDate = $this->filters['tanggalAkhir'] ?? null;

        $tambahahanDana = Trend::query(CatatanKeuangan::where('kategori', 'Tambahan Dana'))
        ->between(
            start: $startDate ? Carbon:: parse($startDate) : now()->startOfMonth(),
            end: $startDate ? Carbon:: parse($endDate) : now(),
        )
        ->perDay()
        ->sum('nominal');

        $pemasukan = Trend::query(CatatanKeuangan::where('kategori', 'Pemasukan'))
        ->between(
            start: $startDate ? Carbon:: parse($startDate) : now()->startOfMonth(),
            end: $startDate ? Carbon:: parse($endDate) : now(),
        )
        ->perDay()
        ->sum('nominal');

        $pengeluaran = Trend::query(CatatanKeuangan::where('kategori', 'Pengeluaran'))
        ->between(
            start: $startDate ? Carbon:: parse($startDate) : now()->startOfMonth(),
            end: $startDate ? Carbon:: parse($endDate) : now(),
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
