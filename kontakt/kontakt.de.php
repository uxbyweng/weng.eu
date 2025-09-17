<?php
header('X-Content-Type-Options: nosniff');
header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');
ini_set('display_errors','0');
// error_reporting(E_ALL);

/* Session & Helpers laden */
define('NEED_SESSION', true);
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';

/* Env laden (sicherer Pfad über Document-Root) */
$envPath = $_SERVER['DOCUMENT_ROOT'].'/includes/env.php';
if (is_file($envPath)) {
    require_once $envPath;
} else {
    function env($k,$d=null){ return $d; }
}

/* JSON-Antwort Helper */
function out(array $data) {
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
    out(['ok'=>false,'type'=>'danger','message'=>'Ungültiges Formular-Token. Bitte neu laden.']);
}

/* Honeypot prüfen (Silent-OK bei Bot) */
if (is_honeypot_triggered($_POST, $formId)) {
    out(['ok' => true, 'type' => 'success', 'message' => 'OK']);
}

/* Lock lösen – ab hier keine Session nötig */
session_write_close();

/* === Felder holen === */
$name       = trim($_POST['name']    ?? '');
$email      = trim($_POST['email']   ?? '');
$message    = trim($_POST['message'] ?? '');
$privacyRaw = $_POST['privacy']      ?? null;
$terms      = isset($_POST['terms']); // unsichtbar, Bot-Falle

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

/* Datenschutz-Checkbox prüfen */
$trueVals = ['checked','on','1','true','yes'];
if (!in_array(strtolower((string)$privacyRaw), $trueVals, true)) {
    $fieldErrors['privacy'] = 'Bitte die Datenschutzerklärung akzeptieren.';
}

if ($fieldErrors) {
    out([
        'ok'          => false,
        'type'        => 'danger',
        'message'     => 'Bitte die Eingaben überprüfen.',
        'fieldErrors' => $fieldErrors
    ]);
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

/* Optionale Bestätigung an Absender */
if ($sent && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $confirmSubj = 'Anfrage erhalten ' . date('Ymd\THi');
    $confirmBody = "Hallo {$name},\r\n\r\nvielen Dank für die Nachricht. "
                 . "Ich melde mich in Kürze.\r\n\r\nFreundliche Grüße,\r\nKarsten Weng\r\n";
    @mail($email, $confirmSubj, $confirmBody, "From: {$from}\r\nContent-Type: text/plain; charset=UTF-8\r\n");
}

if ($sent) {
    out(['ok' => true, 'type' => 'success', 'message' => $successHtml]);
} else {
    out(['ok' => false, 'type' => 'danger', 'message' => 'E-Mail konnte nicht gesendet werden. Bitte später erneut versuchen.']);
}