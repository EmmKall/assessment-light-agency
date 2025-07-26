<?php
use App\Models\Category;
$categoryModel = new Category();
$categories = $categoryModel->getParentCategories(); // puedes extender a incluir hijas si quieres
?>

<div class="container mb-4">
  <form action="/product/search" method="GET" class="row gy-2 gx-3 align-items-end">
    <!-- Buscar por nombre -->
    <div class="col-sm-6 col-md-4">
      <label class="form-label">Buscar producto</label>
      <input type="text" name="query" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>" class="form-control" placeholder="Nombre del producto">
    </div>

    <!-- Filtro de categoría -->
    <div class="col-sm-6 col-md-3">
      <label class="form-label">Categoría</label>
      <select name="category_id" class="form-select">
        <option value="">Todas</option>
        <?php foreach ($categories as $cat): ?>
          <option value="<?= $cat['id'] ?>" <?= ($_GET['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat['name']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <!-- Rango de precios -->
    <div class="col-6 col-md-2">
      <label class="form-label">Precio mínimo</label>
      <input type="number" name="min_price" value="<?= htmlspecialchars($_GET['min_price'] ?? '') ?>" class="form-control">
    </div>

    <div class="col-6 col-md-2">
      <label class="form-label">Precio máximo</label>
      <input type="number" name="max_price" value="<?= htmlspecialchars($_GET['max_price'] ?? '') ?>" class="form-control">
    </div>

    <div class="col-12 col-md-1 d-grid">
      <button type="submit" class="btn btn-outline-primary">🔍</button>
    </div>
  </form>
</div>
