<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/text-blocks.php';

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

// Anschrift direkt nach dem einleitenden Satz des Verantwortlichen
$addressAfter = fn(int $i): string => $i === 1
    ? '<p>' . implode('<br>', array_filter([
        e(t('imprint.name')),
        e(t('imprint.trade')),
        todo('Straße und Hausnummer (wie im Impressum)'),
        e(t('imprint.city')),
        e(t('imprint.country')),
    ])) . '</p>'
    : '';
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
                    <?php if (t('privacy.notice') !== ''): ?><p class="legal__note"><?= e(t('privacy.notice')) ?></p><?php endif; ?>
                    <?php foreach ($sections as $id): ?>
                        <h2><?= e(t("privacy.$id.title")) ?></h2>
                        <?= render_text_blocks("privacy.$id", $replace, $id === 'controller' ? $addressAfter : null) ?>
                        <?php if (isset($open[$id]) && ($note = todo($open[$id]))): ?><p><?= $note ?></p><?php endif; ?>
                    <?php endforeach; ?>

                    <?php // Festes Datum: liefert der Inhaber nach der anwaltlichen Prüfung ?>
                    <?php if ($date = todo('Festes Datum der Erklärung (nach anwaltlicher Prüfung)')): ?><p class="legal__date"><?= e(t('privacy.date')) ?> <?= $date ?></p><?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
