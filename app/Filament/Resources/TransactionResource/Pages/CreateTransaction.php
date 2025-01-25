<?php

namespace App\Filament\Resources\TransactionResource\Pages;

use Filament\Actions;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\TransactionResource;

class CreateTransaction extends CreateRecord
{
    protected static string $resource = TransactionResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        DB::beginTransaction();

        try {
            $order = static::getModel()::create($data);

            $products = collect($this->data['products'] ?? [])->map(function ($item) {
                return [
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                ];
            });

            foreach ($products as $orderProduct) {
                $product = Product::find($orderProduct['product_id']);

                if (! $product || $product->stock < $orderProduct['quantity']) {
                    throw new \Exception("Not enough stock available for product {$product->name}");
                }

                $product->update([
                    'stock' => $product->stock - $orderProduct['quantity']
                ]);
            }

            DB::commit();
            return $order;

        } catch (\Exception $e) {
            DB::rollBack();
            Notification::make()
                ->title('Error')
                ->body($e->getMessage())
                ->danger()
                ->send();

            throw $e;
        }
    }


    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     dd($data);
    //     return $data;
    // }

}
