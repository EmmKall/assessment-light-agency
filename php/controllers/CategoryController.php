<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;

class CategoryController {
    private $categoryModel;
    private $productModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->productModel = new Product();
    }

    public function show($id) {
        $category = $this->categoryModel->findById($id);
        $childCategories = $this->categoryModel->getChildCategories($id);
        $products = $this->productModel->findByCategory($id);

        require_once __DIR__ . '/../../public_html/views/category.php';
    }

    public function random($id) {
        $category = $this->categoryModel->findById($id);
        $products = $this->productModel->getRandomByCategory($id);
    
        // Calculamos mensualidades para cada producto
        foreach ($products as &$product) {
            $product['monthly6'] = $this->productModel->calcularMensualidadConInteres($product['price'], 6);
            $product['monthly12'] = $this->productModel->calcularMensualidadConInteres($product['price'], 12);
        }
    
        require_once __DIR__ . '/../../public_html/views/category_random.php';
    }
}
  