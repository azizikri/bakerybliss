<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\Transaction;
use Filament\Widgets\ChartWidget;

class SalesChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Sales Trend';
    protected int|string|array $columnSpan = 'full';

    protected function getData(): array
    {
        // Get data for the last 12 months
        $data = Transaction::selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->whereDate('created_at', '>=', now()->subMonths(12))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->groupBy(function ($item) {
                return Carbon::parse($item->date)->format('Y-m');
            })
            ->map(function ($items) {
                return $items->sum('total');
            });

        // Ensure we have all months (even with zero values)
        $months = collect([]);
        for ($i = 11; $i >= 0; $i--) {
            $yearMonth = now()->subMonths($i)->format('Y-m');
            $months->put($yearMonth, $data[$yearMonth] ?? 0);
        }

        return [
            'datasets' => [
                [
                    'label' => 'Sales',
                    'data' => $months->values()->toArray(),
                    'borderColor' => '#4F46E5',
                    'backgroundColor' => 'rgba(79, 70, 229, 0.1)',
                    'fill' => true,
                ],
            ],
            'labels' => $months->keys()->map(function ($month) {
                return Carbon::createFromFormat('Y-m', $month)->format('F Y');
            })->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => "function(value) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }",
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => "function(context) {
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(context.raw);
                        }",
                    ],
                ],
            ],
        ];
    }
}
