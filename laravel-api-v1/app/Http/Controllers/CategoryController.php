<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * GET /api/categories
     * Return list kategori.
     */
    public function index(): JsonResponse
    {
        $category = Category::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'List categories retrieved successfully',
            'data' => $category,
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->only(['id', 'name', 'description']);

        if (empty($data['id'])) {
            return $this->validationErrorResponse('ID must be filled');
        }

        if (!empty($data['id']) && strlen($data['id']) > 255) {
            return $this->validationErrorResponse('ID may not be greater than 255 characters.'); 
        }

        if (empty($data['name'])) {
            return $this->validationErrorResponse('Name is Reuired');
        }

        if (!empty($data['name']) && strlen($data['name']) > 255) {
           return $this->validationErrorResponse('Name may not be greater than 255 characters.'); 
        }

        if (!empty($data['id']) && Category::where('id', $data['id'])->exists()) {
           return $this->validationErrorResponse('ID already exists.'); 
        }

        $category = Category::create([
            'id' => $data['id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Category created successfully',
            'data' => $category,
        ], 201);
    }

    public function destroy(string $id): JsonResponse
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found.',
            ], 404);
        }

        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Category deleted successfully',
        ], 200);
    }

    public function validationErrorResponse($message)
    {
        return response()->json([
                'success' => false,
                'message' => 'Validation failed.',
                'errors' => $message,
            ], 422);
    }
}