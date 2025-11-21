<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productVariants = ProductVariant::all();
        return response()->json($productVariants);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
        ]);
        $productVariant = ProductVariant::create($validatedData);
        return response()->json($productVariant, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $productVariant = ProductVariant::find($id);
        if (!$productVariant) {
            return response()->json(['message' => 'Product variant not found'], 404);
        }
        return response()->json($productVariant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
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
            'data' => $productVariant
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $productVariant = ProductVariant::find($id);
        if (!$productVariant) {
            return response()->json(['message' => 'Product variant not found'], 404);
        }
        $productVariant->delete();
        return response()->json(['message' => 'Product variant deleted successfully']);
    }
}
