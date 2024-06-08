<?php

namespace App\Repositories\Admin;

use App\Models\Category;

interface CategoriesManageRepositoryInterface
{
    public function allCategories();
    public function parentCategory();
    public function storeCategory(array $data);
    public function findCategory($id);
    public function updateCategory(array $data, Category $category);
    public function deleteCategory(Category $category);
}
