<?php
namespace App\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Core\Auth;

class ProductManagerController {
    public function form($id = null) {
        Auth::requireLogin();

        $productModel = new Product();
        $categoryModel = new Category();
        $categories = $categoryModel->getParentCategories();

        $product = $id ? $productModel->findById($id) : null;

        require_once __DIR__ . '/../../public_html/views/product_form.php';
    }

    public function save() {
        Auth::requireLogin(); 
        
        $model = new Product();
        $data = [
            'name' => $_POST['name'],
            'specifications' => $_POST['specifications'],
            'price' => $_POST['price'],
            'category_id' => $_POST['category_id'],
            'brand' => $_POST['brand'],
            'model' => $_POST['model'],
            'image' => $_POST['image'] ?? 'base.webp',
        ];

        if (!empty($_POST['id'])) {
            $model->update($_POST['id'], $data);
        } else {
            $model->create($data);
        }

        header('Location: /');
        exit;
    }
}
