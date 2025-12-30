<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Exception;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $productCategories = ProductCategory::with(['products','variants'])->get();
            return response()->json([
                'data' => $productCategories,
        ], 200);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch categories',
                'error' => $e->getMessage()
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
                'name' => 'required|max:255',
                'description' => 'required',
            ]);

            $product = ProductCategory::create($validatedData);

            return response()->json($product, 201);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to create category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $productCategory = ProductCategory::find($id);

            if (!$productCategory) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            return response()->json($productCategory);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $productCategory = ProductCategory::find($id);

            if (!$productCategory) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            return response()->json($productCategory);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to fetch category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
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

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to update category',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $productCategory = ProductCategory::find($id);

            if (!$productCategory) {
                return response()->json(['message' => 'Category not found'], 404);
            }

            $productCategory->delete();

            return response()->json(['message' => 'Category deleted successfully']);

        } catch (Exception $e) {
            return response()->json([
                'message' => 'Failed to delete category',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
