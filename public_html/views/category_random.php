<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos de <?= htmlspecialchars($category['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-light">
  <?php require_once __DIR__ . '/partials/header.php'; ?>
  <?php require_once __DIR__ . '/partials/search_filters.php'; ?>
  <div class="container py-4">
    <h1 class="text-primary">Productos sugeridos de <?= htmlspecialchars($category['name']) ?></h1>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
      <?php foreach ($products as $p): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="/img/<?= htmlspecialchars($product['image'].'.webp' ?? 'base.webp') ?>" alt="Imagen de <?= htmlspecialchars($product['name']) ?>" class="img-fluid mb-2 rounded shadow-sm">
            <div class="card-body">
              <h5><?= htmlspecialchars($p['name']) ?></h5>
              <p><strong>Precio:</strong> $<?= number_format($p['price'], 2) ?></p>
              <p>6 meses: <strong>$<?= number_format($p['monthly6'], 2) ?></strong><br>
              12 meses: <strong>$<?= number_format($p['monthly12'], 2) ?></strong></p>
              <a href="/product/show/<?= $p['id'] ?>" class="btn btn-sm btn-primary">Ver más</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <a href="/" class="btn btn-sm btn-outline-secondary mb-3">← Volver al Home</a>
  </div>
  <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
