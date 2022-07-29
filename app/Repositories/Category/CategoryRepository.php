<?php

namespace App\Repositories\Category;

use App\Models\Category;

class CategoryRepository implements CategoryInterface
{
    protected Category $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->category->categoriesGet();
    }

    public function categoriesGetOne($id): \Illuminate\Http\JsonResponse
    {
        return $this->category->getCategory($id);
    }
}
