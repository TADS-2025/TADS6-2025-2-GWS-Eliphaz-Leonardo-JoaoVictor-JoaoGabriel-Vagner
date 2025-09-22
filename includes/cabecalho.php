<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>IF-Investe Blog</title>
  <link rel="stylesheet" href="/style.css">
</head>
<body>

<header>
  <!-- Navbar -->
  <div class="navbar">
    <h1 class="logo">
      <a href="/index.php">
        <img src="/img/ifinveste.png" alt="Logo IF-Investe" height="60">
      </a>
    </h1>

    <nav>
      <a href="/index.php">Início</a>
      <a href="/admin/login.php">Admin</a>
    </nav>
  </div>

  <!-- Hero Section -->
  <?php if (strpos($_SERVER['PHP_SELF'], '/admin/') === false): ?>
    <div class="hero">
      <h2>Bem-vindo ao <span>IF-Investe</span></h2>
      <p>Educação financeira, investimentos e muito mais!</p>
      <a href="/index.php#posts" class="btn-hero">Explorar Posts ↓</a>
    </div>
  <?php endif; ?>
</header>

<main id="posts">
