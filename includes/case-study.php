<?php
declare(strict_types=1);

/**
 * Bausteine der Projektseiten. MASTER ist projekte/park-klinik/index.php: Alle Projektseiten bauen aus denselben Funktionen,
 * damit Aufbau, Abstände und Verhalten einheitlich bleiben.
 *
 * Reihenfolge einer Projektseite (Bausteine, die es nicht gibt, entfallen):
 *   case_head (mit Screenshot rechts) → case_glance (dunkles Band mit Icons + Tech-Stack) → case_start (Ausgangslage)
 *   → case_steps (Vorgehen, nummeriert) → case_slider (Bilder) → Kundenstimme (nur mit echtem Zitat)
 *
 * Die Funktionen geben HTML direkt aus. Texte kommen bereits aus t() und werden hier mit e() escaped.
 * Parameter mit der Endung "Html" enthalten bereits sicheres HTML (z. B. Links, todo()).
 */

/** Pfade eines Icons (Lucide-Stil: 24er Raster, nur Linie). Aufruf: <svg viewBox="0 0 24 24"><?= case_icon('gauge') ?></svg> */
function case_icon(string $name): string {
  static $icons = [
    'gauge'     => '<path d="m12 14 4-4"/><path d="M3.34 19a10 10 0 1 1 17.32 0"/>',
    'grid'      => '<rect width="7" height="7" x="3" y="3" rx="1"/><rect width="7" height="7" x="14" y="3" rx="1"/><rect width="7" height="7" x="14" y="14" rx="1"/><rect width="7" height="7" x="3" y="14" rx="1"/>',
    'sliders'   => '<path d="M21 4h-7"/><path d="M10 4H3"/><path d="M21 12h-9"/><path d="M8 12H3"/><path d="M21 20h-5"/><path d="M12 20H3"/><path d="M14 2v4"/><path d="M8 10v4"/><path d="M16 18v4"/>',
    'languages' => '<path d="m5 8 6 6"/><path d="m4 14 6-6 2-3"/><path d="M2 5h12"/><path d="M7 2h1"/><path d="m22 22-5-10-5 10"/><path d="M14 18h6"/>',
    'monitor'   => '<rect width="20" height="14" x="2" y="3" rx="2"/><path d="M8 21h8"/><path d="M12 17v4"/>',
    'smartphone' => '<rect width="14" height="20" x="5" y="2" rx="2" ry="2"/><path d="M12 18h.01"/>',
    'eye'       => '<path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/>',
    'search'    => '<circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>',
    'calendar'  => '<path d="M8 2v4"/><path d="M16 2v4"/><rect width="18" height="18" x="3" y="4" rx="2"/><path d="M3 10h18"/>',
    'cart'      => '<circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/>',
    'map-pin'   => '<path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>',
    'upload'    => '<path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><path d="m17 8-5-5-5 5"/><path d="M12 3v12"/>',
    'lock'      => '<rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/>',
    'image'     => '<rect width="18" height="18" x="3" y="3" rx="2" ry="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/>',
    'database'  => '<ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v14a9 3 0 0 0 18 0V5"/><path d="M3 12a9 3 0 0 0 18 0"/>',
    'shield'    => '<path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>',
    'pencil'    => '<path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/>',
    'pen-tool'  => '<path d="M15.707 21.293a1 1 0 0 1-1.414 0l-1.586-1.586a1 1 0 0 1 0-1.414l5.586-5.586a1 1 0 0 1 1.414 0l1.586 1.586a1 1 0 0 1 0 1.414z"/><path d="m18 13-1.375-6.874a1 1 0 0 0-.746-.776L3.235 2.028a1 1 0 0 0-1.207 1.207L5.35 15.879a1 1 0 0 0 .776.746L13 18"/><path d="m2.3 2.3 7.286 7.286"/><circle cx="11" cy="11" r="2"/>',
    'book-open' => '<path d="M12 7v14"/><path d="M3 18a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h5a4 4 0 0 1 4 4 4 4 0 0 1 4-4h5a1 1 0 0 1 1 1v13a1 1 0 0 1-1 1h-6a3 3 0 0 0-3 3 3 3 0 0 0-3-3z"/>',
    'type'      => '<polyline points="4 7 4 4 20 4 20 7"/><line x1="9" x2="15" y1="20" y2="20"/><line x1="12" x2="12" y1="4" y2="20"/>',
    'zap'       => '<path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z"/>',
  ];
  return $icons[$name] ?? '';
}

/** Externer Link für den Steckbrief: neues Fenster, Pfeil, Hinweis für Screenreader. */
function case_ext_link(string $url, string $label, bool $nofollow = false): string {
  $rel = ($nofollow ? 'nofollow ' : '') . 'noopener noreferrer';
  return '<a href="' . e($url) . '" target="_blank" rel="' . $rel . '">' . e($label) . ' ' . ext_icon() . new_window_hint() . '</a>';
}

