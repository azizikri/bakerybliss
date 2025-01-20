<?php

namespace App\Filament\Widgets;

use App\Models\User;
use App\Models\Transaction;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Users', User::where('role', User::ROLE_USER)->count())
                ->icon('heroicon-o-users'),

            Stat::make('Total Transactions', Transaction::count())
                ->icon('heroicon-o-shopping-cart'),

            Stat::make('Monthly Sales', function () {
                return Transaction::whereMonth('created_at', now()->month)
                    ->sum('total_amount');
            })->icon('heroicon-o-currency-dollar'),

            Stat::make('Cancelled Transactions', function () {
                return Transaction::whereMonth('created_at', now()->month)
                    ->where('status', 'cancelled')
                    ->sum('total_amount');
            })->icon('heroicon-o-x-circle'),
        ];
    }
}
