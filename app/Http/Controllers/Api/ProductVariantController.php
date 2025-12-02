<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Exception;

class ProductVariantController extends Controller
{
    public function index()
    {
        try {
            $productVariants = ProductVariant::with(['categories','products'])->get();
            return response()->json($productVariants);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch product variants',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'product_category_id' => 'required|exists:product_categories,id',
                'product_id' => 'required|exists:products,id',
                'name'       => 'required|max:255',
                'price'      => 'required|numeric',
            ]);

            $productVariant = ProductVariant::create($validatedData);
            $productVariant->load('product');

            return response()->json($productVariant, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create product variant',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $productVariant = ProductVariant::with('product')->find($id);

            if (!$productVariant) {
                return response()->json(['message' => 'Product variant not found'], 404);
            }

            return response()->json($productVariant);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch product variant',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $productVariant = ProductVariant::find($id);

            if (!$productVariant) {
                return response()->json(['message' => 'Product variant not found'], 404);
            }

            $validatedData = $request->validate([
                'name'  => 'sometimes|required|max:255',
                'price' => 'sometimes|required|numeric',
            ]);

            $productVariant->update($validatedData);

            return response()->json([
                'message' => 'Product variant updated successfully',
                'data'    => ProductVariant::with('product')->find($id)
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update product variant',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $productVariant = ProductVariant::find($id);

            if (!$productVariant) {
                return response()->json(['message' => 'Product variant not found'], 404);
            }

            $productVariant->delete();

            return response()->json(['message' => 'Product variant deleted successfully']);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete product variant',
                'error'   => $e->getMessage()
            ], 500);
        }
    }
}
