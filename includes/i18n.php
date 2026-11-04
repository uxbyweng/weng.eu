<?php
declare(strict_types=1);

/**
 * t($key, $vars)
 * Übersetzt einen Textschlüssel (siehe includes/i18n/de.php und en.php).
 * - Fehlt der Schlüssel in der aktuellen Sprache, wird Deutsch verwendet.
 * - {platzhalter} im Text werden durch $vars ersetzt: t('footer.copy', ['year' => date('Y')])
 * - Ausgabe immer mit e() escapen: <?= e(t('nav.projects')) ?>
 *   (Texte, die bewusst HTML enthalten, enden auf "_html" und werden mit t_html() ausgegeben.)
 */
function t(string $key, array $vars = []): string {
  static $dict = [];
  $dict['de'] ??= require __DIR__ . '/i18n/de.php';
  if (current_lang() === 'en') {
    $dict['en'] ??= require __DIR__ . '/i18n/en.php';
  }

  $text = $dict['en'][$key] ?? $dict['de'][$key] ?? null;
  if ($text === null) {
    error_log("t(): Schlüssel '{$key}' fehlt");
    return is_dev() ? "⚠ {$key}" : $key;
  }
  foreach ($vars as $name => $value) {
    $text = str_replace('{' . $name . '}', (string)$value, $text);
  }
  return $text;
}

/** Wie t(), für Texte, die absichtlich HTML enthalten (nur eigene, vertrauenswürdige Texte!). */
function t_html(string $key, array $vars = []): string {
  return t($key, $vars);
}

/** Prüft, ob es für den Schlüssel einen Text gibt (z. B. für Fallbacks). */
function t_has(string $key): bool {
  static $de = null;
  $de ??= require __DIR__ . '/i18n/de.php';
  return isset($de[$key]);
}
