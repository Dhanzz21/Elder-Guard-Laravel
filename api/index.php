<?php

// Tampilkan semua error PHP secara transparan di browser
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // Tangani direct path Vercel
    $_SERVER['SCRIPT_NAME'] = '/index.php';

    // Arahkan ke public/index.php Laravel
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    // Tangkap error fatal dan cetak langsung di layar
    echo "<h1>Terjadi Fatal Error pada Serverless:</h1>";
    echo "<pre>" . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "</pre>";
}