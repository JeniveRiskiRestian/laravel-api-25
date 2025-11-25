<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Exception;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with(['ProductCategory'])->get();
            return response()->json($products);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch products',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_category_id' => 'required|exists:product_categories,id',
                'name'                => 'required|max:255',
                'code'                => 'required',
                'description'         => 'required',
            ]);

            $product = Product::create($validatedData);

            return response()->json(
                Product::with(['ProductCategory'])->find($product->id),
                201
            );

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::with(['ProductCategory'])->find($id);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            return response()->json($product);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $validatedData = $request->validate([
                'name'        => 'sometimes|required|max:255',
                'code'        => 'sometimes|required',
                'description' => 'sometimes|required',
            ]);

            $product->update($validatedData);

            return response()->json([
                'message' => 'Product updated successfully',
                'data'    => Product::with(['ProductCategory'])->find($id)
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $product = Product::find($id);

            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }

            $product->delete();

            return response()->json(['message' => 'Product deleted successfully']);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
