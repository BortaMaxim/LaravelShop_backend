<?php

namespace App\Repositories\Admin\CategoryManagement;

interface CategoryManagementInterface
{
    public function createCategory($request);
    public function updateCategory($request, int $category_id);
    public function deleteCategory(int $category_id);
}
