<?php
// php/core/ClassLoader.php

spl_autoload_register(function ($class) {
    $paths = [
        __DIR__ . '/../models/' . $class . '.php',
        __DIR__ . '/../controllers/' . $class . '.php'
    ];

    foreach ($paths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Log si no se encuentra la clase (opcional)
    error_log("Clase no encontrada: $class");
});
