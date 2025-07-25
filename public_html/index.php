<?php
// public_html/index.php

require_once __DIR__ . '/../install/config.php';
require_once __DIR__ . '/../php/core/ClassLoader.php';

// Sanitizar la URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = filter_var($url, FILTER_SANITIZE_URL);
$params = explode('/', $url);

// Obtener controlador y método
$controllerName = !empty($params[0]) ? ucfirst($params[0]) . 'Controller' : 'HomeController';
$method = isset($params[1]) ? $params[1] : 'index';
$args = array_slice($params, 2);

try {
    if (class_exists($controllerName)) {
        $controller = new $controllerName();

        if (method_exists($controller, $method)) {
            call_user_func_array([$controller, $method], $args);
        } else {
            http_response_code(404);
            echo "Método '$method' no encontrado en $controllerName.";
        }
    } else {
        http_response_code(404);
        echo "Controlador '$controllerName' no encontrado.";
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Error interno: " . $e->getMessage();
}
