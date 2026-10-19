<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => Category::with('products')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function show(Category $category): JsonResponse
    {
        return response()->json([
            'data' => $category->load('products'),
        ]);
    }
}
