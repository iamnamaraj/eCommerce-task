<?php

namespace App\Repositories\Admin;

interface ProductRepositoryInterface
{
    public function allProducts();
    public function getSubCategories();
    public function getSizes();
    public function getColors();
    public function storeProduct($data);
    public function createProductAttribute(array $data);
    public function createProductImageAttribute(array $data);
    public function deleteProduct($id);
}
