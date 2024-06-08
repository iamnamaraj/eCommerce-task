<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\storeCategoryRequest;
use App\Http\Requests\updateCategoryRequest;
use App\Repositories\Admin\CategoriesManageRepositoryInterface;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{

    protected $categoryRepository;

    public function __construct(CategoriesManageRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryRepository->allCategories();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryRepository->parentCategory();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeCategoryRequest $request)
    {
        $data = $request->all();
        $this->categoryRepository->storeCategory($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = $this->categoryRepository->findCategory($id);
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->findCategory($id);
        $categories = $this->categoryRepository->parentCategory();

        return view('admin.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(updateCategoryRequest $request, $id)
    {
        $data = $request->all();
        $category = $this->categoryRepository->findCategory($id);
        $this->categoryRepository->updateCategory($data, $category);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $category = $this->categoryRepository->findCategory($id);
            $this->categoryRepository->deleteCategory($category);
            return redirect()->route('admin.categories.index')
                ->with('success', 'Category deleted successfully!');
        } catch (QueryException $exception) {
            if ($exception->getCode() == "23000") {
                return redirect()->route('admin.categories.index')
                    ->with('error', 'You cannot delete this category until its subcategories are deleted.');
            }
            return redirect()->route('admin.categories.index')
                ->with('error', 'An error occurred while trying to delete the category.');
        }
    }
}
