<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'code', 'description', 'product_category_id'];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id');
    }
    public function productvariant()
    {
        return $this->belongsTo(ProductVariant::class, 'product_id');
    }

}
