<?php
require __DIR__ . '/php/db.php';

if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    session_unset();
    session_destroy();
    header('Location: /login.php');
    exit;
}

$pageTitle = 'Login';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDbConnection();
    $action = $_POST['action'] ?? 'login';

    if ($action === 'register') {
        $name = trim($_POST['name'] ?? '');
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        if ($name === '' || $email === '' || strlen($password) < 6) {
            $error = 'Preenche todos os campos e usa pelo menos 6 caracteres na palavra-passe.';
        } else {
            $existing = $db->prepare('SELECT id FROM users WHERE email = :email');
            $existing->bindValue(':email', $email, SQLITE3_TEXT);
            $result = $existing->execute()->fetchArray(SQLITE3_ASSOC);

            if ($result) {
                $error = 'Este email já está registado.';
            } else {
                $hashed = password_hash($password, PASSWORD_DEFAULT);
                $insert = $db->prepare('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)');
                $insert->bindValue(':name', $name, SQLITE3_TEXT);
                $insert->bindValue(':email', $email, SQLITE3_TEXT);
                $insert->bindValue(':password', $hashed, SQLITE3_TEXT);
                $insert->execute();

                $userResult = $db->prepare('SELECT id, name, email, profile_image FROM users WHERE email = :email');
                $userResult->bindValue(':email', $email, SQLITE3_TEXT);
                $user = $userResult->execute()->fetchArray(SQLITE3_ASSOC);

                $_SESSION['user'] = $user;
                $track = $db->prepare('INSERT INTO login_activity (user_id, email, ip_address) VALUES (:user_id, :email, :ip)');
                $track->bindValue(':user_id', $user['id'], SQLITE3_INTEGER);
                $track->bindValue(':email', $email, SQLITE3_TEXT);
                $track->bindValue(':ip', $_SERVER['REMOTE_ADDR'] ?? 'unknown', SQLITE3_TEXT);
                $track->execute();

                header('Location: /conta.php');
                exit;
            }
        }
    }

    if ($action === 'login') {
        $email = strtolower(trim($_POST['email'] ?? ''));
        $password = $_POST['password'] ?? '';

        $stmt = $db->prepare('SELECT id, name, email, password, profile_image FROM users WHERE email = :email');
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $user = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $error = 'Credenciais inválidas. Tenta novamente.';
        } else {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'profile_image' => $user['profile_image'],
            ];

            $track = $db->prepare('INSERT INTO login_activity (user_id, email, ip_address) VALUES (:user_id, :email, :ip)');
            $track->bindValue(':user_id', $user['id'], SQLITE3_INTEGER);
            $track->bindValue(':email', $email, SQLITE3_TEXT);
            $track->bindValue(':ip', $_SERVER['REMOTE_ADDR'] ?? 'unknown', SQLITE3_TEXT);
            $track->execute();

            header('Location: /conta.php');
            exit;
        }
    }
}

require __DIR__ . '/partials/header.php';
?>

<main class="login-shell">
    <div class="auth-card">
        <div class="auth-tabs">
            <button type="button" class="auth-tab active" data-target="login">Entrar</button>
            <button type="button" class="auth-tab" data-target="register">Registar</button>
        </div>

        <?php if (!empty($error)): ?>
            <div class="notice error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="auth-segment">
            <form class="auth-form active" data-form="login" method="post">
                <input type="hidden" name="action" value="login">
                <div class="form-grid">
                    <div class="field full">
                        <label for="login-email">Email</label>
                        <input id="login-email" type="email" name="email" placeholder="nome@email.com" required>
                    </div>
                    <div class="field full">
                        <label for="login-password">Palavra-passe</label>
                        <input id="login-password" type="password" name="password" placeholder="••••••••" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Entrar</button>
                </div>
            </form>

            <form class="auth-form" data-form="register" method="post">
                <input type="hidden" name="action" value="register">
                <div class="form-grid">
                    <div class="field full">
                        <label for="register-name">Nome</label>
                        <input id="register-name" type="text" name="name" placeholder="O teu nome" required>
                    </div>
                    <div class="field full">
                        <label for="register-email">Email</label>
                        <input id="register-email" type="email" name="email" placeholder="nome@email.com" required>
                    </div>
                    <div class="field full">
                        <label for="register-password">Palavra-passe</label>
                        <input id="register-password" type="password" name="password" placeholder="Mínimo 6 caracteres" required>
                    </div>
                </div>
                <div class="form-actions">
                    <button class="btn btn-primary" type="submit">Criar conta</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
