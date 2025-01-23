<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    public const SIZES = [
        'small' => 'Small',
        'medium' => 'Medium',
        'large' => 'Large',
        'extra_large' => 'Extra Large',
    ];

    protected $fillable = [
        'name',
        'stock',
        'images',
        'description',
        'price',
        'status',
        'size'
    ];

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'images' => 'array'
    ];

    protected function status(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value ? 'Active' : 'Inactive',
            set: fn (string $value) => $value == 'Active' ? 1 : 0,
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => "Rp ".number_format($value, 0, ',', '.'),
            set: fn (string $value) => (int) preg_replace('/[^0-9]/', '', $value),
        );
    }

    protected function size(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => self::SIZES[$value] ?? "Unknown",
            set: fn (string $value) => array_key_exists($value, self::SIZES) ? $value : array_keys(self::SIZES)[0]
        );
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    // public function transactions()
    // {
    //     return $this->belongsToMany(Transaction::class, 'product_transaction')
    //         ->withPivot(['quantity', 'price_on_purchase', 'sub_total'])
    //         ->withTimestamps();
    // }

    public function transactions()
    {
        return $this->hasMany(ProductTransaction::class);
    }

    public function getThumbnailAttribute()
    {
        return $this->images[0];
    }
}
