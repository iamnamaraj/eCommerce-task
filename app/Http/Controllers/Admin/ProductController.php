<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\AttributeProduct;
use App\Http\Controllers\Controller;
use App\Models\AttributeImageProduct;
use Illuminate\Validation\Rules\Exists;
use App\Http\Requests\storeProductRequest;
use App\Repositories\Admin\ProductRepositoryInterface;

class ProductController extends Controller
{
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products =  $this->productRepository->allProducts();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sizes = $this->productRepository->getSizes();
        $categories = $this->productRepository->getSubCategories();
        $colors = $this->productRepository->getColors();
        return view('admin.products.create', compact('categories', 'sizes', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(storeProductRequest $request)
    {
        $data  = $request->all();
        $productData = [
            'name' => $data['name'],
            'price' => $data['price'],
            'category_id' => $data['category_id'],
            'description' => $data['description'],
        ];
        $product = $this->productRepository->storeProduct($productData);

        foreach ($data['attributes'] as $attribute) {
            $attributeData = [
                'product_id' => $product->id,
                'size_id' => $attribute['size_id'],
                'color_id' => $attribute['color_id'],
                'quantity' => $attribute['quantity'],
            ];

            $attributeProduct = $this->productRepository->createProductAttribute($attributeData);

            foreach ($attribute['images'] as $image) {
                $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);

                $extension = $image->getClientOriginalExtension();
                $filename = $originalName . '-' . uniqid() . '.' . $extension;

                $imagePath = $image->storeAs('product_image', $filename, 'public');

                $imageData = [
                    'attribute_product_id' => $attributeProduct->id,
                    'image' => $imagePath,
                ];

                $this->productRepository->createProductImageAttribute($imageData);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->productRepository->deleteProduct($id);
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }
}
