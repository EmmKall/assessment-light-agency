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

    $logFile = __DIR__ . '/log.txt';
    $error = "Clase no encontrada: $class";
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    error_log($error); 
});
