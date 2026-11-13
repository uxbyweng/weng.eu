<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title'  => t('imprint.meta.title'),
    'desc'   => t('imprint.meta.desc'),
    'robots' => 'noindex, follow', // Impressum soll nicht in Suchergebnissen erscheinen
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$mail = '<a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>';
$logoLink = '<a href="https://teenck.design/" target="_blank" rel="noopener noreferrer">Till Teenck' . new_window_hint() . '</a>';

$address = [
    e(t('imprint.name')),
    e(t('imprint.trade')),
    e(t('imprint.street')),
    e(t('imprint.city')),
    e(t('imprint.country')),
];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <header class="page-head">
            <div class="wrap">
                <h1 id="imprint-title"><?= e(t('imprint.title')) ?></h1>
            </div>
        </header>

        <section class="legal-page" aria-labelledby="imprint-title">
            <div class="wrap">
                <div class="legal">
                    <h2><?= e(t('imprint.address.title')) ?></h2>
                    <p><?= implode('<br>', $address) ?></p>

                    <h2><?= e(t('imprint.contact.title')) ?></h2>
                    <p><?= e(t('imprint.contact.email')) ?> <?= $mail ?></p>

                    <h2><?= e(t('imprint.vat.title')) ?></h2>
                    <p><?= e(t('imprint.vat.text')) ?></p>

                    <h2><?= e(t('imprint.content.title')) ?></h2>
                    <p><?= e(t('imprint.content.text')) ?></p>

                    <h2><?= e(t('imprint.dispute.title')) ?></h2>
                    <p><?= e(t('imprint.dispute.text')) ?></p>

                    <h2><?= e(t('imprint.copyright.title')) ?></h2>
                    <p><?= e(t('imprint.copyright.1')) ?></p>
                    <p><?= e(t('imprint.copyright.2')) ?></p>
                    <p><?= str_replace('{link}', $logoLink, e(t('imprint.logo'))) ?></p>

                    <h2><?= e(t('imprint.hosting.title')) ?></h2>
                    <p><?= e(t('imprint.hosting.text')) ?></p>

                    <?php // Festes Datum statt dynamischem "Stand": bei jeder inhaltlichen Änderung des Impressums aktualisieren ?>
                    <p class="legal__date"><?= e(t('imprint.date')) ?> <time datetime="2026-11-13"><?= e(t('imprint.date.value')) ?></time></p>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
