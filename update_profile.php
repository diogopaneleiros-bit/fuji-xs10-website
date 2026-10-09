<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/db.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = getCurrentUser();
if (!$user) {
    header('Location: logout.php');
    exit;
}

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/uploads/avatars';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $filename = 'avatar_' . $user['id'] . '_' . time() . '.' . $ext;
    $target = $uploadDir . '/' . $filename;

    if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target)) {
        $db = getDb();
        $relative = 'uploads/avatars/' . $filename;
        $name = trim($_POST['name'] ?? $user['name']);
        $email = trim($_POST['email'] ?? $user['email']);
        $country = trim($_POST['country'] ?? $user['country']);

        $stmt = $db->prepare('UPDATE users SET name = :name, email = :email, country = :country, avatar_path = :avatar WHERE id = :id');
        $stmt->bindValue(':name', $name, SQLITE3_TEXT);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $stmt->bindValue(':country', $country, SQLITE3_TEXT);
        $stmt->bindValue(':avatar', $relative, SQLITE3_TEXT);
        $stmt->bindValue(':id', $user['id'], SQLITE3_INTEGER);
        $stmt->execute();

        header('Location: account.php?updated=1');
        exit;
    }
}

$name = trim($_POST['name'] ?? $user['name']);
$email = trim($_POST['email'] ?? $user['email']);
$country = trim($_POST['country'] ?? $user['country']);

dbUpdateUser($user['id'], $name, $email, $country);
header('Location: account.php?updated=1');
exit;

function dbUpdateUser(int $id, string $name, string $email, string $country): void
{
    $db = getDb();
    $stmt = $db->prepare('UPDATE users SET name = :name, email = :email, country = :country WHERE id = :id');
    $stmt->bindValue(':name', $name, SQLITE3_TEXT);
    $stmt->bindValue(':email', $email, SQLITE3_TEXT);
    $stmt->bindValue(':country', $country, SQLITE3_TEXT);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
}
