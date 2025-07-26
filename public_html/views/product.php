<?php
  use App\Core\Auth;
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-light">
  <?php require_once __DIR__ . '/partials/header.php'; ?>
  <?php require_once __DIR__ . '/partials/search_filters.php'; ?>
  <div class="container py-4">
    <h1 class="text-primary"><?= htmlspecialchars($product['name']) ?></h1>

    <p><strong>Precio de contado:</strong> $<?= number_format($product['price'], 2) ?></p>
    <p><strong>Visitas:</strong> <?= $product['visits'] ?></p>
    <div class="alert alert-info">
        <h5 class="mb-1">Opciones de pago</h5>
        <p class="mb-1">6 mensualidades de <strong>$<?= number_format($monthly6, 2) ?></strong></p>
        <p class="mb-0">12 mensualidades de <strong>$<?= number_format($monthly12, 2) ?></strong></p>
    </div>

    <img src="/img/<?= htmlspecialchars($product['image'].'.webp' ?? 'base.webp') ?>" alt="Imagen de <?= htmlspecialchars($product['name']) ?>" class="img-fluid mb-2 rounded shadow-sm mx-auto">

    <p><strong>Especificaciones:</strong> <?= htmlspecialchars($product['specifications']) ?></p>
    <p><strong>Marca:</strong> <?= htmlspecialchars($product['brand']) ?></p>
    <p><strong>Modelo:</strong> <?= htmlspecialchars($product['model']) ?></p>

    <form action="/product/like/<?= $product['id'] ?>" method="post">
        <button type="submit" class="btn btn-outline-danger btn-sm">
            ❤️ Me gusta (<?= $product['likes'] ?>)
        </button>
    </form>

    <p><strong>Likes:</strong> <?= $product['likes'] ?></p>
    <p><small>Creado: <?= $product['created_at'] ?> | Modificado: <?= $product['updated_at'] ?></small></p>

    <h4 class="mt-5 text-success">Comentarios</h4>
    <?php foreach ($comments as $c): ?>
      <div class="border rounded p-2 mb-2 bg-white">
        <strong><?= htmlspecialchars($c['name']) . ' ' . htmlspecialchars($c['last_name']) ?></strong>
        <span class="badge bg-warning text-dark"><?= $c['rating'] ?>/5</span>
        <p><?= htmlspecialchars($c['comment']) ?></p>
      </div>
    <?php endforeach; ?>

    <a href="/" class="btn btn-sm btn-outline-secondary mb-3">← Volver al Home</a>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
