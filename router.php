<?php
$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
$file = __DIR__ . $path;

// existierende Dateien (CSS/JS/Images/PHP) direkt ausliefern
if ($path !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// ansonsten immer index.php bootstrappen
require __DIR__ . '/index.php';
