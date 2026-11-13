<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/i18n.php';
require_once __DIR__ . '/seo.php';

/**
 * e()
 * Sichere HTML-Ausgabe: wandelt Sonderzeichen in HTML-Entities um.
 * Nutzen bei allem, was aus Variablen in HTML-Attribute/Text geht.
 */
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

/** Chevron-Pfeil nach rechts hinter dem Text eines Links („Projekt ansehen“). Dekorativ (aria-hidden); gleiche Form wie die Pfeile des Sliders. */
function chevron_icon(): string {
  return '<svg class="chevron-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m9 18 6-6-6-6"/></svg>';
}

/** Icon „externer Link“ (Bootstrap Icons: box-arrow-up-right, gleiche Form wie fa-external-link). Dekorativ; der Hinweis für Screenreader kommt aus new_window_hint(). */
function ext_icon(): string {
  return '<svg class="ext-icon" viewBox="0 0 16 16" aria-hidden="true" focusable="false">'
    . '<path fill-rule="evenodd" d="M8.636 3.5a.5.5 0 0 0-.5-.5H1.5A1.5 1.5 0 0 0 0 4.5v10A1.5 1.5 0 0 0 1.5 16h10a1.5 1.5 0 0 0 1.5-1.5V7.864a.5.5 0 0 0-1 0V14.5a.5.5 0 0 1-.5.5h-10a.5.5 0 0 1-.5-.5v-10a.5.5 0 0 1 .5-.5h6.636a.5.5 0 0 0 .5-.5z"/>'
    . '<path fill-rule="evenodd" d="M16 .5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h3.793L6.146 9.146a.5.5 0 1 0 .708.708L15 1.707V5.5a.5.5 0 0 0 1 0v-5z"/>'
    . '</svg>';
}

/** Hinweis für Screenreader hinter dem Text eines Links, der in einem neuen Fenster öffnet (WCAG 3.2.5 / G201). */
function new_window_hint(): string { return '<span class="visually-hidden"> (' . e(t('link.new_window')) . ')</span>'; }


/* ============================================================
 * Sprache / Locale
 * ============================================================
 */

/* current_lang(), is_en(), url() u. a.: siehe config.php */


/* ============================================================
 * URLs / Pfade
 * ============================================================
 */

/**
 * abs_url($path)
 * Macht aus einem relativen Pfad eine absolute URL mit der festen Live-Adresse (SITE_URL).
 * Lässt bereits absolute http(s)-URLs unverändert.
 * Beispiel: abs_url('/img/a.png') -> https://weng.eu/img/a.png
 */
function abs_url(string $path): string {
  if (preg_match('#^https?://#', $path)) return $path;
  return SITE_URL . $path;
}

/**
 * page_url()
 * Liefert die absolute URL der aktuellen Seite OHNE Query-String.
 * Beispiel: /projekte/?q=foo -> https://weng.eu/projekte/
 */
function page_url(): string {
  $path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
  return SITE_URL . $path;
}


/* ============================================================
 * CSS Utilities
 * ============================================================
 */

/**
 * minify_css($css)
 * Entfernt Kommentare/überflüssige Leerzeichen aus CSS (rudimentär).
 * Für Build/Inline-Einsatz gedacht – kein vollständiger Minifier.
 */
function minify_css(string $css): string {
  $css = preg_replace('/@charset[^;]+;?/i', '', $css);
  $css = preg_replace('#/\*[^!][\s\S]*?\*/#', '', $css);
  $css = preg_replace('/\s+/', ' ', $css);
  $css = preg_replace('/\s*([{};:,>])\s*/', '$1', $css);
  $css = str_replace(';}', '}', $css);
  return trim($css);
}

/**
 * asset($name)
 * Liefert die gehashte URL eines Build-Artefakts aus /assets/dist/manifest.json,
 * z. B. asset('site.js') → /assets/dist/site.bmtn5q94.js. (Manifest erzeugt `bun run build`.)
 * Fehlt das Manifest oder der Eintrag, kommt ein leerer String zurück und es wird geloggt.
 */
function asset(string $name): string {
  static $manifest = null;
  if ($manifest === null) {
    $file = $_SERVER['DOCUMENT_ROOT'] . '/assets/dist/manifest.json';
    $manifest = is_file($file) ? (json_decode((string)file_get_contents($file), true) ?: []) : [];
  }
  if (!isset($manifest[$name])) {
    error_log("asset(): '{$name}' nicht im Manifest – wurde `bun run build` ausgeführt?");
    return '';
  }
  return $manifest[$name];
}

