<?php
// php/core/ClassLoader.php

spl_autoload_register(function ($class) {
    // Quitar el namespace base si existe
    $class = str_replace('App\\', '', $class);
    $file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        error_log("❌ Clase no encontrada: $file");
    }
    /* $paths = [
        __DIR__ . '/../models/' . $class . '.php',
        __DIR__ . '/../controllers/' . $class . '.php',
        __DIR__ . '/../views/' . $class . '.php',
        __DIR__ . '/../core/' . $class . '.php',
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    $logFile = __DIR__ . '/log.txt';
    $error = "Clase no encontrada: $class";
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    error_log($error);  */
});
