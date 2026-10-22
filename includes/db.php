<?php
/* ==========================================================================
   DB.PHP — shared config + MySQL connection for contact.php and messages.php.
   ========================================================================== */

/** Site config from includes/config.php (see config.sample.php). */
function app_config(): array
{
    static $config = null;
    if ($config === null) {
        $file = __DIR__ . '/config.php';
        if (!is_file($file)) {
            throw new RuntimeException('Missing includes/config.php — copy it from config.sample.php.');
        }
        $config = require $file;
    }
    return $config;
}

/**
 * Lazily opened PDO connection. Creates the contact_messages table the first
 * time, so a fresh database needs no manual SQL.
 */
function db(): PDO
{
    static $pdo = null;
    if ($pdo !== null) {
        return $pdo;
    }

    $c = app_config()['db'];
    $pdo = new PDO(
        "mysql:host={$c['host']};dbname={$c['name']};charset=utf8mb4",
        $c['user'],
        $c['pass'],
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );

    $pdo->exec("CREATE TABLE IF NOT EXISTS contact_messages (
        id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        name       VARCHAR(100) NOT NULL,
        email      VARCHAR(254) NOT NULL,
        subject    VARCHAR(150) NOT NULL DEFAULT '',
        message    TEXT         NOT NULL,
        ip         VARCHAR(45)  NULL,
        user_agent VARCHAR(255) NULL,
        is_read    TINYINT(1)   NOT NULL DEFAULT 0,
        created_at DATETIME     NOT NULL DEFAULT CURRENT_TIMESTAMP,
        INDEX idx_created (created_at)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");

    return $pdo;
}
