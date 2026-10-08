<?php
require_once __DIR__ . '/../php/db.php';
$pageTitle = $pageTitle ?? 'Fuji X-S10 Guide';
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="Guia completo da Fuji X-S10: câmera, lentes, acessórios, suporte, onde comprar e tudo sobre a linha X-Trans da Fujifilm.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Orbitron:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <header class="site-header">
        <div class="container header-inner">
            <a href="/index.php" class="brand">FUJI X-S10 GUIDE</a>

            <nav class="main-nav" aria-label="Menu principal">
                <a href="/index.php">Início</a>
                <a href="/camera.php">Câmera</a>
                <a href="/lentes.php">Lentes</a>
                <a href="/acessorios.php">Acessórios</a>
                <a href="/suporte.php">Suporte</a>
                <a href="/onde-comprar.php">Onde Comprar</a>
            </nav>

            <?php if ($user): ?>
                <div class="profile-wrap">
                    <button class="profile-toggle" type="button" aria-label="Abrir conta">
                        <img src="<?= htmlspecialchars($user['profile_image'] ?: '/assets/default-avatar.svg') ?>" alt="Perfil">
                    </button>
                    <div class="profile-menu">
                        <a href="/conta.php">A minha conta</a>
                        <a href="/dashboard.php">Questionários</a>
                        <a href="/login.php?action=logout">Terminar sessão</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="/login.php" class="btn btn-light">Login</a>
            <?php endif; ?>
        </div>
    </header>
