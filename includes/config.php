<?php
declare(strict_types=1);

/**
 * is_dev()
 * true auf dem lokalen Entwicklungsserver (`bun run dev` startet PHP mit WENG_DEV=1).
 * Auf dem Webserver ist die Variable nicht gesetzt.
 */
function is_dev(): bool {
  return (getenv('WENG_DEV') ?: ($_SERVER['WENG_DEV'] ?? '')) === '1';
}

/* ============================================================
 * Sprache aus der URL: "/" = Deutsch, "/en/…" = Englisch
 * ============================================================
 * Es gibt pro Seite nur eine Datei (z. B. /kontakt/index.php). Die .htaccess (live) bzw. router.php (lokal)
 * liefert /en/kontakt/ intern mit derselben Datei aus; die Sprache steht weiter in REQUEST_URI.
 */

/** Pfad der aktuellen Anfrage, wie ihn der Besucher sieht (inkl. /en), ohne Query. */
function request_path(): string {
  return parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
}

/** 'de' | 'en' – Englisch, wenn die URL mit /en beginnt. */
function current_lang(): string {
  $path = request_path();
  return ($path === '/en' || str_starts_with($path, '/en/')) ? 'en' : 'de';
}

function is_en(): bool { return current_lang() === 'en'; }

/** Präfix für interne Links: '' (Deutsch) oder '/en'. */
function lang_prefix(): string { return is_en() ? '/en' : ''; }

/**
 * url('/projekte/') → '/projekte/' bzw. '/en/projekte/'
 * Für alle internen Seiten-Links verwenden (nicht für /assets/…).
 */
function url(string $path): string {
  return lang_prefix() . $path;
}

/** Adresse der aktuellen Seite in einer bestimmten Sprache (für Sprachumschalter und hreflang). */
function lang_url(string $lang): string {
  $path = current_path();
  $path = $path === '/' ? '/' : $path . '/';
  return ($lang === 'en' ? '/en' : '') . $path;
}

/** Kontakt-Daten, die an mehreren Stellen vorkommen (eine E-Mail überall). */
const SITE_EMAIL = 'karsten@weng.eu';
const SITE_LINKEDIN = 'https://www.linkedin.com/in/kweng/';
const SITE_GITHUB = 'https://github.com/uxbyweng';

/** Feste Live-Adresse: Canonical, hreflang, Open Graph und JSON-LD nutzen sie, nie den Host aus der Anfrage (Host-Header lässt sich fälschen). */
const SITE_URL = 'https://weng.eu';
