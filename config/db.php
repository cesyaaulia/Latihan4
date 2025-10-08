<?php
// config/db.php
// Edit DB credentials if necessary.
define('DB_HOST', '127.0.0.1');
define('DB_NAME', 'kasus04');
define('DB_USER', 'root');
define('DB_PASS', ''); // set your MySQL password if any
define('DB_CHARSET', 'utf8mb4');

function pdo_connect() {
    $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET;
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    try {
        return new PDO($dsn, DB_USER, DB_PASS, $options);
    } catch (PDOException $e) {
        die("Database connection failed: " . $e->getMessage());
    }
}
?>