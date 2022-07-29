<?php

namespace App\Http\Controllers;

use App\Repositories\Category\CategoryInterface;

/**
 * @property CategoryInterface $category
 */

class CategoryController extends Controller
{

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function getCategories()
    {
        return $this->category->getCategories();
    }

    public function categoriesGetOne($id)
    {
        return $this->category->categoriesGetOne($id);
    }
}
