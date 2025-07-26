<?php

require_once __DIR__ . '/../install/config.php';
require_once __DIR__ . '/../php/core/ClassLoader.php';

use App\Controllers;

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$params = explode('/', $url);

$controllerName = !empty($params[0]) ? ucfirst($params[0]) . 'Controller' : 'HomeController';
$method = $params[1] ?? 'index';
$args = array_slice($params, 2);

$controllerClass = "App\\Controllers\\$controllerName";

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $method)) {
        call_user_func_array([$controller, $method], $args);
    } else {
        echo "Método '$method' no encontrado.";
    }
} else {
    echo "Controlador '$controllerName' no encontrado.";
}
