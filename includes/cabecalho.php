<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>IF-Investe Blog</title>
  <link rel="stylesheet" href="/blog/style.css">
</head>
<body>

<?php
// Detecta se está no admin (caminho /admin/)
$basePath = (strpos($_SERVER['PHP_SELF'], '/admin/') !== false) ? '../' : '';
?>

<header>
  <!-- Navbar -->
  <div class="navbar">
    <h1 class="logo">
      <a href="<?php echo $basePath; ?>index.php">
        <img src="<?php echo $basePath; ?>img/ifinveste.png" alt="Logo IF-Investe" height="60">
      </a>
    </h1>

    <nav>
      <a href="<?php echo $basePath; ?>index.php">Início</a>
      <a href="<?php echo $basePath; ?>admin/login.php">Admin</a>
    </nav>
  </div>

  <!-- Hero Section (só aparece fora do admin) -->
  <?php if (strpos($_SERVER['PHP_SELF'], '/admin/') === false): ?>
    <div class="hero">
      <h2>Bem-vindo ao <span>IF-Investe</span></h2>
      <p>Educação financeira, investimentos e muito mais!</p>
      <a href="<?php echo $basePath; ?>index.php#posts" class="btn-hero">Explorar Posts ↓</a>
    </div>
  <?php endif; ?>
</header>

<main id="posts">
