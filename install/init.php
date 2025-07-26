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
    $stmt = $pdo->prepare("INSERT INTO products (name, specifications, price, category_id, brand, model, image) VALUES (?, ?, ?, ?, ?, ?, ? )");
    for ($i = 1; $i <= 10; $i++) {
        $stmt->execute([
            "Producto Extra $i",
            "Specs generadas automáticamente",
            rand(10000, 60000),
            rand(1, 10),
            "Base",
            "Modelo $i",
            "Base",
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
    

    // Generar 200 productos aleatorios
    $stmt = $pdo->prepare("INSERT INTO products (name, specifications, price, category_id, brand, model, image) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $brands = ['HP', 'Dell', 'Apple', 'Lenovo', 'Asus', 'Acer', 'MSI', 'Samsung'];
    $models = ['X1', 'G3', 'T450', 'Pavilion', 'ProBook', 'Legion', 'ThinkBook', 'Envy'];

    for ($i = 1; $i <= 200; $i++) {
        $brand = $brands[array_rand($brands)];
        $model = $models[array_rand($models)];
        $spec = "{$brand} {$model} - " . rand(8, 64) . "GB RAM, " . rand(256, 2000) . "GB SSD";
        $price = rand(10000, 60000);
        $categoryId = rand(1, 10);
        $image = $model;

        $stmt->execute([
            "Producto Random $i",
            $spec,
            $price,
            $categoryId,
            $brand,
            $model,
            $image
        ]);
    }

    // Obtener IDs de productos y usuarios
    $productIds = $pdo->query("SELECT id FROM products")->fetchAll(PDO::FETCH_COLUMN);
    $userIds = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);

    // Insertar 1000 comentarios aleatorios
    $stmt = $pdo->prepare("INSERT INTO comments (product_id, user_id, comment, rating) VALUES (?, ?, ?, ?)");

    for ($i = 1; $i <= 1000; $i++) {
        $prodId = $productIds[array_rand($productIds)];
        $userId = $userIds[array_rand($userIds)];
        $rating = rand(3, 5);
        $comment = "Comentario automático $i: buen producto con calificación $rating.";

        $stmt->execute([$prodId, $userId, $comment, $rating]);
    }

    file_put_contents($logFile, "Inicialización completada con éxito.\n", FILE_APPEND);
    file_put_contents($logFile, "Se insertaron 10 registros en cada tabla.\n", FILE_APPEND);
    file_put_contents($logFile, "Se insertaron 200 registros en productos y 1000 comentarios.\n", FILE_APPEND);

    echo "Inicialización completada correctamente. Revisa el archivo 'init_log.txt'.";
} catch (PDOException $e) {
    $error = "Error en la inicialización: " . $e->getMessage();
    file_put_contents($logFile, $error . "\n", FILE_APPEND);
    echo $error;
}
