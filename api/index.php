<?php

// Tampilkan semua error untuk debugging secara transparan
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
    // 1. Tentukan direktori penyimpanan sementara di Vercel (/tmp)
    $_ENV['APP_STORAGE'] = '/tmp/storage';

    if (!is_dir('/tmp/storage')) {
        mkdir('/tmp/storage', 0777, true);
        mkdir('/tmp/storage/framework', 0777, true);
        mkdir('/tmp/storage/framework/views', 0777, true);
        mkdir('/tmp/storage/framework/cache', 0777, true);
        mkdir('/tmp/storage/framework/sessions', 0777, true);
        mkdir('/tmp/storage/logs', 0777, true);
    }

    $_SERVER['SCRIPT_NAME'] = '/index.php';

    // 2. Muat inti aplikasi Laravel
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    if (method_exists($app, 'useStoragePath')) {
        $app->useStoragePath('/tmp/storage');
    }

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

    $request = Illuminate\Http\Request::capture();

    // 3. Tangkap error secara langsung saat Kernel menangani request
    try {
        $response = $kernel->handle($request);
        $response->send();
        $kernel->terminate($request, $response);
    } catch (\Throwable $innerException) {
        // Cetak error asli Laravel langsung di layar browser
        header("HTTP/1.1 500 Internal Server Error");
        echo "<h1 style='color: red;'>💥 Laravel Kernel Exception:</h1>";
        echo "<p><b>Pesan:</b> " . htmlspecialchars($innerException->getMessage()) . "</p>";
        echo "<p><b>File:</b> " . htmlspecialchars($innerException->getFile()) . " pada baris <b>" . $innerException->getLine() . "</b></p>";
        echo "<h3>Stack Trace:</h3>";
        echo "<pre style='background: #f4f4f4; padding: 15px; border-radius: 5px; overflow-x: auto;'>" . htmlspecialchars($innerException->getTraceAsString()) . "</pre>";
    }

} catch (\Throwable $e) {
    // Cetak error bootstrapping jika terjadi sebelum kernel dimuat
    header("HTTP/1.1 500 Internal Server Error");
    echo "<h1 style='color: red;'>💥 Fatal Bootstrapping Error:</h1>";
    echo "<p><b>Pesan:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " pada baris <b>" . $e->getLine() . "</b></p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre style='background: #f4f4f4; padding: 15px; border-radius: 5px; overflow-x: auto;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}