<?php
header('X-Content-Type-Options: nosniff');
header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');
ini_set('display_errors', '0');
// error_reporting(E_ALL);

/* Session & Helpers laden */
define('NEED_SESSION', true);
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';

/* Env laden (sicherer Pfad über Document-Root) */
$envPath = $_SERVER['DOCUMENT_ROOT'] . '/includes/env.php';
if (is_file($envPath)) {
    require_once $envPath;
} else {
    function env($k, $d = null)
    {
        return $d;
    }
}

/* JSON-Antwort Helper */
function out(array $data)
{
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

/* Nur POST zulassen */
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Ungültige Anfragemethode.']);
}

/* Einheitliche Form-ID wie auf der Seite */
$formId = 'contact';

/* CSRF prüfen */
if (!verify_csrf($_POST['csrf'] ?? null, $formId)) {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Ungültiges Formular-Token. Bitte neu laden.']);
}

/* Honeypot prüfen (Silent-OK bei Bot) */
if (is_honeypot_triggered($_POST, $formId)) {
    out(['ok' => true, 'type' => 'success', 'message' => 'OK']);
}

/* Zweite Bot-Falle: unsichtbare Checkbox (Menschen sehen und füllen sie nicht) */
if (isset($_POST['terms'])) {
    out(['ok' => true, 'type' => 'success', 'message' => 'OK']);
}

/* Lock lösen – ab hier keine Session nötig */
session_write_close();

/* === Felder holen === */
$name       = trim($_POST['name']    ?? '');
$email      = trim($_POST['email']   ?? '');
$message    = trim($_POST['message'] ?? '');

/* === Validierung === */
$fieldErrors = [];

if ($name === '') {
    $fieldErrors['name'] = 'Bitte einen Namen eingeben.';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fieldErrors['email'] = 'Bitte eine gültige E-Mail-Adresse eingeben.';
}
if ($message === '') {
    $fieldErrors['message'] = 'Bitte eine Nachricht hinterlassen.';
} else {
    if (preg_match('/https?:\/\/\S+/i', $message)) {
        $fieldErrors['message'] = 'Links sind in der Nachricht nicht erlaubt.';
    } elseif (count(array_filter(preg_split('/\s+/', $message))) < 3) {
        $fieldErrors['message'] = 'Bitte mindestens 3 Wörter schreiben.';
    }
}

/* Längenbegrenzung (gegen Missbrauch und sehr große Mails) */
if (!isset($fieldErrors['name']) && mb_strlen($name) > 100) {
    $fieldErrors['name'] = 'Bitte höchstens 100 Zeichen.';
}
if (!isset($fieldErrors['email']) && strlen($email) > 254) {
    $fieldErrors['email'] = 'Bitte höchstens 254 Zeichen.';
}
if (!isset($fieldErrors['message']) && mb_strlen($message) > 5000) {
    $fieldErrors['message'] = 'Bitte höchstens 5000 Zeichen.';
}

if ($fieldErrors) {
    out([
        'ok'          => false,
        'type'        => 'danger',
        'message'     => 'Bitte die Eingaben überprüfen.',
        'fieldErrors' => $fieldErrors
    ]);
}

/* Begrenzung pro IP-Adresse: höchstens 5 Anfragen pro Stunde */
if (!rate_limit_ok('contact', 5, 3600)) {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Zu viele Anfragen. Bitte versuchen Sie es später noch einmal.']);
}

/* === Erfolgstext === */
$successHtml = 'Hallo ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ',<br><br>'
    . 'Vielen Dank für die Nachricht! Die Nachricht wurde erfolgreich übermittelt. '
    . 'Ich werde mich in Kürze melden.<br><br>'
    . 'Viele Grüße,<br>Karsten Weng';

/* === Mailversand === */
$to       = env('MAIL_TO', 'info@weng.eu');
$from     = env('MAIL_FROM', 'info@weng.eu');
$subject  = 'Anfrage ' . date('Ymd\THi');
$body     = "Gesendet über weng.eu/kontakt/\r\n\r\n"
    . "Name:    {$name}\r\n"
    . "Email:   {$email}\r\n\r\n"
    . "Nachricht:\r\n{$message}\r\n";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "From: {$from}\r\n";
$headers .= "Reply-To: {$email}\r\n";

$sent = @mail($to, $subject, $body, $headers);

/* Keine Bestätigungsmail an die eingegebene Adresse: sonst ließe sich über das Formular Mail an Dritte auslösen. Die Erfolgsmeldung erscheint auf der Seite. */

if ($sent) {
    out(['ok' => true, 'type' => 'success', 'message' => $successHtml]);
} else {
    out(['ok' => false, 'type' => 'danger', 'message' => 'E-Mail konnte nicht gesendet werden. Bitte später erneut versuchen.']);
}
