<?php

namespace App\Repositories\Category;

interface CategoryInterface
{
    public function getCategories();
    public function categoriesGetOne($id);
}