/**
 * Kopf (über der Falz): links Überzeile, H1 und Einleitung, rechts der Screenshot (50 : 50; auf dem Smartphone darunter), darunter der Steckbrief über die volle Breite.
 * @param array<int, array{0:string, 1:string}> $facts [Beschriftung, Wert als sicheres HTML] – üblich: Zeitraum, Rolle, Live (optional Code)
 * @param array{dir?:string, base?:string, alt?:string, caption?:string, w?:int, h?:int} $shot optional: dir (Bildordner), base (Dateiname ohne Endung; erwartet
 *        <base>.jpg/.webp und <base>_xs.webp, enthält schon den Browser-Rahmen), alt, caption, w, h (Standard 1200 × 800)
 */
function case_head(string $eyebrow, string $title, string $lead, array $facts, array $shot = []): void {
  echo '<header class="page-head page-head--case"><div class="wrap case-hero' . ($shot ? ' case-hero--shot' : '') . '"><div class="case-hero__text">';
  echo '<p class="eyebrow">' . e($eyebrow) . '</p>';
  echo '<h1 id="case-title">' . e($title) . '</h1>';
  echo '<p class="lead">' . e($lead) . '</p>';
  echo '</div>';
  if ($shot) {
    $base = e($shot['dir'] . $shot['base']);
    // Klick springt zum Slider weiter unten (dort steht derselbe Screenshot als erstes Bild)
    echo '<figure class="case-figure case-hero__figure"><a class="case-hero__link" href="#case-slider" aria-label="' . e($shot['caption'] . ' – ' . t('case.jump')) . '"><picture>';
    echo '<source type="image/webp" srcset="' . $base . '_xs.webp 600w, ' . $base . '.webp 1200w" sizes="(min-width: 900px) 540px, 100vw">';
    echo '<img src="' . $base . '.jpg" alt="" width="' . ($shot['w'] ?? 1200) . '" height="' . ($shot['h'] ?? 800) . '" fetchpriority="high" decoding="async">';
    echo '</picture></a><figcaption>' . e($shot['caption']) . '</figcaption></figure>';
  }
  // Steckbrief über die volle Breite unter Text und Screenshot
  echo '<dl class="case-facts">';
  foreach ($facts as [$label, $valueHtml]) {
    echo '<div><dt>' . e($label) . '</dt><dd>' . $valueHtml . '</dd></div>';
  }
  echo '</dl></div></header>';
}

/** Der Screenshot aus dem Kopf als erste Folie des Sliders (gleiche Struktur wie $shot in case_head, siehe case_slider). */
function case_shot_slide(array $shot): array {
  return ['base' => $shot['base'], 'alt' => $shot['alt'], 'caption' => $shot['caption'], 'w' => $shot['w'] ?? 1200, 'h' => $shot['h'] ?? 800, 'xs' => true];
}

/**
 * „Auf einen Blick“: dunkles Band mit Eckdaten (Icon, Wert, Text), optionaler Fußnote und Tech-Stack.
 * @param array<int, array{icon:string, value:string, text:string, html?:string}> $items drei bis vier Einträge (html: optional, sicheres HTML hinter dem Text, z. B. todo())
 * @param string[] $stack
 */
function case_glance(string $title, array $items, array $stack, string $stackLabel, string $noteHtml = ''): void {
  echo '<section class="section section--band glance-section" aria-labelledby="case-results"><div class="wrap">';
  echo '<h2 id="case-results" class="glance__title">' . e($title) . '</h2><div class="glance"><ul class="glance__list">';
  foreach ($items as $item) {
    echo '<li class="glance__item"><span class="glance__icon" aria-hidden="true"><svg viewBox="0 0 24 24" focusable="false">' . case_icon($item['icon']) . '</svg></span>';
    echo '<div><p class="glance__value">' . e($item['value']) . '</p><p class="glance__text">' . e($item['text']) . ($item['html'] ?? '') . '</p></div></li>';
  }
  echo '</ul>';
  if ($noteHtml !== '') echo '<p class="glance__note">' . $noteHtml . '</p>';
  if ($stack) {
    echo '<div class="glance__stack"><h3 class="glance__label">' . e($stackLabel) . '</h3><ul class="chip-list">';
    foreach ($stack as $tool) echo '<li class="chip">' . e($tool) . '</li>';
    echo '</ul></div>';
  }
  echo '</div></div></section>';
}

/**
 * Ausgangslage (oder ein anderer Textabschnitt, z. B. „Heute“; $id muss je Seite eindeutig sein): Absätze, optional eine Liste mit Zielen (fett: Stichwort) und sicheres HTML am Ende (z. B. todo()).
 * @param string[] $paragraphs
 * @param array<int, array{0:string, 1:string}> $goals [Stichwort, Text]
 */
