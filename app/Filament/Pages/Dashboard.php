<?php

use App\Filament\Widgets\SalesChart;
use App\Filament\Widgets\BestProducts;
use App\Filament\Widgets\StatsOverview;
use App\Filament\Widgets\RecentTransactions;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class,
            SalesChart::class,
            RecentTransactions::class,
            BestProducts::class,
        ];
    }
}
