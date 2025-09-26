<?php
declare(strict_types=1);
$path = __DIR__ . '/data/board.png';
if (!is_file($path)) {
  // Leeres weißes PNG dynamisch erzeugen (900x675 ~ 4:3)
  $w = 1200; $h = 900;
  if (class_exists('Imagick')) {
    $im = new Imagick(); $im->newImage($w,$h,'white','png'); 
    header('Content-Type: image/png'); echo $im; exit;
  } else {
    // Fallback: 1x1 white png
    header('Content-Type: image/png');
    echo base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAukB9W2m3qUAAAAASUVORK5CYII=');
    exit;
  }
}
header('Content-Type: image/png');
header('Cache-Control: no-store, must-revalidate');
readfile($path);
