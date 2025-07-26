<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tienda Light</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-4">
    <h1 class="mb-4 text-primary">Tienda Light - Catálogo</h1>

    <!-- Menú de Categorías -->
    <nav class="mb-4">
      <h5>Categorías</h5>
      <ul class="list-inline">
        <?php foreach ($categories as $cat): ?>
          <li class="list-inline-item">
            <a href="/public_html/category/show/<?= $cat['id'] ?>" class="btn btn-outline-primary btn-sm"><?= htmlspecialchars($cat['name']) ?></a>
          </li>
        <?php endforeach; ?>
      </ul>
    </nav>

    <!-- Productos Destacados -->
    <section class="mb-5">
      <h3 class="text-success">Productos Destacados</h3>
      <div class="row">
        <?php foreach ($featured as $product): ?>
          <div class="col-md-4 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($product['name']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($product['specifications']) ?></p>
                <p><strong>$<?= number_format($product['price'], 2) ?></strong></p>
                <a href="/public_html/product/show/<?= $product['id'] ?>" class="btn btn-sm btn-primary">Ver más</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Más vendidos -->
    <section>
      <h3 class="text-warning">Más Vendidos</h3>
      <div class="row">
        <?php foreach ($bestsellers as $product): ?>
          <div class="col-md-3 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <h6 class="card-title"><?= htmlspecialchars($product['name']) ?></h6>
                <p><strong>$<?= number_format($product['price'], 2) ?></strong></p>
                <a href="/public_html/product/show/<?= $product['id'] ?>" class="btn btn-sm btn-secondary">Ver</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </div>
</body>
</html>
