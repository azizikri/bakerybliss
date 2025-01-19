<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends Model
{

    public const STATUS = [
        'to_be_confirmed' => 'To Be Confirmed',
        'payment_verified' => 'Payment Verified',
        'picking' => 'Picking',
        'delivery' => 'Delivery',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled'
    ];

    protected $fillable = [
        'user_id',
        'address_id',
        'transaction_id',
        'bank_id',
        'account_number',
        'payment_proof',
        'status',
        'subtotal',
        'shipping',
        'total',
        'notes'
    ];

    protected $guarded = ['id'];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => self::STATUS[$value] ?? "Unknown",
            set: fn (string $value) => array_search($value, self::STATUS)
        );
    }

}
