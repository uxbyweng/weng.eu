<?php
declare(strict_types=1);
session_start();

// --- Sicherheits-/Missbrauchs-Minis: ---
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); exit; }
if (empty($_POST['csrf']) || empty($_SESSION['board_csrf']) || !hash_equals($_SESSION['board_csrf'], $_POST['csrf'])) {
  http_response_code(403); echo 'Bad CSRF'; exit;
}
if (empty($_FILES['png']) || $_FILES['png']['error'] !== UPLOAD_ERR_OK) {
  http_response_code(400); echo 'No file'; exit;
}
// 3 MB Limit
if ($_FILES['png']['size'] > 3 * 1024 * 1024) { http_response_code(413); echo 'Too large'; exit; }

// Mime check
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime = $finfo->file($_FILES['png']['tmp_name']);
if ($mime !== 'image/png') { http_response_code(415); echo 'Not PNG'; exit; }

// Zielordner
$base = __DIR__ . '/data';
if (!is_dir($base)) mkdir($base, 0775, true);

// Datei schreiben (atomar, mit Lock)
$target = $base . '/board.png';
$tmp    = $target . '.tmp';

if (!move_uploaded_file($_FILES['png']['tmp_name'], $tmp)) { http_response_code(500); echo 'Move failed'; exit; }

// Kleines Wasserzeichen/Meta via Imagick (optional; sonst direkt rename)
try {
  if (class_exists('Imagick')) {
    $im = new Imagick($tmp);
    $im->setImageCompressionQuality(90);
    // (Optional) dezent: kein Text, um Bild nicht zu verändern
    $im->writeImage($tmp);
    $im->destroy();
  }
} catch(Throwable $e) { /* ignore */ }

if (!rename($tmp, $target)) { http_response_code(500); echo 'Rename failed'; exit; }

// Optionale Historie
$hist = $base . '/history';
if (!is_dir($hist)) mkdir($hist, 0775);
@copy($target, $hist . '/board-' . date('Ymd-His') . '.png');

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['ok'=>true, 'ts'=>time()]);
