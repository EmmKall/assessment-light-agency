<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Productos Mejor Calificados</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="text-success">Top 10 - Mejor Calificados</h1>
    <a href="/public_html/" class="btn btn-sm btn-outline-secondary mb-3">← Volver al Home</a>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
      <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <img src="/public_html/img/<?= htmlspecialchars($product['image'].'.webp' ?? 'base.webp') ?>" alt="Imagen de <?= htmlspecialchars($product['name']) ?>" class="img-fluid mb-2 rounded shadow-sm">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
              <p><?= htmlspecialchars($product['specifications']) ?></p>
              <p><strong>$<?= number_format($product['price'], 2) ?></strong></p>
              <p><span class="badge bg-warning text-dark">⭐ <?= number_format($product['avg_rating'], 2) ?></span></p>
              <a href="/public_html/product/show/<?= $product['id'] ?>" class="btn btn-sm btn-primary">Ver más</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
