<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionProduct extends Model
{
    protected $table = 'transaction_product';

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price_on_purchase',
        'sub_total',
    ];

    protected $guarded = ['id'];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
