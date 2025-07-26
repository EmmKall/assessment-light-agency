<?php

namespace App\Models;

use App\Models\Database;
use PDO;

class Comment {
    private $db;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function getByProduct($productId) {
        $stmt = $this->db->prepare("
            SELECT c.comment, c.rating, u.name, u.last_name
            FROM comments c
            JOIN users u ON c.user_id = u.id
            WHERE c.product_id = ?
            ORDER BY c.id DESC
        ");
        $stmt->execute([$productId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($userId, $productId, $content) {
        $stmt = $this->db->prepare("INSERT INTO comments (user_id, product_id, comment, created_at) VALUES (?, ?, ?, NOW())");
        return $stmt->execute([$userId, $productId, $content]);
      }
}
