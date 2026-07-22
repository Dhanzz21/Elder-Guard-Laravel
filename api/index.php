<?php

// Tampilkan semua error secara transparan untuk debugging jika masih ada kendala
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // --- SOLUSI READ-ONLY FILESYSTEM VERCEL ---
    // Arahkan storage dan bootstrap/cache secara paksa ke direktori /tmp yang bisa ditulisi
    $_ENV['APP_STORAGE'] = '/tmp/storage';
    
    // Buat direktori /tmp/storage jika belum ada saat fungsi lambda hidup
    if (!is_dir('/tmp/storage')) {
        mkdir('/tmp/storage', 0777, true);
        mkdir('/tmp/storage/framework', 0777, true);
        mkdir('/tmp/storage/framework/views', 0777, true);
        mkdir('/tmp/storage/framework/cache', 0777, true);
        mkdir('/tmp/storage/framework/sessions', 0777, true);
        mkdir('/tmp/storage/logs', 0777, true);
    }

    // Tangani direct path Vercel
    $_SERVER['SCRIPT_NAME'] = '/index.php';

    // Arahkan ke public/index.php Laravel
    require __DIR__ . '/../public/index.php';

} catch (\Throwable $e) {
    // Tangkap error fatal dan cetak langsung di layar browser
    echo "<h1>Terjadi Fatal Error pada Serverless:</h1>";
    echo "<pre>" . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "</pre>";
}