/**
 * critical_css_inline($nonce)
 * Gibt /assets/dist/critical.min.css (vom Build erzeugt) inline als <style> zurück.
 * - Optional mit CSP-Nonce.
 * Einsatz: render-blocking CSS früh laden, ohne extra Request.
 */
function critical_css_inline(?string $nonce = null): string {
  $file = $_SERVER['DOCUMENT_ROOT'] . '/assets/dist/critical.min.css';
  $css  = is_file($file) ? file_get_contents($file) : '/* no critical.min.css found */';
  $nonceAttr = $nonce ? ' nonce="'.e($nonce).'"' : '';
  return "<style{$nonceAttr}>{$css}</style>";
}


/* ============================================================
 * Meta Tags / SEO
 * ============================================================
 */

/**
 * meta_tags($meta)
 * Generiert <title>, Meta-Description, Robots sowie OpenGraph/Twitter-Metas.
 * - $meta kann title, desc, og_image, robots überschreiben.
 * - og_image wird zu absoluter URL aufgelöst.
 * - og:updated_time nutzt Datei-Änderungszeit als groben „Stand“.
 * Rückgabe: fertiger HTML-String (ohne Echo).
 */
function meta_tags(array $meta): string {
  $defaults = [
    'title'    => t('meta.default_title'),
    'desc'     => t('meta.default_desc'),
    'og_image' => '/assets/img/og/og-default.jpg', // 1200 × 630
    'og_type'  => 'website',
    'robots'   => 'index, follow',
  ];
  $cleanMeta = array_filter($meta, fn($v) => !is_null($v) && !(is_string($v) && trim($v) === ''));
  $m = array_merge($defaults, $cleanMeta);

  $ogImg    = abs_url($m['og_image']);
  $url      = page_url();
  $locale   = current_lang() === 'en' ? 'en_US' : 'de_DE';
  $updated  = gmdate('c', @filemtime($_SERVER['SCRIPT_FILENAME']) ?: time());

  ob_start(); ?>
  <title><?= e($m['title']) ?></title>
    <meta name="description" content="<?= e($m['desc']) ?>">
    <meta name="robots" content="<?= e($m['robots']) ?>">
    <meta property="og:title" content="<?= e($m['title']) ?>">
    <meta property="og:description" content="<?= e($m['desc']) ?>">
    <meta property="og:site_name" content="weng.eu">
    <meta property="og:type" content="<?= e($m['og_type']) ?>">
    <meta property="og:locale" content="<?= e($locale) ?>">
    <meta property="og:image" content="<?= e($ogImg) ?>">
    <meta property="og:url" content="<?= e($url) ?>">
    <meta property="og:updated_time" content="<?= e($updated) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= e($m['title']) ?>">
    <meta name="twitter:description" content="<?= e($m['desc']) ?>">
    <meta name="twitter:image" content="<?= e($ogImg) ?>">
  <?php
  return trim((string)ob_get_clean());
}


/* ============================================================
 * Formsicherheit: CSRF & Honeypot
 * ============================================================
 */

/**
 * ensure_session()
 * Stellt sicher, dass eine PHP-Session aktiv ist.
 * Wirft Exception, falls keine Session aktiv: so fallen Fehlkonfigurationen früh auf.
 */
function ensure_session(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    throw new RuntimeException('Session not active. Include session.php with NEED_SESSION first.');
  }
}

/**
 * get_csrf_token($formId)
 * Liefert/erzeugt ein CSRF-Token pro Formular-ID und speichert es in der Session.
 * Im Formular als hidden-Feld ausgeben, beim POST mit verify_csrf() prüfen.
 */
function get_csrf_token(string $formId = 'default'): string {
  ensure_session();
  $_SESSION['csrf'] ??= [];
  return $_SESSION['csrf'][$formId] ??= bin2hex(random_bytes(32));
}

/**
 * verify_csrf($token, $formId)
 * Prüft ein übermitteltes CSRF-Token gegen das in der Session gespeicherte.
 * Gibt true bei gültigem Token zurück – sonst false.
 */
function verify_csrf(?string $token, string $formId = 'default'): bool {
  ensure_session();
  $expected = $_SESSION['csrf'][$formId] ?? '';
  return is_string($token) && $expected !== '' && hash_equals($expected, $token);
}

