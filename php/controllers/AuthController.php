<?php
namespace App\Controllers;

use App\Models\User;

class AuthController {
    public function loginForm() {
        require_once __DIR__ . '/../../public_html/views/login.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $user = (new User())->findByEmail($email);

            if ($user) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                header('Location: /');
                exit;
            } else {
                $error = "Usuario no encontrado";
                require_once __DIR__ . '/../../public_html/views/login.php';
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
    }
}
