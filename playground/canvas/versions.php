<?php
declare(strict_types=1);
$base = __DIR__ . '/data';

// Alle PNGs holen und nach Regex filtern (latest.png ignorieren)
$all = glob($base . '/*.png') ?: [];
$files = [];
foreach ($all as $f) {
  $name = basename($f);
  if (preg_match('/^\d{14}(?:-[a-z0-9_-]+)?(?:-\d+)?\.png$/', $name)) {
    $files[] = $f;
  }
}

// Nach Name DESC sortieren (lexikografisch = chronologisch)
usort($files, fn($a,$b) => strcmp(basename($b), basename($a)));

$out = [];
foreach ($files as $f) {
  $name = basename($f);
  $ts = null; $title = null;

  if (preg_match('/^(\d{4})(\d{2})(\d{2})(\d{2})(\d{2})(\d{2})(?:-([a-z0-9_-]+))?/', $name, $m)) {
    $ts = sprintf('%s-%s-%s %s:%s:%s', $m[1],$m[2],$m[3],$m[4],$m[5],$m[6]);
    if (!empty($m[7])) {
      $title = str_replace(['-', '_'], ' ', $m[7]);
    }
  } else {
    $ts = date('Y-m-d H:i:s', @filemtime($f) ?: time());
  }

  $out[] = [
    'name'  => $name,
    'url'   => '/playground/canvas/current.php?name=' . rawurlencode($name),
    'ts'    => $ts,
    'title' => $title
  ];
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($out);
