<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'description', 'product_category_id'];

    public function categories()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function variants()
    {
        return $this->hashMany(ProductVariant::class, 'product_id');
    }

}
