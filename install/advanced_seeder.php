<?php
require_once 'config.php';

function getPDO() {
    return new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
}

function generarNombreProducto($marca) {
    $modelos = ['X100', 'ZBook', 'PowerPro', 'SlimTech', 'CorePad', 'ProBook', 'VisionX'];
    return $marca . ' ' . $modelos[array_rand($modelos)] . ' ' . rand(2020, 2025);
}

function generarSpecs() {
    $cpu = ['Intel i5', 'Intel i7', 'Ryzen 5', 'Ryzen 7'];
    $ram = ['8GB', '16GB', '32GB'];
    $disk = ['256GB SSD', '512GB SSD', '1TB SSD', '2TB HDD'];
    return $cpu[array_rand($cpu)] . ', ' . $ram[array_rand($ram)] . ', ' . $disk[array_rand($disk)];
}

function generarComentario() {
    $plantillas = [
        'Muy buen equipo, me ha funcionado excelente.',
        'La batería dura bastante.',
        'Ideal para trabajar desde casa.',
        'Buena relación calidad/precio.',
        'El diseño es elegante y funcional.',
        'Me encanta la velocidad de arranque.',
        'Cumple con todas mis expectativas.',
        'Es silenciosa y rápida.',
        'Perfecta para mis estudios.',
        'Lo volvería a comprar sin duda.'
    ];
    return $plantillas[array_rand($plantillas)];
}

$pdo = getPDO();

// Obtener IDs existentes
$categorias = $pdo->query("SELECT id FROM categories")->fetchAll(PDO::FETCH_COLUMN);
$usuarios = $pdo->query("SELECT id FROM users")->fetchAll(PDO::FETCH_COLUMN);

// 1. Insertar 2,000 productos
$insertProducto = $pdo->prepare("
    INSERT INTO products (name, specifications, price, category_id, brand, model, image, created_at, updated_at)
    VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW())
");

$marcas = ['HP', 'Dell', 'Lenovo', 'Apple', 'Acer', 'Asus', 'Huawei', 'Samsung'];

for ($i = 1; $i <= 2000; $i++) {
    $marca = $marcas[array_rand($marcas)];
    $nombre = generarNombreProducto($marca);
    $specs = generarSpecs();
    $precio = rand(10000, 60000);
    $cat = $categorias[array_rand($categorias)];
    $modelo = strtoupper(substr($marca, 0, 3)) . rand(100, 999);

    $insertProducto->execute([$nombre, $specs, $precio, $cat, $marca, $modelo, $marca]);
}

echo "✅ Se insertaron 2,000 productos.\n";

// 2. Obtener IDs de productos nuevos
$productos = $pdo->query("SELECT id FROM products ORDER BY id DESC LIMIT 2000")->fetchAll(PDO::FETCH_COLUMN);

// 3. Insertar 10,000 comentarios
$insertComentario = $pdo->prepare("
    INSERT INTO comments (product_id, user_id, comment, rating)
    VALUES (?, ?, ?, ?)
");

for ($i = 0; $i < 10000; $i++) {
    $prod = $productos[array_rand($productos)];
    $user = $usuarios[array_rand($usuarios)];
    $comentario = generarComentario();
    $rating = rand(3, 5);

    $insertComentario->execute([$prod, $user, $comentario, $rating]);
}

echo "✅ Se insertaron 10,000 comentarios.\n";
