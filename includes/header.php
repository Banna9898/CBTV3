<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/helpers.php';
?><!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CBT System</title>

  <!-- Bootstrap 4 CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- Font Awesome CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">

  <!-- Argon-like theme (local fallback) -->
  <link rel="stylesheet" href="/assets/css/argon-lite.css">

  <link rel="stylesheet" href="/assets/css/custom.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <a class="navbar-brand" href="/index.php">CBT</a>
  <div class="collapse navbar-collapse">
    <ul class="navbar-nav ml-auto">
<?php if(!empty($_SESSION['user'])): ?>
      <li class="nav-item"><a class="nav-link" href="/user/dashboard.php">Dashboard</a></li>
      <?php if(($_SESSION['user']['role'] ?? '') === 'admin'): ?>
      <li class="nav-item"><a class="nav-link" href="/admin/dashboard.php">Admin</a></li>
      <?php endif; ?>
      <li class="nav-item"><a class="nav-link" href="/logout.php">Logout</a></li>
<?php else: ?>
      <li class="nav-item"><a class="nav-link" href="/login.php">Login</a></li>
      <li class="nav-item"><a class="nav-link" href="/register.php">Register</a></li>
<?php endif; ?>
    </ul>
  </div>
</nav>
<div class="container mt-4">
