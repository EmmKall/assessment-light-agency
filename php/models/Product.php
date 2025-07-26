<?php
// php/models/Product.php

class Product {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM products");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRandom($limit = 10) {
        $stmt = $this->db->prepare("SELECT * FROM products ORDER BY RAND() LIMIT :lim");
        $stmt->bindValue(':lim', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findByCategory($categoryId) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = ?");
        $stmt->execute([$categoryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function calcularMensualidad($precio, $meses) {
        return number_format($precio / $meses, 2);
    }

    public function incrementViews($id) {
        $stmt = $this->db->prepare("UPDATE products SET visits = visits + 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getByRating() {
        $sql = "
            SELECT p.*, AVG(c.rating) as avg_rating
            FROM products p
            LEFT JOIN comments c ON p.id = c.product_id
            GROUP BY p.id
            ORDER BY avg_rating DESC
            LIMIT 10;
        ";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
