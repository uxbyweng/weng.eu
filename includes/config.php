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

/**
 * EN_ENABLED
 * Schaltet die englische Version ein. Solange nicht alle Seiten übersetzt sind:
 * lokal an (zum Testen), live aus – dann gibt es nur Deutsch und keinen Sprachumschalter.
 * Zum Freischalten: `define('EN_ENABLED', true);`
 */
if (!defined('EN_ENABLED')) {
  define('EN_ENABLED', is_dev());
}

/** Kontakt-Daten, die an mehreren Stellen vorkommen (eine E-Mail überall). */
const SITE_EMAIL = 'karsten@weng.eu';
const SITE_LINKEDIN = 'https://www.linkedin.com/in/kweng/';
const SITE_GITHUB = 'https://github.com/uxbyweng';
