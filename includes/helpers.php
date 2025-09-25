<?php
declare(strict_types=1);

function e(string $s): string { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// Sprache bestimmen
function current_lang(): string {
  if (session_status() === PHP_SESSION_ACTIVE && !empty($_SESSION['sprache'])) {
    return $_SESSION['sprache'];
  }
  return $_COOKIE['sprache'] ?? 'de';
}
function is_en(): bool { return current_lang() === 'en'; }


function abs_url(string $path): string {
  if (preg_match('#^https?://#', $path)) return $path;
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'www.weng.eu';
  return $scheme.'://'.$host.$path;
}
function page_url(): string {
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'www.weng.eu';
  $path   = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
  return $scheme.'://'.$host.$path;
}

function minify_css(string $css): string {
  $css = preg_replace('/@charset[^;]+;?/i', '', $css);
  $css = preg_replace('#/\*[^!][\s\S]*?\*/#', '', $css);
  $css = preg_replace('/\s+/', ' ', $css);
  $css = preg_replace('/\s*([{};:,>])\s*/', '$1', $css);
  $css = str_replace(';}', '}', $css);
  return trim($css);
}

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

/* ===== CSRF & Honeypot ===== */

// Sicherstellen, dass eine Session aktiv ist
function ensure_session(): void {
  if (session_status() !== PHP_SESSION_ACTIVE) {
    throw new RuntimeException('Session not active. Include session.php with NEED_SESSION first.');
  }
}

function get_csrf_token(string $formId = 'default'): string {
  ensure_session();
  $_SESSION['csrf'] ??= [];
  return $_SESSION['csrf'][$formId] ??= bin2hex(random_bytes(32));
}

function verify_csrf(?string $token, string $formId = 'default'): bool {
  ensure_session();
  $expected = $_SESSION['csrf'][$formId] ?? '';
  return is_string($token) && $expected !== '' && hash_equals($expected, $token);
}

function get_honeypot_name(string $formId = 'default'): string {
  ensure_session();
  $_SESSION['hp'] ??= [];
  return $_SESSION['hp'][$formId] ??= 'hp_' . bin2hex(random_bytes(6));
}

function is_honeypot_triggered(array $post, string $formId = 'default'): bool {
  ensure_session();
  $hp = $_SESSION['hp'][$formId] ?? null;
  if (!$hp) return true; // wenn es keinen Namen gibt, lieber blocken
  return !empty($post[$hp] ?? '');
}

/** Liefert den aktuellen Pfad ohne Querystring, ohne trailing Slash (außer "/"). */
function current_path(): string {
  $path = parse_url(page_url(), PHP_URL_PATH) ?? '/';
  $path = rtrim($path, '/');
  return $path === '' ? '/' : $path;
}

/**
 * Prüft, ob $href aktiv ist.
 * $prefix=true: auch Unterpfade zählen (z. B. /projekte/ und /projekte/xyz/)
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

/** Convenience-Ausgaben für Markup */
function active_class(string $href, bool $prefix = false): string {
  return is_active($href, $prefix) ? ' active' : '';
}
function aria_current(string $href, bool $prefix = false): string {
  return is_active($href, $prefix) ? ' aria-current="page"' : '';
}
