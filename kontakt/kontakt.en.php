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
    // Fallback, falls env() nicht vorhanden ist
    function env($k, $default = null)
    {
        return $default;
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
    out(['ok' => false, 'type' => 'danger', 'message' => 'Invalid request method.']);
}

/* Einheitliche Form-ID wie auf der Seite */
$formId = 'contact';

/* CSRF prüfen */
if (!verify_csrf($_POST['csrf'] ?? null, $formId)) {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Invalid form token. Please reload.']);
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
    $fieldErrors['name'] = 'Please enter a name.';
}
if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $fieldErrors['email'] = 'Please enter a valid email address.';
}
if ($message === '') {
    $fieldErrors['message'] = 'Please leave a message.';
} else {
    if (preg_match('/https?:\/\/\S+/i', $message)) {
        $fieldErrors['message'] = 'Links are not allowed in the message.';
    } elseif (count(array_filter(preg_split('/\s+/', $message))) < 3) {
        $fieldErrors['message'] = 'Please write at least 3 words.';
    }
}

/* Längenbegrenzung (gegen Missbrauch und sehr große Mails) */
if (!isset($fieldErrors['name']) && mb_strlen($name) > 100) {
    $fieldErrors['name'] = 'Please use 100 characters at most.';
}
if (!isset($fieldErrors['email']) && strlen($email) > 254) {
    $fieldErrors['email'] = 'Please use 254 characters at most.';
}
if (!isset($fieldErrors['message']) && mb_strlen($message) > 5000) {
    $fieldErrors['message'] = 'Please use 5000 characters at most.';
}

if ($fieldErrors) {
    out([
        'ok'          => false,
        'type'        => 'danger',
        'message'     => 'Please check your input.',
        'fieldErrors' => $fieldErrors
    ]);
}

/* Begrenzung pro IP-Adresse: höchstens 5 Anfragen pro Stunde */
if (!rate_limit_ok('contact', 5, 3600)) {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Too many requests. Please try again later.']);
}

/* === Erfolgstext === */
$successHtml = 'Hello ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ',<br><br>'
    . 'Thank you for your message! The message was sent successfully. '
    . 'I will get back to you shortly.<br><br>'
    . 'Best regards,<br>Karsten Weng';

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
    out(['ok' => false, 'type' => 'danger', 'message' => 'The email could not be sent. Please try again later.']);
}
