<?php
// /assets/api/contact.json.php
header('Content-Type: application/json; charset=UTF-8');

// Optional: kleine Sicherheit – nur GET erlauben
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Antwort mit den Kontaktdaten (nur für die Anzeige im Frontend)
echo json_encode([
  'address_human' => 'Waldemarstr. 21, 10999 Berlin, Germany', // Anzeige für User
  'name_human'  => 'Karsten Weng',      // Anzeige für User
  'tel_human'  => '0176 / 48580055',    // Anzeige für User
  'tel_link'   => '+4917648580055',     // für tel:
  'mail_human' => 'info@weng.eu',       // Anzeige für User
  'mail_link'  => 'info@weng.eu'        // für mailto:
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

