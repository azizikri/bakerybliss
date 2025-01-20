<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class BestProducts extends BaseWidget
{
    protected function getTableQuery(): Builder
    {
        return Product::withCount('transactions')
            ->orderByDesc('transactions_count')
            ->limit(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('name')
                ->label('Product Name'),
            Tables\Columns\TextColumn::make('transactions_count')
                ->label('Times Ordered'),
            Tables\Columns\TextColumn::make('price')
                ->label('Price')
                ->money('idr'),
        ];
    }
}
