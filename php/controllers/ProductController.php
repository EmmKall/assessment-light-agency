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

        $this->productModel->incrementViews($id);
        // Cálculo de mensualidades sin intereses
        $price = $product['price'];
        $monthly6 = $price / 6;
        $monthly12 = $price / 12;

        require_once __DIR__ . '/../../public_html/views/product.php';
    }

    public function topRated() {
        $products = $this->productModel->getByRating();
        require_once __DIR__ . '/../../public_html/views/top_rated.php';
    }
}
