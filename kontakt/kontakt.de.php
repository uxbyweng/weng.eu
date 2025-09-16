<?php header('X-Content-Type-Options: nosniff');
// kontakt.php — simple mode

// Immer JSON liefern (und nichts anderes)
header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');
ini_set('display_errors', '0'); // keine Notices im Output

// Helper: JSON raus und beenden
function out(array $data) {
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// Nur POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Ungültige Anfragemethode.']);
}

// Felder holen
$name        = trim($_POST['name']    ?? '');
$email       = trim($_POST['email']   ?? '');
$message     = trim($_POST['message'] ?? '');
$privacyRaw  = $_POST['privacy']      ?? null; // 'checked' o. ä.
$honeypot    = trim($_POST['repeat_email'] ?? '');
$terms       = isset($_POST['terms']); // soll leer bleiben → Bot-Falle

// Validierung
$fieldErrors = [];

if ($name === '') {
    $fieldErrors['name'] = 'Bitte einen Namen eingebn.';
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
$trueVals = ['checked','on','1','true','yes'];
if (!in_array(strtolower((string)$privacyRaw), $trueVals, true)) {
    // frontend erzwingt es – server prüft zusätzlich
    $fieldErrors['privacy'] = 'Bitte die Datenschutzerklärung akzeptieren.';
}

// Silent Spam (Bot) → „ok:true“ zurück, aber nichts senden
$isSilentSpam = ($honeypot !== '') || $terms;

// Bei Fehlern
if ($fieldErrors) {
    out([
        'ok'          => false,
        'type'        => 'danger',
        'message'     => 'Bitte die Eingaben überprüfen.',
        'fieldErrors' => $fieldErrors
    ]);
}

// Erfolgstext vorbereiten
$successHtml = 'Hallo ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ',<br><br>'
             . 'Vielen Dank für die Nachricht! Die Nachricht wurde erfolgreich übermittelt. '
             . 'Ich werde mich in Kürze melden.<br><br>'
             . 'Viele Grüße,<br>Karsten Weng';

// Bei Bot: nicht senden
if ($isSilentSpam) {
    out(['ok' => true, 'type' => 'success', 'message' => $successHtml]);
}

// === Mailversand (einfach gehalten)
$to       = 'info@weng.eu';
$from     = 'info@weng.eu';
$subject  = 'Anfrage ' . date('Ymd\THi');
$body     = "Gesendet über weng.eu/kontakt/\r\n\r\n"
          . "Name:    {$name}\r\n"
          . "Email:   {$email}\r\n\r\n"
          . "Nachricht:\r\n{$message}\r\n";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "From: {$from}\r\n";
$headers .= "Reply-To: {$email}\r\n";

// Senden (ohne -f Envelope, um Hosting-Sperren zu vermeiden)
$sent = @mail($to, $subject, $body, $headers);

// Optional: Bestätigung an Absender – schlank
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