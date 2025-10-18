<?php
// --- router.php (für php -S 127.0.0.1:8000 -t . router.php) ---

// DEV-Flag setzen (optional)
$_SERVER['WENG_DEV'] = $_SERVER['WENG_DEV'] ?? getenv('WENG_DEV') ?? '1';

// Angefragter Pfad (ohne Query)
$uri  = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$path = urldecode($uri);

// Absoluter Dateipfad relativ zum Projektroot
$full = __DIR__ . $path;

// 1) Statische Dateien direkt vom Built-in-Server ausliefern
if ($path !== '/' && is_file($full)) {
    return false;
}

// 2) Ordner mit index.php (z. B. /kontakt/ -> /kontakt/index.php)
if (is_dir($full) && is_file($full . '/index.php')) {
    require $full . '/index.php';
    exit;
}

// 3) „Pretty URL“ ohne .php (z. B. /impressum -> /impressum.php)
if (is_file($full . '.php')) {
    require $full . '.php';
    exit;
}

// 4) Root-Seite
if ($path === '/' && is_file(__DIR__ . '/index.php')) {
    require __DIR__ . '/index.php';
    exit;
}

// 5) 404 – optional eigene Seite verwenden
http_response_code(404);
$notFound = __DIR__ . '/404.php';
if (is_file($notFound)) {
    require $notFound;
} else {
    echo "<h1>404 Not Found</h1>";
    echo "<p>No route for " . htmlspecialchars($path, ENT_QUOTES, 'UTF-8') . "</p>";
}
