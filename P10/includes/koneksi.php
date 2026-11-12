<?php

$config = require __DIR__ . '/config.php';

$sslmode = getenv('DB_SSLMODE') ?: 'require';

try {
    $dsn = "pgsql:host={$config['db_host']};"
         . "port={$config['db_port']};"
         . "dbname={$config['db_name']};"
         . "sslmode={$sslmode};"
         . "connect_timeout=5";

    $pdo = new PDO(
        $dsn,
        $config['db_user'],
        $config['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {
    error_log('Database Error: ' . $e->getMessage());
    http_response_code(500);
    exit('Koneksi database tidak tersedia. Silahkan coba kembali.');
}