<?php
// Database connection (supports DATABASE_URL or DB_* env)
$databaseUrl = getenv('DATABASE_URL');

if ($databaseUrl) {
    $parts = parse_url($databaseUrl);
    $DB_HOST = $parts['host'] ?? 'localhost';
    $DB_PORT = $parts['port'] ?? 5432;
    $DB_USER = $parts['user'] ?? 'postgres';
    $DB_PASS = $parts['pass'] ?? '';
    $DB_NAME = ltrim($parts['path'] ?? '/postgres', '/');
} else {
    $DB_HOST = getenv('DB_HOST') ?: 'localhost';
    $DB_PORT = getenv('DB_PORT') ?: 5432;
    $DB_USER = getenv('DB_USER') ?: 'postgres';
    $DB_PASS = getenv('DB_PASS') ?: '';
    $DB_NAME = getenv('DB_NAME') ?: 'cbt_db';
}

try {
    $dsn = "pgsql:host={$DB_HOST};port={$DB_PORT};dbname={$DB_NAME};";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (Exception $e) {
    die('DB connection failed: ' . $e->getMessage());
}

// Auto-run migrations (idempotent)
$migrationsFile = __DIR__ . '/../migrations/schema.sql';
if (file_exists($migrationsFile)) {
    $migrations = file_get_contents($migrationsFile);
    try { $pdo->exec($migrations); } catch (Exception $e) { /* ignore if already run */ }
}

session_start();

function require_login() {
    if (empty($_SESSION['user'])) {
        header('Location: /login.php');
        exit;
    }
}

function require_admin() {
    if (empty($_SESSION['user']) || ($_SESSION['user']['role'] ?? '') !== 'admin') {
        header('Location: /login.php');
        exit;
    }
}

// Seed sample admin and user if they don't exist
try {
    // admin
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute(['admin@example.com']);
    if (!$stmt->fetch()) {
        $hash = password_hash('Admin@123', PASSWORD_DEFAULT);
        $pdo->prepare('INSERT INTO users (name,email,phone,password,role,status) VALUES (?,?,?,?,?,?)')
            ->execute(['Admin User','admin@example.com','9999999999',$hash,'admin','active']);
    }
    // sample user
    $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ?');
    $stmt->execute(['user@example.com']);
    if (!$stmt->fetch()) {
        $hash = password_hash('User@123', PASSWORD_DEFAULT);
        $pdo->prepare('INSERT INTO users (name,email,phone,password,role,status) VALUES (?,?,?,?,?,?)')
            ->execute(['Test User','user@example.com','8888888888',$hash,'user','active']);
    }
} catch (Exception $e) {
    // ignore seeding errors
}
