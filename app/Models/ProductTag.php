<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $table = 'product_tag';
    protected $fillable = ['name'];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function tags()
    {
        return $this->belongsTo(Tag::class);
    }
}
