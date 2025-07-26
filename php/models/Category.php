<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getParentCategories() {
        $stmt = $this->db->query("SELECT * FROM categories WHERE parent_id IS NULL");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChildCategories($parentId) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE parent_id = ?");
        $stmt->execute([$parentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
