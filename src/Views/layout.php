<?php


?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $title ?? 'Taller PHP' ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white shadow rounded mb-4 py-2">
  <div class="container d-flex justify-content-between align-items-center">
    <a class="navbar-brand fw-bold fs-4 text-dark" href="/">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#6130d6" class="me-2" viewBox="0 0 16 16">
        <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0Zm0 14.5A6.5 6.5 0 1 1 14.5 8A6.5 6.5 0 0 1 8 14.5Z"/>
      </svg>
      Taller PHP
    </a>
    <div>
      <a class="btn btn-sm btn-outline-primary me-2" href="/employees">
        <i class="bi bi-person-workspace me-1"></i> Empleados
      </a>
      <a class="btn btn-sm btn-outline-success" href="/sales">
        <i class="bi bi-briefcase me-1"></i> Ventas
      </a>
    </div>
  </div>
</nav>
<div class="container">
  <?= $content ?>
</div>
</body>
</html>