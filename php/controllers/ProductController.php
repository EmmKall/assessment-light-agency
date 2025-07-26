<?php
// php/controllers/ProductController.php

class ProductController {
    private $productModel;
    private $commentModel;

    public function __construct() {
        $this->productModel = new Product();
        $this->commentModel = new Comment();
    }

    public function show($id) {
        $product = $this->productModel->findById($id);
        $comments = $this->commentModel->getByProduct($id);

        require_once __DIR__ . '/../../public_html/views/product.php';
    }
}
