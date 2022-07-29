<?php

namespace App\Http\Controllers;

use App\Http\Requests\Admin\StoreCategoryRequest;
use App\Http\Requests\Admin\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\Admin\CategoryManagement\CategoryManagementInterface;
use App\Repositories\Category\CategoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

/**
 * @property CategoryManagementInterface $category
 */
class CategoriesManagementController extends Controller
{
    public function __construct(CategoryManagementInterface $category)
    {
        $this->middleware("auth:api");
        $this->category = $category;
    }

    public function viewOneCategory(CategoryInterface $category, $id)
    {
            return $category->categoriesGetOne($id);
    }

    public function createCategory(StoreCategoryRequest $request)
    {
        return $this->category->createCategory($request);
    }

    public function updateCategory(UpdateCategoryRequest $request, $id)
    {
        return $this->category->updateCategory($request, $id);
    }

    public function deleteCategory($id)
    {
        return $this->category->deleteCategory($id);
    }
}
