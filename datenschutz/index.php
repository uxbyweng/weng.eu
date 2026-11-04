<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => t('privacy.meta.title'),
    'desc'  => t('privacy.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

// Abschnitte in dieser Reihenfolge. Texte: includes/i18n/<lang>/privacy.php (Einträge .1, .2, …; "- " am Anfang = Listenpunkt).
$sections = ['controller', 'overview', 'hosting', 'cookies', 'contact', 'external', 'tls', 'recipients', 'rights', 'complaint', 'automated'];

// Was nur der Inhaber liefern kann: erscheint lokal als gelber Hinweis, live gar nicht (siehe todo())
$open = [
    'hosting'    => 'Speicherdauer der Server-Logs beim Hosting-Anbieter (STRATO) eintragen',
    'external'   => 'Betreiber und Hosting von mur-art.de sowie dessen Datenschutzhinweis prüfen',
    'recipients' => 'Konkrete Löschfrist der Server-Logs nennen, sobald bekannt',
];

// Platzhalter in den Texten (alle Werte sind bereits sicheres HTML)
$replace = [
    '{email}'   => '<a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>',
    '{imprint}' => '<a href="' . e(url('/impressum/')) . '">' . e(t('privacy.link.imprint')) . '</a>',
    '{berlin}'  => '<a href="https://www.datenschutz-berlin.de/" rel="noopener">' . e(t('privacy.link.berlin')) . '</a>',
    '{list}'    => '<a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" rel="noopener">' . e(t('privacy.link.list')) . '</a>',
];
$fill = fn(string $text): string => strtr(e($text), $replace);

/** Gibt die Einträge eines Abschnitts als <p> bzw. <ul> aus. */
$renderBody = function (string $id) use ($fill): string {
    $html = '';
    $inList = false;
    for ($i = 1; t_has("privacy.$id.$i"); $i++) {
        $text = t("privacy.$id.$i");
        $isItem = str_starts_with($text, '- ');
        if ($isItem && !$inList) { $html .= "<ul>\n"; $inList = true; }
        if (!$isItem && $inList) { $html .= "</ul>\n"; $inList = false; }
        $html .= $isItem ? '<li>' . $fill(substr($text, 2)) . "</li>\n" : '<p>' . $fill($text) . "</p>\n";

        // Anschrift direkt nach dem einleitenden Satz des Verantwortlichen
        if ($id === 'controller' && $i === 1) {
            $address = array_filter([
                e(t('imprint.name')),
                e(t('imprint.trade')),
                todo('Straße und Hausnummer (wie im Impressum)'),
                e(t('imprint.city')),
                e(t('imprint.country')),
            ]);
            $html .= '<p>' . implode('<br>', $address) . "</p>\n";
        }
    }
    return $html . ($inList ? "</ul>\n" : '');
};
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <header class="page-head">
            <div class="wrap">
                <h1 id="privacy-title"><?= e(t('privacy.title')) ?></h1>
            </div>
        </header>

        <section class="legal-page" aria-labelledby="privacy-title">
            <div class="wrap">
                <div class="legal">
                    <?php foreach ($sections as $id): ?>
                        <h2><?= e(t("privacy.$id.title")) ?></h2>
                        <?= $renderBody($id) ?>
                        <?php if (isset($open[$id]) && ($note = todo($open[$id]))): ?><p><?= $note ?></p><?php endif; ?>
                    <?php endforeach; ?>

                    <?php // Festes Datum: liefert der Inhaber nach der anwaltlichen Prüfung ?>
                    <?php if ($date = todo('Festes Datum der Erklärung (nach anwaltlicher Prüfung)')): ?><p class="legal__date"><?= e(t('privacy.date')) ?> <?= $date ?></p><?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
