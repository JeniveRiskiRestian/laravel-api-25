<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index()
    {
        $productVariants = ProductVariant::with('product')->get();
        return response()->json($productVariants);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);

        $productVariant = ProductVariant::create($validatedData);
        $productVariant->load(relations: 'product');

        return response()->json($productVariant);
    }

    public function show(string $id)
    {
        $productVariant = ProductVariant::with('product')->find($id);

        if (!$productVariant) {
            return response()->json(['message' => 'Product variant not found'], 404);
        }

        return response()->json($productVariant);
    }

    public function update(Request $request, string $id)
    {
        $productVariant = ProductVariant::find($id);

        if (!$productVariant) {
            return response()->json(['message' => 'Product variant not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'price' => 'sometimes|required|numeric',
        ]);

        $productVariant->update($validatedData);

        return response()->json([
            'message' => 'Product variant updated successfully',
            'data' => ProductVariant::with('product')->find($id)
        ], 200);
    }

    public function destroy(string $id)
    {
        $productVariant = ProductVariant::find($id);

        if (!$productVariant) {
            return response()->json(['message' => 'Product variant not found'], 404);
        }

        $productVariant->delete();

        return response()->json(['message' => 'Product variant deleted successfully']);
    }
}
