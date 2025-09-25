<?php
declare(strict_types=1);

/**
 * e()
 * Sichere HTML-Ausgabe: wandelt Sonderzeichen in HTML-Entities um.
 * Nutzen bei allem, was aus Variablen in HTML-Attribute/Text geht.
 */
function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }


/* ============================================================
 * Sprache / Locale
 * ============================================================
 */

/**
 * current_lang()
 * Liefert die aktuell gesetzte Sprache als ISO-Code ('de' | 'en').
 * Reihenfolge: Session (wenn aktiv) > Cookie 'sprache' > Fallback 'de'.
 */
function current_lang(): string {
  if (session_status() === PHP_SESSION_ACTIVE && !empty($_SESSION['sprache'])) {
    return $_SESSION['sprache'];
  }
  return $_COOKIE['sprache'] ?? 'de';
}

/**
 * is_en()
 * Bequeme Abfrage, ob die aktuelle Sprache Englisch ist.
 */
function is_en(): bool { return current_lang() === 'en'; }


/* ============================================================
 * URLs / Pfade
 * ============================================================
 */

/**
 * abs_url($path)
 * Macht aus einem relativen Pfad eine absolute URL (inkl. http/https + Host).
 * Lässt bereits absolute http(s)-URLs unverändert.
 * Beispiel: abs_url('/img/a.png') -> https://www.weng.eu/img/a.png
 */
function abs_url(string $path): string {
  if (preg_match('#^https?://#', $path)) return $path;
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'www.weng.eu';
  return $scheme.'://'.$host.$path;
}

/**
 * page_url()
 * Liefert die absolute URL der aktuellen Seite OHNE Query-String.
 * Beispiel: /projekte/?q=foo -> https://www.weng.eu/projekte/
 */
function page_url(): string {
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'www.weng.eu';
  $path   = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
  return $scheme.'://'.$host.$path;
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
 * critical_css_inline($nonce)
 * Liest /assets/css/critical.min.css (oder critical.css) und gibt es inline als <style> zurück.
 * - Nutzt vorhandenes .min.css, sonst minifiziert es critical.css on-the-fly.
 * - Optional mit CSP-Nonce.
 * Einsatz: render-blocking CSS früh laden, ohne extra Request.
 */
function critical_css_inline(?string $nonce = null): string {
  $root   = $_SERVER['DOCUMENT_ROOT'];
  $min    = $root . '/assets/css/critical.min.css';
  $src    = $root . '/assets/css/critical.css';
  $css    = '/* no critical.css found */';

  if (is_file($min)) {
    $css = file_get_contents($min);
  } elseif (is_file($src)) {
    $css = minify_css(file_get_contents($src));
  }
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
    'title'    => 'WENG.EU | UX/UI Web Design – Built for People.',
    'desc'     => 'Websites, die nicht nur funktionieren, sondern überzeugen. Schnell. Barrierefrei. SEO-optimiert. Responsiv.',
    'og_image' => '/assets/img/logo/logo-light.svg',
    'robots'   => 'index, follow',
  ];
  $cleanMeta = array_filter($meta, fn($v) => !is_null($v) && !(is_string($v) && trim($v) === ''));
  $m = array_merge($defaults, $cleanMeta);

  $ogImg   = abs_url($m['og_image']);
  $url     = page_url();
  $updated = gmdate('c', @filemtime($_SERVER['SCRIPT_FILENAME']) ?: time());

  ob_start(); ?>
  <title><?= e($m['title']) ?></title>
  <meta name="description" content="<?= e($m['desc']) ?>">
  <meta name="robots" content="<?= e($m['robots']) ?>">

  <meta property="og:title" content="<?= e($m['title']) ?>">
  <meta property="og:description" content="<?= e($m['desc']) ?>">
  <meta property="og:site_name" content="WENG.EU">
  <meta property="og:type" content="article">
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
 * Beispiel: /projekte/ -> "/projekte"
 */
function current_path(): string {
  $path = parse_url(page_url(), PHP_URL_PATH) ?? '/';
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
