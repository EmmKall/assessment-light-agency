<?php
// php/controllers/CategoryController.php

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
}
  