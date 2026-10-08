<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function getDbConnection()
{
    static $db = null;

    if ($db !== null) {
        return $db;
    }

    $directory = __DIR__ . '/../data';
    if (!is_dir($directory)) {
        mkdir($directory, 0777, true);
    }

    $db = new SQLite3($directory . '/fuji_xs10.db');
    $db->exec('PRAGMA foreign_keys = ON;');
    $db->exec(
        "CREATE TABLE IF NOT EXISTS users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT NOT NULL,
            email TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL,
            profile_image TEXT DEFAULT '',
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )"
    );

    $db->exec(
        "CREATE TABLE IF NOT EXISTS login_activity (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            user_id INTEGER,
            email TEXT,
            logged_in_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            ip_address TEXT
        )"
    );

    $db->exec(
        "CREATE TABLE IF NOT EXISTS survey_responses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            name TEXT,
            email TEXT,
            experience TEXT,
            product TEXT,
            rating INTEGER,
            message TEXT,
            submitted_at DATETIME DEFAULT CURRENT_TIMESTAMP
        )"
    );

    return $db;
}
