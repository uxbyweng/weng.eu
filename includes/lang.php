<?php
// lang.php – Sprache kommt aus der URL ("/" = de, "/en/…" = en), siehe config.php.
// Hält nur noch die Variable $sprache für Seiten bereit, die sie (noch) benutzen.
require_once __DIR__ . '/config.php';

$sprache = current_lang();

function htmlLang(): string { return current_lang(); }
