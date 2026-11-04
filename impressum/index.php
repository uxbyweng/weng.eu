<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => t('imprint.meta.title'),
    'desc'  => t('imprint.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$mail = '<a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>';
$logoLink = '<a href="https://teenck.design/" rel="noopener">Till Teenck</a>';

// Anschrift: Straße und Hausnummer liefert der Inhaber (live entfällt die Zeile, siehe todo())
$address = array_filter([
    e(t('imprint.name')),
    e(t('imprint.trade')),
    todo('Straße und Hausnummer'),
    e(t('imprint.city')),
    e(t('imprint.country')),
]);
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
                    <p><?= e(t('imprint.contact.email')) ?> <?= $mail ?><?php if ($phone = todo('Telefonnummer (optional)')): ?><br><?= e(t('imprint.contact.phone')) ?> <?= $phone ?><?php endif; ?></p>

                    <h2><?= e(t('imprint.vat.title')) ?></h2>
                    <p><?= e(t('imprint.vat.text')) ?></p>

                    <h2><?= e(t('imprint.content.title')) ?></h2>
                    <p><?= e(t('imprint.content.text')) ?></p>

                    <h2><?= e(t('imprint.dispute.title')) ?></h2>
                    <p><?= e(t('imprint.dispute.text')) ?></p>

                    <h2><?= e(t('imprint.copyright.title')) ?></h2>
                    <?php if ($license = todo('Eine Variante wählen: „Alle Rechte vorbehalten“ oder CC BY-SA 4.0 – im Footer identisch')): ?><p><?= $license ?></p><?php endif; ?>
                    <p><?= str_replace('{link}', $logoLink, e(t('imprint.logo'))) ?></p>

                    <h2><?= e(t('imprint.hosting.title')) ?></h2>
                    <p><?= e(t('imprint.hosting.text')) ?></p>

                    <?php // Festes Datum statt dynamischem "Stand": liefert der Inhaber nach der rechtlichen Prüfung ?>
                    <?php if ($date = todo('Festes Datum der letzten Prüfung')): ?><p class="legal__date"><?= e(t('imprint.date')) ?> <?= $date ?></p><?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
