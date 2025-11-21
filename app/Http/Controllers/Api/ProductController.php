<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // tampilkan relasi category dan variants
        $products = Product::with(['ProductCategory'])->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_category_id' => 'required|exists:product_categories,id',
            'name' => 'required|max:255',
            'code' => 'required',
            'description' => 'required',
        ]);

        $product = Product::create($validatedData);

        // return lengkap dengan relasi
        return response()->json(
            Product::with(['ProductCategory'])->find($product->id),
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // tampilkan relasi category dan variants
        $product = Product::with(['ProductCategory'])->find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'code' => 'sometimes|required',
            'description' => 'sometimes|required',
        ]);

        $product->update($validatedData);

        return response()->json([
            'message' => 'Product updated successfully',
            'data' => Product::with(['ProductCategory'])->find($id)
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
