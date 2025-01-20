<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\TransactionResource\Pages;

class TransactionResource extends Resource
{
    protected static ?string $model = Transaction::class;
    protected static ?string $navigationGroup = 'Transaction Management';
    protected static ?int $navigationSort = 1;
    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship(
                        'user',
                        'name',
                        modifyQueryUsing: fn (Builder $query) => $query->where('role', User::ROLE_USER)
                    )
                    ->required()
                    ->preload()
                    ->searchable()
                    ->live()
                    ->afterStateUpdated(fn (Forms\Set $set) => $set('address_id', null) && $set('account_id', null)),

                Forms\Components\Select::make('address_id')
                    ->relationship(
                        'address',
                        'address',
                        modifyQueryUsing: fn (Builder $query, Forms\Get $get) =>
                        $query->where('user_id', $get('user_id'))
                    )
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\Select::make('account_id')
                    ->options(function (Forms\Get $get) {
                        $userId = $get('user_id');
                        if (! $userId)
                            return [];

                        return \App\Models\Account::where('user_id', $userId)
                            ->pluck('account_number', 'id');
                    })
                    ->required()
                    ->preload()
                    ->searchable(),

                Forms\Components\TextInput::make('transaction_id')
                    ->required()
                    ->unique(ignoreRecord: true),

                Forms\Components\Select::make('status')
                    ->options(array_combine(array_keys(Transaction::STATUS), Transaction::STATUS))
                    ->default('to_be_confirmed')
                    ->required()
                    ->afterStateHydrated(function ($state) {
                        return (string) $state;
                    }),

                Forms\Components\TextInput::make('shipping')
                    ->numeric()
                    ->required()
                    ->default(20000),

                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull(),

                Forms\Components\FileUpload::make('payment_proof')
                    ->image()
                    ->columnSpanFull()
                    ->required(),

                Forms\Components\Repeater::make('products')
                    ->relationship()
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->relationship('product', 'name')
                            ->required()
                            ->preload()
                            ->searchable()
                            ->live()
                            ->columnSpan(3)
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $product = Product::find($state);
                                if ($product) {
                                    $set('price_on_purchase', $product->price);
                                    $quantity = $get('quantity') ?? 1;
                                    $set('sub_total', $product->price * $quantity);
                                    static::updateTotals($set, $get);
                                }
                            }),
                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->live()
                            ->columnSpan(3)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                $price = $get('price_on_purchase');
                                $set('sub_total', $price * $state);
                                static::updateTotals($set, $get);
                            }),
                        Forms\Components\TextInput::make('price_on_purchase')
                            ->numeric()
                            ->required()
                            ->live()
                            ->columnSpan(3)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                $quantity = $get('quantity');
                                $set('sub_total', $state * $quantity);
                                static::updateTotals($set, $get);
                            }),
                        Forms\Components\TextInput::make('sub_total')
                            ->numeric()
                            ->required()
                            ->disabled()
                            ->dehydrated(true)
                            ->columnSpan(3),
                    ])
                    ->columns(12)
                    ->columnSpanFull()
                    ->live()
                    ->grid(1),

                Forms\Components\TextInput::make('subtotal')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated(true),

                Forms\Components\TextInput::make('total')
                    ->numeric()
                    ->required()
                    ->disabled()
                    ->dehydrated(true),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('transaction_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->money('IDR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options(Transaction::STATUS),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTransactions::route('/'),
            'create' => Pages\CreateTransaction::route('/create'),
            'edit' => Pages\EditTransaction::route('/{record}/edit'),
        ];
    }

    protected static function updateTotals(Forms\Set $set, Forms\Get $get): void
    {
        $products = $get('../../products');

        $shipping = $get('../../shipping') ?? 20000;

        $subtotal = collect($products)->sum('sub_total');
        $total = $subtotal + $shipping;

        $set('../../subtotal', $subtotal);
        $set('../../total', $total);
    }


}
