<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="text-primary"><?= htmlspecialchars($product['name']) ?></h1>

    <p><strong>Precio de contado:</strong> $<?= number_format($product['price'], 2) ?></p>
    <p><strong>6 pagos sin intereses:</strong> $<?= number_format($product['price'] / 6, 2) ?> / mes</p>
    <p><strong>12 pagos sin intereses:</strong> $<?= number_format($product['price'] / 12, 2) ?> / mes</p>

    <p><strong>Especificaciones:</strong> <?= htmlspecialchars($product['specifications']) ?></p>
    <p><strong>Marca:</strong> <?= htmlspecialchars($product['brand']) ?></p>
    <p><strong>Modelo:</strong> <?= htmlspecialchars($product['model']) ?></p>

    <h4 class="mt-5 text-success">Comentarios</h4>
    <?php foreach ($comments as $c): ?>
      <div class="border rounded p-2 mb-2 bg-white">
        <strong><?= htmlspecialchars($c['name']) . ' ' . htmlspecialchars($c['last_name']) ?></strong>
        <span class="badge bg-warning text-dark"><?= $c['rating'] ?>/5</span>
        <p><?= htmlspecialchars($c['comment']) ?></p>
      </div>
    <?php endforeach; ?>

    <a href="/public_html/" class="btn btn-link">Volver al Home</a>
  </div>
</body>
</html>
