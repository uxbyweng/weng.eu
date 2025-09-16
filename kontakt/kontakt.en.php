<?php
// kontakt.php — simple mode (EN)

// Always return JSON (and nothing else)
header('Content-Type: application/json; charset=UTF-8');
header('Cache-Control: no-store');
ini_set('display_errors', '0'); // no notices in output

// Helper: output JSON and exit
function out(array $data) {
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

// POST only
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Invalid request method.']);
}

// Collect fields
$name        = trim($_POST['name']    ?? '');
$email       = trim($_POST['email']   ?? '');
$message     = trim($_POST['message'] ?? '');
$privacyRaw  = $_POST['privacy']      ?? null; // 'checked' etc.
$honeypot    = trim($_POST['repeat_email'] ?? '');
$terms       = isset($_POST['terms']); // should stay empty → bot trap

// Validation
$fieldErrors = [];

if ($name === '') {
    $fieldErrors['name'] = 'Please enter your name.';
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
$trueVals = ['checked','on','1','true','yes'];
if (!in_array(strtolower((string)$privacyRaw), $trueVals, true)) {
    // frontend enforces it – server double-checks
    $fieldErrors['privacy'] = 'Please accept the privacy policy.';
}

// Silent spam (bot) → return ok:true but do not send
$isSilentSpam = ($honeypot !== '') || $terms;

// On errors
if ($fieldErrors) {
    out([
        'ok'          => false,
        'type'        => 'danger',
        'message'     => 'Please review your entries.',
        'fieldErrors' => $fieldErrors
    ]);
}

// Success message (HTML)
$successHtml = 'Hello ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . ',<br><br>'
             . 'Thank you for your message! Your message was sent successfully. '
             . 'I will get back to you shortly.<br><br>'
             . 'Kind regards,<br>Karsten Weng';

// Bot: do not send
if ($isSilentSpam) {
    out(['ok' => true, 'type' => 'success', 'message' => $successHtml]);
}

// === Mail sending (kept simple)
$to       = 'info@weng.eu';
$from     = 'info@weng.eu';
$subject  = 'Inquiry ' . date('Ymd\THi');
$body     = "Sent via weng.eu/contact/\r\n\r\n"
          . "Name:    {$name}\r\n"
          . "Email:   {$email}\r\n\r\n"
          . "Message:\r\n{$message}\r\n";

$headers  = "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "From: {$from}\r\n";
$headers .= "Reply-To: {$email}\r\n";

// Send (without -f envelope to avoid hosting restrictions)
$sent = @mail($to, $subject, $body, $headers);

// Optional: confirmation to sender — simple
if ($sent && filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $confirmSubj = 'Inquiry received ' . date('Ymd\THi');
    $confirmBody = "Hello {$name},\r\n\r\nThank you for your message. "
                 . "I will contact you shortly.\r\n\r\nKind regards,\r\nKarsten Weng\r\n";
    @mail($email, $confirmSubj, $confirmBody, "From: {$from}\r\nContent-Type: text/plain; charset=UTF-8\r\n");
}

if ($sent) {
    out(['ok' => true, 'type' => 'success', 'message' => $successHtml]);
} else {
    out(['ok' => false, 'type' => 'danger', 'message' => 'Email could not be sent. Please try again later.']);
}