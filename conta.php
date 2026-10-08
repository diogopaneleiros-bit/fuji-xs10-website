<?php
require __DIR__ . '/php/db.php';

if (!isset($_SESSION['user'])) {
    header('Location: /login.php');
    exit;
}

$pageTitle = 'A minha conta';
$db = getDbConnection();
$user = $_SESSION['user'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = strtolower(trim($_POST['email'] ?? ''));
    $bio = trim($_POST['bio'] ?? '');

    if ($name === '' || $email === '') {
        $error = 'Nome e email são obrigatórios.';
    } else {
        $profileImage = $user['profile_image'] ?? '';

        if (!empty($_FILES['profile_image']['name'])) {
            $uploadDir = __DIR__ . '/uploads';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $extension = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
            $filename = 'profile_' . $user['id'] . '.' . ($extension ?: 'png');
            $target = $uploadDir . '/' . $filename;

            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $target)) {
                $profileImage = '/uploads/' . $filename;
            }
        }

        $stmt = $db->prepare('UPDATE users SET name = :name, email = :email, profile_image = :profile_image WHERE id = :id');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':profile_image', $profileImage, SQLITE3_TEXT);
        $stmt->bindValue(':id', $user['id'], SQLITE3_INTEGER);
        $stmt->execute();

        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $name,
            'email' => $email,
            'profile_image' => $profileImage,
        ];

        $message = 'Os teus dados foram atualizados com sucesso.';
    }
}

require __DIR__ . '/partials/header.php';
?>

<main class="section">
    <div class="container account-layout">
        <aside class="account-sidebar">
            <img class="account-avatar" src="<?= htmlspecialchars($_SESSION['user']['profile_image'] ?: '/assets/default-avatar.svg') ?>" alt="Avatar da conta">
            <h3><?= htmlspecialchars($_SESSION['user']['name']) ?></h3>
            <p><?= htmlspecialchars($_SESSION['user']['email']) ?></p>
            <div class="form-actions">
                <a href="/login.php?action=logout" class="btn btn-secondary small-btn">Terminar sessão</a>
            </div>
        </aside>

        <div class="account-panel">
            <h2 class="section-title">Personalizar conta</h2>

            <?php if (!empty($message)): ?>
                <div class="notice"><?= htmlspecialchars($message) ?></div>
            <?php elseif (!empty($error)): ?>
                <div class="notice error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="post" enctype="multipart/form-data" class="form-wrap">
                <div class="form-grid">
                    <div class="field">
                        <label for="name">Nome</label>
                        <input id="name" type="text" name="name" value="<?= htmlspecialchars($_SESSION['user']['name']) ?>">
                    </div>
                    <div class="field">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>">
                    </div>
                    <div class="field full">
                        <label for="profile_image">Foto de perfil</label>
                        <input id="profile_image" type="file" name="profile_image" accept="image/*">
                    </div>
                    <div class="field full">
                        <label for="bio">Biografia</label>
                        <textarea id="bio" name="bio" rows="5" placeholder="Escreve algo sobre ti..."></textarea>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Guardar alterações</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php require __DIR__ . '/partials/footer.php'; ?>
