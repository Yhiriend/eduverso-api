<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'No categories found',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'categories' => $categories
            ]
        ], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $category = $this->categoryService->createCategory($request->all());

        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category,
            'status' => 201,
        ], 201);
    }

    public function show($id)
    {
        $category = $this->categoryService->find($id);
        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Operation success',
            'status' => 200,
            'context' => [
                'category' => $category
            ]
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors(),
                'status' => 422,
            ], 422);
        }

        $category = $this->categoryService->updateCategory($id, $request->all());
        if (!$category) {
            return response()->json([
                'message' => 'Category not found',
                'status' => 404,
            ], 404);
        }

        return response()->json([
            'message' => 'Category updated successfully',
            'category' => $category,
            'status' => 200,
        ], 200);
    }

    public function destroy($id)
    {
        if ($this->categoryService->deleteCategory($id)) {
            return response()->json([
                'message' => 'Category deleted successfully',
                'status' => 200,
            ], 200);
        }

        return response()->json([
            'message' => 'Category not found',
            'status' => 404,
        ], 404);
    }
}
