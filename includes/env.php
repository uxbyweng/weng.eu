<?php
function env(string $key, $default=null) {
  static $map, $loaded=false;
  if (!$loaded) {
    $map = [];
    $file = __DIR__ . '/../.env';
    if (is_file($file)) {
      foreach (file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') continue;
        [$k, $v] = array_pad(explode('=', $line, 2), 2, '');
        $map[trim($k)] = trim($v);
      }
    }
    $loaded = true;
  }
  return $map[$key] ?? $default;
}
