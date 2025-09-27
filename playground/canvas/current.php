<?php
declare(strict_types=1);
$base = __DIR__ . '/data';

$name = $_GET['name'] ?? '';
if ($name !== '') {
  // Erlaubt: 20250101120000.png oder 20250101120000-mein-bild.png (+ evtl. -1 etc.)
  if (!preg_match('/^\d{14}(?:-[a-z0-9_-]+)?(?:-\d+)?\.png$/', $name)) {
    http_response_code(400); exit('Bad name');
  }
  $path = $base . '/' . $name;
} else {
  // neuer Latest-Alias
  $path = $base . '/latest.png';
}

header('Cache-Control: no-store, must-revalidate');
header('Content-Type: image/png');

if (is_file($path)) {
  readfile($path);
} else {
  // 1×1 weiß
  echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAukB9W2m3qUAAAAASUVORK5CYII=');
}
