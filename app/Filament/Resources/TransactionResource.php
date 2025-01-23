<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Product;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Transaction;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
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
                    ->default(fn () => Transaction::generateTransactionId())
                    ->disabled()
                    ->dehydrated(true)
                    ->required()
                    ->unique(ignoreRecord: true),

                // Forms\Components\Select::make('status')
                //     ->options(array_combine(array_keys(Transaction::STATUS), Transaction::STATUS))
                //     ->default('to_be_confirmed')
                //     ->required()
                //     ->afterStateHydrated(function ($state) {
                //         return (string) $state;
                //     }),

                Forms\Components\TextInput::make('shipping')
                    ->numeric()
                    ->required()
                    ->default(20000)
                    ->live()
                    ->afterStateUpdated(fn (Forms\Set $set, Forms\Get $get) => static::updateTotals($set, $get)),

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
                            ->relationship('product', 'name', modifyQueryUsing: function (Builder $query) {
                                $query->where('status', 1)->where('stock', '!=', value: 0);
                            })
                            ->required()
                            ->preload()
                            ->searchable()
                            ->live()
                            ->columnSpan(3)
                            ->afterStateUpdated(function ($state, Forms\Set $set, Forms\Get $get) {
                                $product = Product::find($state);
                                if ($product) {
                                    $stock = $product->stock;
                                    $set('quantity', min(1, $stock));
                                    $set('price_on_purchase', $product->price);
                                    $set('sub_total', $product->price * min(1, $stock));
                                    static::updateTotals($set, $get);
                                }
                            })
                            ->rules(['distinct']),

                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->required()
                            ->minValue(1)
                            ->live()
                            ->columnSpan(3)
                            ->afterStateUpdated(function ($state, Forms\Get $get, Forms\Set $set) {
                                $productId = $get('product_id');
                                $product = Product::find($productId);
                                if ($product) {
                                    $stock = $product->stock;
                                    if ($state > $stock) {
                                        $set('quantity', $stock);
                                    }
                                    $price = $get('price_on_purchase');
                                    $set('sub_total', $price * $get('quantity'));
                                    static::updateTotals($set, $get);
                                }
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
                Tables\Columns\TextColumn::make('products.product.name')
                    ->listWithLineBreaks()
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
                Tables\Columns\ImageColumn::make('payment_proof')
                    ->circular()
                    ->height(40)
                    ->action(
                        Tables\Actions\Action::make('view_payment_proof')
                            ->modalContent(fn ($record) => view(
                                'filament.pages.actions.view-image',
                                ['imageUrl' => Storage::url($record->payment_proof)]
                            ))
                            ->modalWidth('xl')
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                    ),
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
                Tables\Actions\Action::make('change_status')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->options(Transaction::STATUS)
                            ->required()
                    ])
                    ->requiresConfirmation()
                    ->action(function (Transaction $record, array $data): void {
                        $record->update(['status' => $data['status']]);
                    })
                    ->label(fn ($record) => $record->status),
                Tables\Actions\Action::make('set_delivery')
                    ->form([
                        Forms\Components\Select::make('delivery_method')
                            ->options(Transaction::DELIVERY_METHODS)
                            ->required()
                    ])
                    ->requiresConfirmation()
                    ->action(function (Transaction $record, array $data): void {
                        $record->update(['delivery_method' => $data['delivery_method']]);
                    })
                    ->label(fn ($record) => $record->delivery_method)
                    ->visible(fn ($record) => $record->status === 'Ready'),
                Tables\Actions\Action::make('generate_invoice')
                    ->action(function (Transaction $record) {
                        $pdf = Pdf::loadView('invoices.template', [
                            'transaction' => $record
                        ])
                            ->setOption('enable-local-file-access', true)
                            ->setOption('user-style-sheet', public_path('css/app.css'));

                        return response()->streamDownload(function () use ($pdf) {
                            echo $pdf->output();
                        }, "Invoice-{$record->transaction_id}.pdf");
                    })
                    ->visible(fn ($record) => $record->status != 'To Be Confirmed'),
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
