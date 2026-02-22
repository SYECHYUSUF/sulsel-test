<?php

// Perbaiki URI agar tidak double /api atau mengandung /public
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, '/api/api/') === 0) {
    $_SERVER['REQUEST_URI'] = str_replace('/api/api/', '/api/', $uri);
}

// Load index Laravel dari folder public
require __DIR__ . '/../public/index.php';