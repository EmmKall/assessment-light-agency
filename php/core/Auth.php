<?php
namespace App\Core;

class Auth {
    public static function check() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        return isset($_SESSION['user_id']);
    }

    public static function requireLogin() {
        if (!self::check()) {
            header('Location: /auth/loginform');
            exit;
        }
    }

    public static function userName() {
        return $_SESSION['user_name'] ?? 'Invitado';
    }
}

