<?php
// php/controllers/HomeController.php

class HomeController {
    private $categoryModel;
    private $productModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->productModel = new Product();
    }

    public function index() {
        $categories = $this->categoryModel->getParentCategories();
        $featured = $this->productModel->getRandom(10);
        $bestsellers = $this->productModel->getRandom(10);

        require_once __DIR__ . '/../../public_html/views/home.php';
    }
}