/**
 * rate_limit_ok($bucket, $max, $window)
 * Einfaches Limit pro IP-Adresse ohne Datenbank: zählt Aufrufe je Zeitfenster in einer Datei im Temp-Verzeichnis.
 * Der Dateiname enthält nur einen Hash aus IP und Zeitfenster (keine Klartext-IP); Zähler älter als zwei Fenster werden gelöscht.
 * Kann das Temp-Verzeichnis nicht beschrieben werden, wird nicht begrenzt (lieber eine Anfrage zu viel als ein kaputtes Formular).
 */
function rate_limit_ok(string $bucket, int $max, int $window = 3600): bool {
  $ip = $_SERVER['REMOTE_ADDR'] ?? '';
  if ($ip === '') return true;
  $dir = sys_get_temp_dir();
  if (!is_writable($dir)) return true;
  $slot = intdiv(time(), $window);
  $file = $dir . '/weng_rl_' . $bucket . '_' . hash('sha256', $ip . '|' . $slot) . '.cnt';
  foreach (glob($dir . '/weng_rl_' . $bucket . '_*.cnt') ?: [] as $old) {
    if (@filemtime($old) < time() - 2 * $window) @unlink($old);
  }
  $count = is_file($file) ? (int)@file_get_contents($file) : 0;
  if ($count >= $max) return false;
  @file_put_contents($file, (string)($count + 1), LOCK_EX);
  return true;
}

/**
 * get_honeypot_name($formId)
 * Liefert den (zufälligen) Namen des Honeypot-Feldes für ein Formular.
 * Dieses Feld als verstecktes/unsichtbares Feld ausgeben – Bots füllen es oft aus.
 */
function get_honeypot_name(string $formId = 'default'): string {
  ensure_session();
  $_SESSION['hp'] ??= [];
  return $_SESSION['hp'][$formId] ??= 'hp_' . bin2hex(random_bytes(6));
}

/**
 * is_honeypot_triggered($_POST, $formId)
 * Prüft, ob das Honeypot-Feld befüllt wurde (dann vermutlich Bot).
 * Gibt true zurück, wenn getriggert (blocken), sonst false.
 * Falls kein Name vorhanden ist, wird aus Sicherheitsgründen true zurückgegeben.
 */
function is_honeypot_triggered(array $post, string $formId = 'default'): bool {
  ensure_session();
  $hp = $_SESSION['hp'][$formId] ?? null;
  if (!$hp) return true; // wenn es keinen Namen gibt, lieber blocken
  return !empty($post[$hp] ?? '');
}


/* ============================================================
 * Navigation: aktiver Menüpunkt
 * ============================================================
 */

/**
 * current_path()
 * Liefert den aktuellen Pfad-Teil der URL (ohne Domain/Query), ohne trailing Slash.
 * Ausnahme: die Startseite bleibt als "/" erhalten.
 * Das Sprachpräfix /en wird entfernt. Beispiel: /en/projekte/ -> "/projekte"
 */
function current_path(): string {
  $path = parse_url(page_url(), PHP_URL_PATH) ?? '/';
  $path = preg_replace('#^/en(?=/|$)#', '', $path); // Sprachpräfix gehört nicht zum Seitenpfad
  $path = rtrim($path, '/');
  return $path === '' ? '/' : $path;
}

/**
 * is_active($href, $prefix=false)
 * Prüft, ob ein Menü-Link „aktiv“ ist.
 * - $prefix=false: Nur exakter Treffer (z. B. "/kontakt/").
 * - $prefix=true: Auch Unterseiten zählen (z. B. "/projekte/" UND "/projekte/foo/").
 */
function is_active(string $href, bool $prefix = false): bool {
  $target = parse_url($href, PHP_URL_PATH) ?? '/';
  $target = rtrim($target, '/');
  $target = $target === '' ? '/' : $target;

  $path = current_path();

  if ($prefix) {
    return $path === $target || ($target !== '/' && str_starts_with($path, $target . '/'));
  }
  return $path === $target;
}

/**
 * active_class($href, $prefix=false)
 * Bequeme Hilfe für Markup:
 * Gibt ' active' zurück, wenn Link aktiv – sonst ''.
 * Direkt an class-Attribute anhängen.
 */
function active_class(string $href, bool $prefix = false): string {
  return is_active($href, $prefix) ? ' active' : '';
}

/**
 * aria_current($href, $prefix=false)
 * A11y-Hilfe: Gibt ' aria-current="page"' zurück, wenn Link aktiv – sonst ''.
 * Für Screenreader und korrekte Kennzeichnung des aktuellen Menüpunktes.
 */
function aria_current(string $href, bool $prefix = false): string {
  return is_active($href, $prefix) ? ' aria-current="page"' : '';
}
