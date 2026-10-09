<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

$db = getDb();
ensureUserSession();

$currentUser = getCurrentUser();
if (!$currentUser) {
    header('Location: login.php');
    exit;
}

$avatar = $currentUser['avatar_path'] ? $currentUser['avatar_path'] : 'https://ui-avatars.com/api/?name=' . urlencode($currentUser['name']) . '&background=0f172a&color=fff';
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conta - Fuji X-S10</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;600;500&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container-header">
            <div class="logo"><h1>FUJI X-S10</h1></div>
            <nav class="nav-menu">
                <a class="nav-btn" href="index.html">Início</a>
                <a class="nav-btn" href="camera.html">Câmera</a>
                <a class="nav-btn" href="lentes.html">Lentes</a>
                <a class="nav-btn" href="acessorios.html">Acessórios</a>
                <a class="nav-btn" href="suporte.html">Suporte</a>
                <a class="nav-btn" href="onde-comprar.html">Onde Comprar</a>
            </nav>
            <div class="login-section">
                <a class="login-btn white" href="logout.php">Sair</a>
            </div>
        </div>
    </header>

    <main class="main-content account-page">
        <section class="account-shell">
            <aside class="account-sidebar">
                <div class="avatar-card">
                    <div class="avatar-box">
                        <img src="<?= htmlspecialchars($avatar) ?>" alt="Avatar do utilizador">
                    </div>
                    <h2><?= htmlspecialchars($currentUser['name']) ?></h2>
                    <p><?= htmlspecialchars($currentUser['email']) ?></p>
                    <div class="account-actions">
                        <button class="mini-btn" id="toggleProfileMenu">Personalizar conta</button>
                    </div>
                </div>
            </aside>

            <section class="account-main">
                <div class="profile-panel" id="profileMenu">
                    <h3>Informações da Conta</h3>
                    <form action="update_profile.php" method="post" enctype="multipart/form-data" class="profile-form">
                        <label>
                            Nome
                            <input type="text" name="name" value="<?= htmlspecialchars($currentUser['name']) ?>" required>
                        </label>
                        <label>
                            Email
                            <input type="email" name="email" value="<?= htmlspecialchars($currentUser['email']) ?>" required>
                        </label>
                        <label>
                            País
                            <input type="text" name="country" value="<?= htmlspecialchars($currentUser['country']) ?>">
                        </label>
                        <label>
                            Fotografia
                            <input type="file" name="avatar" accept="image/*">
                        </label>
                        <button type="submit" class="primary-btn">Guardar alterações</button>
                    </form>
                </div>

                <div class="account-summary">
                    <div class="summary-card">
                        <h4>Resumo</h4>
                        <p><strong>Utilizador:</strong> <?= htmlspecialchars($currentUser['username']) ?></p>
                        <p><strong>Tipo:</strong> <?= htmlspecialchars($currentUser['role']) ?></p>
                        <p><strong>País:</strong> <?= htmlspecialchars($currentUser['country'] ?: 'Não definido') ?></p>
                    </div>
                    <div class="summary-card">
                        <h4>Preferências</h4>
                        <p>Estilo de fotografia: <strong>Retrato / Viagem</strong></p>
                        <p>Objetivo favorito: <strong>XF 18-55mm</strong></p>
                        <p>Interesse: <strong>Conteúdo criativo</strong></p>
                    </div>
                </div>
            </section>
        </section>
    </main>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-section"><h4>Sobre</h4><p>Website dedicado à Fuji X-S10</p></div>
            <div class="footer-section"><h4>Contacto</h4><p>Email: info@fujixs10.com</p><p>Telefone: +351 210 000 000</p></div>
            <div class="footer-section"><h4>Redes</h4><p><a href="#">Instagram</a> | <a href="#">YouTube</a> | <a href="#">X</a></p></div>
            <div class="footer-section"><h4>Legal</h4><p><a href="#">Privacidade</a> | <a href="#">Termos</a></p></div>
        </div>
        <div class="footer-bottom"><p>© 2024 Fuji X-S10</p></div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
