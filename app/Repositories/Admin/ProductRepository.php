<?php

namespace App\Repositories\Admin;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\AttributeProduct;
use App\Models\AttributeImageProduct;
use App\Models\Category;


class ProductRepository implements ProductRepositoryInterface
{
    public function allProducts()
    {
        return  Product::with('attributeProducts.size', 'attributeProducts.color', 'attributeProducts.images')
            ->latest()->paginate(7);
    }

    public function getSubCategories()
    {
        return Category::whereNotNull('category_id')->latest()->get();
    }

    public function getSizes()
    {
        return Size::all();
    }

    public function getColors()
    {
        return Color::all();
    }

    public function storeProduct($data)
    {
        return Product::create($data);
    }

    public function createProductAttribute(array $data)
    {
        return AttributeProduct::create($data);
    }

    public function createProductImageAttribute(array $data)
    {
        return AttributeImageProduct::create($data);
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        foreach ($product->attributeProducts as $attribute) {
            foreach ($attribute->images as $image) {
                \Storage::disk('public')->delete('product_image/' . $image->image);
                $image->delete();
            }
            $attribute->delete();
        }
        $product->delete();
    }
}
