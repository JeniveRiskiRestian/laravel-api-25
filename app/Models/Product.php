<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'price', 'description', 'product_category_id'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

}
