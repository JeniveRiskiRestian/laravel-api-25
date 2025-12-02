<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
        protected $fillable = ['name', 'description'];

        public function products() {
        return $this->hasMany(Product::class, 'product_category_id');
        }

        public function variants() {
                return $this->hasMany(ProductVariant::class, 'product_category_id');
        }
        }