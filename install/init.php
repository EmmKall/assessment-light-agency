<?php
// init.php

require_once 'config.php';

$logFile = __DIR__ . '/init_log.txt';
file_put_contents($logFile, "Inicio del proceso de inicialización...\n");

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // === Insertar categorías ===
    $stmt = $pdo->prepare("INSERT INTO categories (name, parent_id) VALUES (?, ?)");
    for ($i = 1; $i <= 10; $i++) {
        $stmt->execute(["Categoría Extra $i", rand(1, 3)]);
    }

    // === Insertar usuarios ===
    $stmt = $pdo->prepare("INSERT INTO users (name, last_name, email) VALUES (?, ?, ?)");
    for ($i = 1; $i <= 10; $i++) {
        $stmt->execute([
            "Usuario$i",
            "Apellido$i",
            "usuario$i@example.com"
        ]);
    }

    // === Insertar productos ===
    $stmt = $pdo->prepare("INSERT INTO products (name, specifications, price, category_id, brand, model) VALUES (?, ?, ?, ?, ?, ?)");
    for ($i = 1; $i <= 10; $i++) {
        $stmt->execute([
            "Producto Extra $i",
            "Specs generadas automáticamente",
            rand(10000, 60000),
            rand(1, 10),
            "Marca $i",
            "Modelo $i"
        ]);
    }

    // === Insertar comentarios ===
    $stmt = $pdo->prepare("INSERT INTO comments (product_id, user_id, comment, rating) VALUES (?, ?, ?, ?)");
    for ($i = 1; $i <= 10; $i++) {
        $stmt->execute([
            rand(1, 20),  // hay más productos ahora
            rand(1, 20),  // también más usuarios
            "Comentario extra $i generado automáticamente.",
            rand(3, 5)
        ]);
    }

    file_put_contents($logFile, "Inicialización completada con éxito.\n", FILE_APPEND);
    file_put_contents($logFile, "Se insertaron 10 registros en cada tabla.\n", FILE_APPEND);

    echo "Inicialización completada correctamente. Revisa el archivo 'init_log.txt'.";
} catch (PDOException $e) {
    $error = "Error en la inicialización: " . $e->getMessage();
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    echo $error;
}
