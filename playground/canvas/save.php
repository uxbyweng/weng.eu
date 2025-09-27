<?php
declare(strict_types=1);
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }

// Optionaler CSRF (nur wenn gesetzt)
if (!empty($_SESSION['canvas_csrf'])) {
  $csrf = $_POST['csrf'] ?? '';
  if (!hash_equals($_SESSION['canvas_csrf'], $csrf)) { http_response_code(403); echo 'Bad CSRF'; exit; }
}

// Rate-Limit (wie gehabt)
$RATE_WINDOW = 60;
$now = time();
if (isset($_SESSION['canvas_last_save'])) {
  $delta = $now - (int)$_SESSION['canvas_last_save'];
  if ($delta < $RATE_WINDOW) {
    http_response_code(429);
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode(['ok'=>false, 'error'=>'rate_limited', 'retry_after'=>$RATE_WINDOW - $delta]);
    exit;
  }
}

if (empty($_FILES['png']) || $_FILES['png']['error'] !== UPLOAD_ERR_OK) {
  http_response_code(400); echo 'No file'; exit;
}
if ($_FILES['png']['size'] > 10*1024*1024) { http_response_code(413); echo 'Too large'; exit; }

$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime  = $finfo->file($_FILES['png']['tmp_name']);
if ($mime !== 'image/png') { http_response_code(415); echo 'Not PNG'; exit; }

$base = __DIR__ . '/data';
if (!is_dir($base)) mkdir($base, 0775, true);

// --- optionaler Name → Slug ---
$raw = trim((string)($_POST['name'] ?? ''));
$title = $raw;
$slug = '';
if ($raw !== '') {
  $slug = preg_replace('~[^\pL0-9_-]+~u', '-', $raw);
  $slug = trim($slug, '-_');
  $slug = strtolower($slug);
  $slug = substr($slug, 0, 40);
  if ($slug === '') $slug = '';
}

// Timestamp ohne Bindestriche: YYYYMMDDHHMMSS
$stamp = date('YmdHis');

// Dateiname: 20250101120000[-slug].png
$baseName = $slug ? "{$stamp}-{$slug}" : $stamp;
$fileName = $baseName . '.png';
$target   = $base . '/' . $fileName;
$tmp      = $target . '.tmp';

// Kollisionen vermeiden
$idx = 1;
while (file_exists($target) || file_exists($tmp)) {
  $fileName = $baseName . '-' . $idx . '.png';
  $target   = $base . '/' . $fileName;
  $tmp      = $target . '.tmp';
  $idx++;
}

if (!move_uploaded_file($_FILES['png']['tmp_name'], $tmp)) { http_response_code(500); echo 'Move failed'; exit; }
if (!rename($tmp, $target)) { http_response_code(500); echo 'Rename failed'; exit; }

// „latest“ aktualisieren (neuer Aliasname)
@copy($target, $base . '/latest.png');

$_SESSION['canvas_last_save'] = $now;

header('Content-Type: application/json; charset=utf-8');
echo json_encode([
  'ok'    => true,
  'name'  => $fileName, // z. B. 20250927123456-mein-bild.png
  'ts'    => $stamp,
  'title' => $title ?: null
]);
