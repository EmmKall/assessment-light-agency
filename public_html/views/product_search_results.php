<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Resultados de búsqueda</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php require_once __DIR__ . '/partials/header.php'; ?>
<?php require_once __DIR__ . '/partials/search_filters.php'; ?>

<div class="container">
  <h2 class="mb-3">Resultados para: <em><?= htmlspecialchars($_GET['query']) ?></em></h2>

  <?php if (empty($results)): ?>
    <div class="alert alert-warning">No se encontraron productos.</div>
  <?php else: ?>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      <?php foreach ($results as $product): ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="/img/<?= $product['image'] .'.webp' ?? 'base.webp' ?>" class="card-img-top" alt="Imagen">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
              <p class="card-text"><?= htmlspecialchars($product['specifications']) ?></p>
              <p class="fw-bold text-success">$<?= number_format($product['price'], 2) ?></p>
              <a href="/product/show/<?= $product['id'] ?>" class="btn btn-sm btn-primary">Ver más</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
