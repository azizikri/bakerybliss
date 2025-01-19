<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Product extends Model
{
    protected $fillable = [
        'name',
        'stock',
        'images',
        'description',
        'price',
        'status'
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

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeInactive($query)
    {
        return $query->where('status', 0);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
