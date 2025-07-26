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
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <?php require_once __DIR__ . '/partials/header.php'; ?>
  <h2 class="mb-4">Iniciar sesión</h2>
  <?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
  <?php endif; ?>
  <form method="POST" action="/auth/login">
    <div class="mb-3">
      <label for="email" class="form-label">Correo electrónico:</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <button class="btn btn-primary">Ingresar</button>
  </form>
  <?php require_once __DIR__ . '/partials/footer.php'; ?>
</body>
</html>
