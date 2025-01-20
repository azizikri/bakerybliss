<?php

namespace App\Filament\Widgets;

use App\Models\Transaction;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class RecentTransactions extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Transaction::query()->latest()->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('transaction_id')
                ->label('Transaction ID'),
            Tables\Columns\TextColumn::make('user.name')
                ->label('Customer')
                ->sortable(),
            Tables\Columns\TextColumn::make('total')
                ->label('Total Amount')
                ->money('idr')
                ->sortable(),
            Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'completed',
                    'danger' => 'cancelled',
                    'warning' => 'pending',
                ]),
        ];
    }
}
