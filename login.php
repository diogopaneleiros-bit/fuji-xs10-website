<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $db = getDb();
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username LIMIT 1');
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        header('Location: account.php');
        exit;
    }

    $error = 'Credenciais inválidas.';
}
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Fuji X-S10</title>
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
                <a class="login-btn white" href="index.html">Voltar</a>
            </div>
        </div>
    </header>

    <main class="main-content login-page">
        <div class="login-box">
            <h2>Entrar na conta</h2>
            <?php if (isset($error)): ?>
                <div class="alert error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            <form method="post" action="login.php" class="login-form">
                <label>
                    Nome de utilizador
                    <input type="text" name="username" required>
                </label>
                <label>
                    Palavra-passe
                    <input type="password" name="password" required>
                </label>
                <button type="submit" class="primary-btn">Entrar</button>
            </form>
            <div class="login-meta">
                <p>Utilizador admin: admin</p>
                <p>Senha admin: admin123</p>
            </div>
        </div>
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
</body>
</html>
