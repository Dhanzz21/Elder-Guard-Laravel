<?php

// Tampilkan error transparan untuk debugging jika masih ada kendala
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // --- SOLUSI READ-ONLY FILESYSTEM VERCEL ---
    // Definisikan path penyimpanan ke /tmp karena vercel bersifat read-only
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

    // Muat file utama Laravel
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Bind instance application untuk menggunakan /tmp sebagai storage path
    if (method_exists($app, 'useStoragePath')) {
        $app->useStoragePath('/tmp/storage');
    }

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    );

    $response->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    echo "<h1>Terjadi Fatal Error pada Serverless:</h1>";
    echo "<pre>" . $e->getMessage() . "\n\n" . $e->getTraceAsString() . "</pre>";
}