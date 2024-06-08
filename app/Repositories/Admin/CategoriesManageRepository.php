<?php

namespace App\Repositories\Admin;

use App\Models\Category;

class CategoriesManageRepository implements CategoriesManageRepositoryInterface
{
    public function allCategories()
    {
        return Category::latest()->paginate(7);
    }

    public function parentCategory()
    {
        return  Category::whereNull('category_id')->latest()->get();
    }

    public function storeCategory(array $data)
    {
        return Category::create($data);
    }

    public function findCategory($id)
    {
        return Category::findOrFail($id);
    }

    public function updateCategory(array $data, Category $category)
    {
        $category->update($data);
        return $category;
    }

    public function deleteCategory(Category $category)
    {
        $category->delete();
    }
}
