<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($category['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body class="bg-light">
  <?php require_once __DIR__ . '/partials/header.php'; ?>
  <?php require_once __DIR__ . '/partials/search_filters.php'; ?>
  <div class="container py-4">
  <h1 class="text-primary">Categoría: <?= htmlspecialchars($category['name']) ?></h1>

    <a href="/" class="btn btn-sm btn-outline-secondary mb-3">← Volver al Home</a>

    <a href="/category/random/<?= $category['id'] ?>" class="btn btn-sm btn-outline-secondary mb-3">Productos sugeridos</a>
    <a href="/category/random/<?= $category['id'] ?>" class="btn btn-sm btn-outline-secondary mb-3">Productos de <?= htmlspecialchars($category['name']) ?></a>

    <?php if ($childCategories): ?>
      <h5>Categorías Hijas:</h5>
      <ul class="list-inline">
        <?php foreach ($childCategories as $child): ?>
          <li class="list-inline-item">
            <a href="/category/show/<?= $child['id'] ?>" class="btn btn-outline-secondary btn-sm"><?= $child['name'] ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <h3 class="text-success mt-4">Productos</h3>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3 mb-3">
      <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="/img/<?= htmlspecialchars($product['image'].'.webp' ?? 'base.webp') ?>" alt="Imagen de <?= htmlspecialchars($product['name']) ?>" class="img-fluid mb-2 rounded shadow-sm">
            <div class="card-body">
              <h5><?= htmlspecialchars($product['name']) ?></h5>
              <p>$<?= number_format($product['price'], 2) ?></p>
              <a href="/product/show/<?= $product['id'] ?>" class="btn btn-primary btn-sm">Ver Detalle</a>
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
