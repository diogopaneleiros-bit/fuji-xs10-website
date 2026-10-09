<?php
require_once __DIR__ . '/config.php';

function getDb(): SQLite3
{
    static $db = null;

    if ($db === null) {
        $db = new SQLite3(DB_PATH);
        $db->exec('PRAGMA foreign_keys = ON;');
    }

    return $db;
}

function initDatabase(): void
{
    $db = getDb();

    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT UNIQUE NOT NULL,
        email TEXT UNIQUE NOT NULL,
        name TEXT NOT NULL,
        password_hash TEXT NOT NULL,
        role TEXT DEFAULT 'user',
        country TEXT,
        avatar_path TEXT,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    );");

    $db->exec("CREATE TABLE IF NOT EXISTS login_logs (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        user_id INTEGER,
        ip_address TEXT,
        user_agent TEXT,
        logged_in_at TEXT DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY(user_id) REFERENCES users(id)
    );");

    $db->exec("CREATE TABLE IF NOT EXISTS survey_responses (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT,
        email TEXT,
        satisfaction TEXT,
        message TEXT,
        created_at TEXT DEFAULT CURRENT_TIMESTAMP
    );");

    $admin = $db->querySingle("SELECT username FROM users WHERE username = 'admin' LIMIT 1");
    if (!$admin) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $db->exec("INSERT INTO users (username, email, name, password_hash, role, country) VALUES ('admin', 'admin@fujixs10.com', 'Administrador', '$hash', 'admin', 'Portugal')");
    }
}

initDatabase();

function getCurrentUser(): ?array
{
    if (!isset($_SESSION['user_id'])) {
        return null;
    }

    $db = getDb();
    $result = $db->query("SELECT * FROM users WHERE id = " . (int) $_SESSION['user_id'] . " LIMIT 1");
    $user = $result->fetchArray(SQLITE3_ASSOC);
    return $user ?: null;
}

function ensureUserSession(): void
{
    if (!isset($_SESSION['user_id'])) {
        return;
    }

    $user = getCurrentUser();
    if (!$user) {
        session_destroy();
    }
}
