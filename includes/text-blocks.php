<?php
declare(strict_types=1);

/**
 * render_text_blocks($prefix, $replace, $after)
 * Gibt fortlaufende Texte aus den Sprachdateien als <p> bzw. <ul> aus: $prefix.1, $prefix.2, …
 * - Ein Eintrag, der mit "- " beginnt, ist ein Listenpunkt; aufeinanderfolgende Listenpunkte bilden eine Liste.
 * - Zeilenumbrüche innerhalb eines Eintrags werden zu <br> (Leichte Sprache: ein Satz pro Zeile).
 * - $replace: Platzhalter => bereits sicheres HTML (z. B. ['{email}' => '<a href="mailto:…">…</a>']).
 * - $after($i): optional, liefert HTML, das direkt nach Eintrag $i eingefügt wird (z. B. eine Anschrift).
 * Genutzt von der Datenschutzerklärung und der Seite in Leichter Sprache.
 */
function render_text_blocks(string $prefix, array $replace = [], ?callable $after = null): string {
  $html = '';
  $inList = false;
  for ($i = 1; t_has("$prefix.$i"); $i++) {
    $text = t("$prefix.$i");
    $isItem = str_starts_with($text, '- ');
    if ($isItem && !$inList) { $html .= "<ul>\n"; $inList = true; }
    if (!$isItem && $inList) { $html .= "</ul>\n"; $inList = false; }
    $safe = nl2br(strtr(e($isItem ? substr($text, 2) : $text), $replace), false);
    $html .= $isItem ? "<li>$safe</li>\n" : "<p>$safe</p>\n";
    if ($after !== null) $html .= (string)$after($i);
  }
  return $html . ($inList ? "</ul>\n" : '');
}
