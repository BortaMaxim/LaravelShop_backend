<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriesManagementController extends Controller
{
    protected $categories;
    public function __construct()
    {
        $this->middleware("auth:api");
        $this->categories = new Category();
    }

    public function viewOneCategory($id)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            return $this->categories->findOrFail($id);
        }
    }

    public function createCategory(StoreCategoryRequest $request)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            $request->validated();
            $this->categories->create(['name' => $request->name]);
            return response()->json([
                'success' => true,
                'message' => 'Category created!'
            ]);
        }else {
            return $this->exceptionResponse('Manager');
        }
    }

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            $category = $this->categories->find($id);
            $category->name = $request->name;
            $category->save();
            return response()->json([
                'success' => true,
                'message' => 'Category updated!'
            ]);
        }else {
            return $this->exceptionResponse('Manager');
        }
    }

    public function deleteCategory($id)
    {
        if (Gate::any(['isManager', 'isAdmin'])) {
            $category = $this->categories->find($id);
            $category->destroy($id);
            return response()->json([
                'success' => true,
                'message' => 'Category deleted!'
            ]);
        }else {
            return $this->exceptionResponse('Manager');
        }
    }

    private function exceptionResponse($role) {
        return response()->json([
            'success' => false,
            'message' => "You are not $role!"
        ]);
    }
}
