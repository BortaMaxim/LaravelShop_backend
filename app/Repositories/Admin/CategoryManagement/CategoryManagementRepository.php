<?php

namespace App\Repositories\Admin\CategoryManagement;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;

/**
 * @property Category $category
 */
class CategoryManagementRepository extends Controller implements CategoryManagementInterface
{
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function createCategory($request): \Illuminate\Http\JsonResponse
    {
        $request->validated();
        $this->category->create(['name' => $request->name]);
        return response()->json([
            'success' => true,
            'message' => 'Category created!'
        ]);
    }

    public function updateCategory($request, int $category_id): \Illuminate\Http\JsonResponse
    {
        $category = $this->category->find($category_id);
        $category->name = $request->name;
        $category->save();
        return response()->json([
            'success' => true,
            'message' => 'Category updated!'
        ]);
    }

    public function deleteCategory(int $category_id): \Illuminate\Http\JsonResponse
    {
        $category = $this->category->find($category_id);
        $category->destroy($category_id);
        return response()->json([
            'success' => true,
            'message' => 'Category deleted!'
        ]);
    }
}
