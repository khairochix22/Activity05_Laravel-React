<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => post::query()->latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): JsonResponse
    {
        return response()->json([
            'message' => 'Create post form',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request): JsonResponse
    {
        $createdPost = post::create($request->validated());

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $createdPost,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(post $post): JsonResponse
    {
        return response()->json([
            'data' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        //
    }
}
