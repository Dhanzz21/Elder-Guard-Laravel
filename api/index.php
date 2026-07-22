<?php

// Tampilkan error transparan untuk debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

try {
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

    $app = require_once __DIR__ . '/../bootstrap/app.php';

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
    // Cetak detail error asli Laravel ke browser agar kita tahu file mana yang bermasalah
    header("HTTP/1.1 500 Internal Server Error");
    echo "<h1>Pesan Error Asli Laravel:</h1>";
    echo "<p><b>Pesan:</b> " . htmlspecialchars($e->getMessage()) . "</p>";
    echo "<p><b>File:</b> " . htmlspecialchars($e->getFile()) . " pada baris <b>" . $e->getLine() . "</b></p>";
    echo "<h3>Stack Trace:</h3>";
    echo "<pre style='background: #f4f4f4; padding: 15px; border-radius: 5px;'>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
}