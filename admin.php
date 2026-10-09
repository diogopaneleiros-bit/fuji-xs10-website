<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$currentUser = getCurrentUser();
if (!$currentUser || $currentUser['role'] !== 'admin') {
    header('Location: account.php');
    exit;
}

$db = getDb();
$surveyRows = $db->query('SELECT * FROM survey_responses ORDER BY created_at DESC');
$loginCount = $db->querySingle('SELECT COUNT(*) FROM login_logs');
$userCount = $db->querySingle('SELECT COUNT(*) FROM users');
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Questionários</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@700;600;500&family=Montserrat:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
    <header class="header">
        <div class="container-header">
            <div class="logo"><h1>FUJI X-S10</h1></div>
            <nav class="nav-menu">
                <a class="nav-btn" href="index.html">Início</a>
                <a class="nav-btn" href="account.php">Conta</a>
            </nav>
            <div class="login-section">
                <a class="login-btn white" href="logout.php">Sair</a>
            </div>
        </div>
    </header>

    <main class="main-content admin-page">
        <section class="stats-grid">
            <div class="stat-box"><h3><?= (int) $userCount ?></h3><p>Utilizadores</p></div>
            <div class="stat-box"><h3><?= (int) $loginCount ?></h3><p>Logins</p></div>
            <div class="stat-box"><h3><?= $db->querySingle('SELECT COUNT(*) FROM survey_responses') ?></h3><p>Respostas</p></div>
        </section>

        <section class="admin-table-wrap">
            <h2>Respostas de satisfação</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Satisfação</th>
                        <th>Mensagem</th>
                        <th>Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $surveyRows->fetchArray(SQLITE3_ASSOC)): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['satisfaction']) ?></td>
                            <td><?= htmlspecialchars($row['message']) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
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
</body>
</html>
