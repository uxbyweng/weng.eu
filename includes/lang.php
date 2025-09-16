<?php
// lang.php — unsichtbarer Sprachwechsel via POST + Cookie (PRG)
session_start();

$allowed = ['de','en'];

// Sprachwechsel verarbeiten
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lang']) && in_array($_POST['lang'], $allowed, true)) {
    $_SESSION['sprache'] = $_POST['lang'];
    setcookie('sprache', $_POST['lang'], [
        'expires'  => time() + 86400 * 30,
        'path'     => '/',
        'secure'   => !empty($_SERVER['HTTPS']),
        'httponly' => false,   // muss lesbar bleiben für client-seitige Checks, wenn gewünscht
        'samesite' => 'Lax',
    ]);

    // PRG: zurück auf die gleiche URL ohne Query-Parameter
    $redir = strtok($_SERVER['REQUEST_URI'], '?');
    header('Location: ' . $redir, true, 303);
    exit;
}

// Sprache bestimmen: Session → Cookie → Accept-Language → Default
if (isset($_SESSION['sprache']) && in_array($_SESSION['sprache'], $allowed, true)) {
    $sprache = $_SESSION['sprache'];
} elseif (!empty($_COOKIE['sprache']) && in_array($_COOKIE['sprache'], $allowed, true)) {
    $sprache = $_COOKIE['sprache'];
    $_SESSION['sprache'] = $sprache;
} else {
    $pref = substr(strtolower($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? ''), 0, 2);
    $sprache = in_array($pref, $allowed, true) ? $pref : 'de';
    $_SESSION['sprache'] = $sprache;
}

// Optional: Helper fürs <html lang="">
function htmlLang(): string { return $_SESSION['sprache'] ?? 'de'; }
