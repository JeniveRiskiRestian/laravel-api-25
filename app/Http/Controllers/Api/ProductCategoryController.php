<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productCategories = ProductCategory::all();
        return response()->json($productCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
        ]);

        $product = ProductCategory::create($validatedData);
        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($productCategory);
    }

    /**
     * Show the form for editing the specified resource.
     * (Biasanya tidak digunakan di API, tapi tetap kita buat untuk kelengkapan)
     */
    public function edit(string $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json($productCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|required|max:255',
            'description' => 'sometimes|required',
        ]);

        $productCategory->update($validatedData);

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => $productCategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productCategory = ProductCategory::find($id);

        if (!$productCategory) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $productCategory->delete();

        return response()->json(['message' => 'Category deleted successfully']);
    }
}
