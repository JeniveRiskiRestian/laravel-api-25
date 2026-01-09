<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductVariant;

class SampleDataSeeder extends Seeder
{
    public function run()
    {
        // 1. Create Categories
        $electronics = ProductCategory::create(['name' => 'Electronics', 'description' => 'Gadgets and devices']);
        $clothing = ProductCategory::create(['name' => 'Clothing', 'description' => 'Apparel and fashion']);
        $food = ProductCategory::create(['name' => 'Food', 'description' => 'Edible items']);

        // 2. Create Products
        $laptop = Product::create([
            'product_category_id' => $electronics->id,
            'name' => 'MacBook Pro',
            'code' => 'MBP-2025',
            'price' => 25000000,
            'description' => 'High-performance laptop'
        ]);

        $tshirt = Product::create([
            'product_category_id' => $clothing->id,
            'name' => 'Supreme T-Shirt',
            'code' => 'SUP-TEE',
            'price' => 500000,
            'description' => 'Limited edition T-shirt'
        ]);

        // 3. Create Variants
        ProductVariant::create([
            'product_id' => $laptop->id,
            'product_category_id' => $electronics->id,
            'name' => '16GB RAM / 512GB SSD',
            'price' => 25000000
        ]);

        ProductVariant::create([
            'product_id' => $laptop->id,
            'product_category_id' => $electronics->id,
            'name' => '32GB RAM / 1TB SSD',
            'price' => 32000000
        ]);

        ProductVariant::create([
            'product_id' => $tshirt->id,
            'product_category_id' => $clothing->id,
            'name' => 'Size M - Black',
            'price' => 500000
        ]);

        ProductVariant::create([
            'product_id' => $tshirt->id,
            'product_category_id' => $clothing->id,
            'name' => 'Size L - White',
            'price' => 500000
        ]);
    }
}
