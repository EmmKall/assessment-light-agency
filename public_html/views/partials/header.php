<?php
use App\Core\Auth;
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="/">🖥️ Tienda Light</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/">Inicio</a></li>
        <li class="nav-item"><a class="nav-link" href="/category/show/1">Categorías</a></li>

        <?php if (Auth::check()): ?>
          <li class="nav-item"><a class="nav-link" href="/productmanager/form">➕ Crear producto</a></li>
        <?php endif; ?>
      </ul>

      <div class="d-flex">
        <?php if (Auth::check()): ?>
          <span class="navbar-text text-white me-3">👤 <?= Auth::userName() ?></span>
          <a href="/auth/logout" class="btn btn-sm btn-outline-light">Cerrar sesión</a>
        <?php else: ?>
          <a href="/auth/loginform" class="btn btn-sm btn-outline-light">Iniciar sesión</a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