function case_start(string $title, array $paragraphs, array $goals = [], string $afterHtml = '', string $id = 'case-start'): void {
  echo '<section class="section" aria-labelledby="' . e($id) . '"><div class="wrap"><h2 id="' . e($id) . '">' . e($title) . '</h2>';
  foreach ($paragraphs as $i => $text) {
    echo '<p class="case-intro">' . e($text) . ($i === array_key_last($paragraphs) && !$goals ? $afterHtml : '') . '</p>';
  }
  if ($goals) {
    echo '<ul class="case-list case-intro">';
    foreach ($goals as [$label, $text]) echo '<li><strong>' . e($label) . ':</strong> ' . e($text) . '</li>';
    echo '</ul>';
    if ($afterHtml !== '') echo '<p class="case-intro">' . $afterHtml . '</p>';
  }
  if (!$paragraphs && !$goals && $afterHtml !== '') echo '<p class="case-intro">' . $afterHtml . '</p>';
  echo '</div></section>';
}

/**
 * Vorgehen: nummerierte Schritte auf hellgrauer Fläche.
 * @param array<int, array{t:string, x:string, html?:string}> $steps Titel, Text, optional sicheres HTML hinter dem Text (z. B. todo())
 */
function case_steps(string $title, array $steps): void {
  echo '<section class="section section--surface" aria-labelledby="case-steps"><div class="wrap"><h2 id="case-steps">' . e($title) . '</h2><ol class="steps">';
  foreach ($steps as $i => $step) {
    echo '<li class="step"><span class="step__num" aria-hidden="true">0' . ($i + 1) . '</span><div><h3>' . e($step['t']) . '</h3>';
    echo '<p>' . e($step['x']) . ($step['html'] ?? '') . '</p></div></li>';
  }
  echo '</ol></div></section>';
}

/**
 * Bilder als horizontaler Slider (Scroll-Snap; Pfeile kommen per JS aus src/ts/modules/slider.ts).
 * Eine Folie ist ein Array: base (Dateiname ohne Endung), alt, caption, w, h; optional xs (true = <base>_xs.webp vorhanden), ext (Fallback-Format, Standard jpg), bare (true = ohne Rahmen/Schatten, z. B. Geräte-Mockup mit transparenten Ecken).
 * @param array<int, array{base:string, alt:string, caption:string, w:int, h:int, xs?:bool, ext?:string, bare?:bool}> $slides
 */
function case_slider(string $label, string $dir, array $slides): void {
  echo '<section class="section slider-section" id="case-slider" aria-label="' . e($label) . '"><div class="wrap"><div class="slider" data-slider>';
  // Pfeile nur mit JS und nur, wenn es etwas zu scrollen gibt (slider.ts blendet sie ein)
  echo '<div class="slider__controls" hidden>';
  echo '<button class="slider__button" type="button" data-slider-prev aria-label="' . e(t('slider.prev')) . '"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m15 18-6-6 6-6"/></svg></button>';
  echo '<button class="slider__button" type="button" data-slider-next aria-label="' . e(t('slider.next')) . '"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m9 18 6-6-6-6"/></svg></button>';
  echo '</div>';
  echo '<div class="slider__track" data-slider-track tabindex="0" role="region" aria-label="' . e($label) . '">';
  foreach ($slides as $slide) {
    $base = e($dir . $slide['base']);
    echo '<figure class="case-figure slider__slide' . (!empty($slide['bare']) ? ' slider__slide--bare' : '') . '"><picture>';
    if (!empty($slide['xs'])) echo '<source type="image/webp" media="(max-width: 700px)" srcset="' . $base . '_xs.webp">';
    echo '<source type="image/webp" srcset="' . $base . '.webp">';
    echo '<img src="' . $base . '.' . e($slide['ext'] ?? 'jpg') . '" alt="' . e($slide['alt']) . '" width="' . $slide['w'] . '" height="' . $slide['h'] . '" loading="lazy" decoding="async">';
    echo '</picture><figcaption>' . e($slide['caption']) . '</figcaption></figure>';
  }
  echo '</div></div></div></section>';
}

/**
 * Video (z. B. Intro einer alten Flash-Seite): Standard-Player ohne Autoplay, Poster, MP4 und Download-Link als Rückfall.
 * $posterBase ist der Pfad ohne Endung (erwartet <posterBase>.jpg).
 */
function case_video(string $label, string $mp4, string $posterBase, string $caption): void {
  echo '<section class="section" aria-label="' . e($label) . '"><div class="wrap"><figure class="case-figure case-video">';
  echo '<video controls playsinline preload="metadata" poster="' . e($posterBase) . '.jpg" aria-label="' . e($label) . '">';
  echo '<source src="' . e($mp4) . '" type="video/mp4">' . e(t('video.fallback')) . ' <a href="' . e($mp4) . '">' . e(t('video.download')) . '</a>';
  echo '</video><figcaption>' . e($caption) . '</figcaption></figure></div></section>';
}
