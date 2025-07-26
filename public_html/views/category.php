<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($category['name']) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="text-primary">Categoría: <?= htmlspecialchars($category['name']) ?></h1>

    <?php if ($childCategories): ?>
      <h5>Categorías Hijas:</h5>
      <ul class="list-inline">
        <?php foreach ($childCategories as $child): ?>
          <li class="list-inline-item">
            <a href="/public_html/category/show/<?= $child['id'] ?>" class="btn btn-outline-secondary btn-sm"><?= $child['name'] ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>

    <h3 class="text-success mt-4">Productos</h3>
    <div class="row">
      <?php foreach ($products as $product): ?>
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5><?= htmlspecialchars($product['name']) ?></h5>
              <p>$<?= number_format($product['price'], 2) ?></p>
              <a href="/public_html/product/show/<?= $product['id'] ?>" class="btn btn-primary btn-sm">Ver Detalle</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <a href="/public_html/" class="btn btn-link">Volver al Home</a>
  </div>
</body>
</html>
