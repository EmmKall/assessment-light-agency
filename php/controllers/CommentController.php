<?php

namespace App\Controllers;
use App\Models\Comment;

class CommentController {
  protected $commentModel;

  public function __construct() {
    $this->commentModel = new Comment();
  }

  public function store() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
      header('Location: /auth/loginform');
      exit;
    }

    $userId = $_SESSION['user_id'];
    $productId = $_POST['product_id'];
    $content = trim($_POST['content']);

    if ($productId && $content) {
      $this->commentModel->create($userId, $productId, $content);
    }

    header("Location: /product/show/$productId");
    exit;
  }
}

