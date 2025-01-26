<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaction extends Model
{

    public const STATUS = [
        'to_be_confirmed' => 'To Be Confirmed',
        'payment_verified' => 'Payment Verified',
        'reupload_payment' => 'Reupload Payment',
        'picking' => 'Picking',
        'ready' => 'Ready',
        'on_delivery' => 'On Delivery',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled'
    ];

    public const DELIVERY_METHODS = [
        'go_send' => 'Go Send',
        'pickup' => 'Pickup',
    ];

    protected $fillable = [
        'user_id',
        'address_id',
        'transaction_id',
        'account_id',
        'payment_proof',
        'status',
        'subtotal',
        'shipping',
        'total',
        'notes',
        'delivery_method',
    ];

    protected $guarded = ['id'];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => self::STATUS[$value] ?? "Unknown",
            set: fn (string $value) => array_key_exists($value, self::STATUS) ? $value : array_keys(self::STATUS)[0]
        );
    }

    protected function deliveryMethod(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => self::DELIVERY_METHODS[$value] ?? "Unknown",
            set: fn (?string $value) => array_key_exists($value, self::DELIVERY_METHODS) ? $value : array_keys(self::DELIVERY_METHODS)[0]
        );
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_transaction')
    //         ->withPivot(['quantity', 'price_on_purchase', 'sub_total'])
    //         ->withTimestamps();
    // }

    public function products()
    {
        return $this->hasMany(ProductTransaction::class);
    }

    public static function generateTransactionId(): string
    {
        $prefix = 'TRX';
        $date = now()->format('Ymd');
        $random = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
        return $prefix.$date.$random;
    }
}
