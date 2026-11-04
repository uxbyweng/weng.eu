<?php
declare(strict_types=1);

/* ============================================================
 * Offene Inhalte (Platzhalter)
 * ============================================================
 */

/**
 * todo($label, $before)
 * Markiert einen Inhalt, den nur der Inhaber liefern kann (Zitate, Zahlen, Anschrift …).
 * - Lokal (is_dev): gelb markierter Hinweis "[… label]".
 * - Live: gibt nichts aus – es geht nichts Halbfertiges online.
 * $before steht nur davor, wenn der Hinweis angezeigt wird (z. B. ' · ').
 */
function todo(string $label, string $before = ''): string {
  if (!is_dev()) return '';
  return $before . '<mark class="todo">[… ' . e($label) . ']</mark>';
}


/* ============================================================
 * Breadcrumb
 * ============================================================
 */

/**
 * breadcrumb_trail($set)
 * Liefert den Brotkrumenpfad als Liste von ['label' => …, 'href' => …|null].
 * - Ohne Vorgabe wird er aus der URL abgeleitet (Labels aus t('crumb.<slug>')).
 * - Eine Seite kann ihn über $meta['trail'] vollständig vorgeben (inkl. Startseite), wenn die URL-Labels nicht reichen.
 * Die Startseite hat keinen Pfad.
 */
function breadcrumb_trail(?array $set = null): array {
  static $trail = null;
  if ($set !== null) $trail = $set;
  if ($trail !== null) return $trail;

  $segments = array_values(array_filter(explode('/', trim(current_path(), '/'))));
  if (!$segments) return $trail = [];

  $items = [['label' => t('crumb.home'), 'href' => '/']];
  $url = '';
  foreach ($segments as $i => $slug) {
    $url .= '/' . $slug;
    $isLast = $i === array_key_last($segments);
    $label = t_has("crumb.$slug") ? t("crumb.$slug") : ucfirst(str_replace('-', ' ', $slug));
    $items[] = ['label' => $label, 'href' => $isLast ? null : $url . '/'];
  }
  return $trail = $items;
}

/** BreadcrumbList (schema.org) für den Kopfbereich. */
function breadcrumb_json_ld(array $trail): array {
  $list = [];
  foreach ($trail as $i => $item) {
    $entry = ['@type' => 'ListItem', 'position' => $i + 1, 'name' => $item['label']];
    $entry['item'] = abs_url($item['href'] ?? current_path() . '/');
    $list[] = $entry;
  }
  return ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $list];
}

/** Person (schema.org) für die Startseite. */
function person_json_ld(): array {
  return [
    '@context' => 'https://schema.org',
    '@type' => 'Person',
    'name' => 'Karsten Weng',
    'jobTitle' => t('meta.job_title'),
    'url' => 'https://weng.eu/',
    'address' => ['@type' => 'PostalAddress', 'addressLocality' => 'Berlin', 'addressCountry' => 'DE'],
    'sameAs' => [SITE_LINKEDIN, SITE_GITHUB],
  ];
}

/** Gibt JSON-LD-Blöcke als <script>-Tags aus. */
function json_ld_tags(array $blocks, ?string $nonce = null): string {
  $attr = $nonce ? ' nonce="' . e($nonce) . '"' : '';
  $out = '';
  foreach ($blocks as $block) {
    $json = json_encode($block, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG);
    $out .= '<script type="application/ld+json"' . $attr . '>' . $json . '</script>' . "\n    ";
  }
  return $out;
}
