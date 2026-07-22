<?php

// Tangani direct path untuk lingkungan serverless Vercel
$_SERVER['SCRIPT_NAME'] = '/index.php';

// Arahkan langsung ke public/index.php Laravel
require __DIR__ . '/../public/index.php';