<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title><?= $product ? 'Editar' : 'Crear' ?> Producto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="">
    <?php require_once __DIR__ . '/partials/header.php'; ?>
    <?php require_once __DIR__ . '/partials/search_filters.php'; ?>
    <div class="container py-5">
        <h2><?= $product ? 'Editar' : 'Crear' ?> Producto</h2>
        <div class="text-end m-3">
            <form method="POST" action="/productmanager/save">
                <?php if ($product): ?>
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                <?php endif; ?>
                <div class="mb-3"><label>Nombre</label><input name="name" value="<?= $product['name'] ?? '' ?>" class="form-control" required></div>
                <div class="mb-3"><label>Especificaciones</label><textarea name="specifications" class="form-control" required><?= $product['specifications'] ?? '' ?></textarea></div>
                <div class="mb-3"><label>Precio</label><input name="price" type="number" step="0.01" value="<?= $product['price'] ?? '' ?>" class="form-control" required></div>
                <div class="mb-3"><label>Marca</label><input name="brand" value="<?= $product['brand'] ?? '' ?>" class="form-control"></div>
                <div class="mb-3"><label>Modelo</label><input name="model" value="<?= $product['model'] ?? '' ?>" class="form-control"></div>
                <div class="mb-3"><label>Imagen (ej: dell.webp)</label><input name="image" value="<?= $product['image'] ?? 'base' ?>" class="form-control"></div>
                <div class="mb-3">
                    <label>Categoría</label>
                    <select name="category_id" class="form-select" required>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= $cat['id'] ?>" <?= ($product['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-success">Guardar</button>
            </form>
        </div>
    </div>
    <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>

</html>