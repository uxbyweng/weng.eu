<?php
declare(strict_types=1);

/**
 * t($key, $vars)
 * Übersetzt einen Textschlüssel (Dateien in includes/i18n/de/ und includes/i18n/en/).
 * - Fehlt der Schlüssel in der aktuellen Sprache, wird Deutsch verwendet.
 * - {platzhalter} im Text werden durch $vars ersetzt: t('footer.copy', ['year' => date('Y')])
 * - Ausgabe immer mit e() escapen: <?= e(t('nav.projects')) ?>
 *   (Texte, die bewusst HTML enthalten, enden auf "_html" und werden mit t_html() ausgegeben.)
 */
function t(string $key, array $vars = []): string {
  $dict = i18n_dictionary(current_lang());
  $text = $dict[$key] ?? i18n_dictionary('de')[$key] ?? null;
  if ($text === null) {
    error_log("t(): Schlüssel '{$key}' fehlt");
    return is_dev() ? "⚠ {$key}" : $key;
  }
  foreach ($vars as $name => $value) {
    $text = str_replace('{' . $name . '}', (string)$value, $text);
  }
  return $text;
}

/** Lädt alle Dateien aus includes/i18n/<lang>/*.php (ein Array pro Datei) und führt sie zusammen. */
function i18n_dictionary(string $lang): array {
  static $cache = [];
  if (!isset($cache[$lang])) {
    $cache[$lang] = [];
    foreach (glob(__DIR__ . '/i18n/' . $lang . '/*.php') ?: [] as $file) {
      $cache[$lang] = array_merge($cache[$lang], require $file);
    }
  }
  return $cache[$lang];
}

/** Wie t(), für Texte, die absichtlich HTML enthalten (nur eigene, vertrauenswürdige Texte!). */
function t_html(string $key, array $vars = []): string {
  return t($key, $vars);
}

/** Prüft, ob es für den Schlüssel einen Text gibt (z. B. für Fallbacks). */
function t_has(string $key): bool {
  return isset(i18n_dictionary('de')[$key]);
}
