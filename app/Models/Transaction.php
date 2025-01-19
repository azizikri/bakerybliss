<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function status()
    {
        return self::STATUS[$this->status] ?? "Unknown";
    }

}
