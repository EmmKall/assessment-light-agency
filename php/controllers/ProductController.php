<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Comment;

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
        /* $price = $product['price'];
        $monthly6 = $price / 6;
        $monthly12 = $price / 12; */
        // Calcular mensualidades con interés
        $monthly6 = $this->productModel->calcularMensualidadConInteres($product['price'], 6);
        $monthly12 = $this->productModel->calcularMensualidadConInteres($product['price'], 12);

        require_once __DIR__ . '/../../public_html/views/product.php';
    }

    public function topRated() {
        $products = $this->productModel->getByRating();
        require_once __DIR__ . '/../../public_html/views/top_rated.php';
    }

    public function like($id) {
        $this->productModel->addLike($id);
        header("Location: /public_html/product/show/$id");
        exit;
    }

    public function search() {
        $query = $_GET['query'] ?? '';
        $categoryId = $_GET['category_id'] ?? null;
        $min = $_GET['min_price'] ?? null;
        $max = $_GET['max_price'] ?? null;
    
        $results = $this->productModel->searchAdvanced($query, $categoryId, $min, $max);
    
        require_once __DIR__ . '/../../public_html/views/product_search_results.php';
    }
}
