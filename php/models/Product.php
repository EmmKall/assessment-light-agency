<?php

namespace App\Models;

use App\Models\Database;
use PDO;

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

    public function addLike($id) {
        $stmt = $this->db->prepare("UPDATE products SET likes = likes + 1 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function calcularMensualidadConInteres($precio, $meses, $tasaAnual = 10.0) {
        $r = ($tasaAnual / 100) / 12;
        $n = $meses;
        if ($r === 0) return $precio / $n; // sin interés
        $mensualidad = $precio * ($r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);
        return round($mensualidad, 2);
    }

    public function getRandomByCategory($categoryId, $limit = 10) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = ? ORDER BY RAND() LIMIT ?");
        $stmt->bindValue(1, $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(2, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO products (name, specifications, price, category_id, brand, model, image, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())");
        $stmt->execute([
            $data['name'],
            $data['specifications'],
            $data['price'],
            $data['category_id'],
            $data['brand'],
            $data['model'],
            $data['image']
        ]);
    }
    
    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE products SET name = ?, specifications = ?, price = ?, category_id = ?, brand = ?, model = ?, image = ?, updated_at = NOW() WHERE id = ?");
        $stmt->execute([
            $data['name'],
            $data['specifications'],
            $data['price'],
            $data['category_id'],
            $data['brand'],
            $data['model'],
            $data['image'],
            $id
        ]);
    }

    public function searchByName($query) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE name LIKE ?");
        $stmt->execute(['%' . $query . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchAdvanced($query = '', $categoryId = null, $min = null, $max = null) {
        $sql = "SELECT * FROM products WHERE 1=1";
        $params = [];
    
        if (!empty($query)) {
            $sql .= " AND name LIKE ?";
            $params[] = '%' . $query . '%';
        }
    
        if (!empty($categoryId)) {
            $sql .= " AND category_id = ?";
            $params[] = $categoryId;
        }
    
        if (!empty($min)) {
            $sql .= " AND price >= ?";
            $params[] = $min;
        }
    
        if (!empty($max)) {
            $sql .= " AND price <= ?";
            $params[] = $max;
        }
    
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
