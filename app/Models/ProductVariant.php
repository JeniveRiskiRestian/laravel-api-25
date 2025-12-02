<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    protected $fillable = ['name', 'price', 'product_id', 'product_category_id'];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }   

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
}
