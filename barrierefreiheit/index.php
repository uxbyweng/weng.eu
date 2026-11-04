<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => t('a11y.meta.title'),
    'desc'  => t('a11y.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$mail = '<a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>';
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <header class="page-head page-head--case">
            <div class="wrap">
                <h1 id="a11y-title"><?= e(t('a11y.title')) ?></h1>
                <p class="lead"><?= e(t('a11y.lead')) ?></p>
            </div>
        </header>

        <section class="legal-page" aria-labelledby="a11y-title">
            <div class="wrap">
                <div class="legal">
                    <h2><?= e(t('a11y.status.title')) ?></h2>
                    <p><?= e(t('a11y.status.text')) ?><?= todo('Aussage zur Vereinbarkeit (z. B. „weitgehend vereinbar“) nach eigener Prüfung bestätigen', ' ') ?></p>

                    <h2><?= e(t('a11y.done.title')) ?></h2>
                    <ul>
                        <?php foreach ([1, 2, 3, 4, 5, 6] as $n): ?>
                            <li><?= e(t("a11y.done.$n")) ?><?= $n === 3 ? todo('Kontraste im dunklen Modus prüfen', ' ') : '' ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <?php // Einschränkungen und Prüfmethode liefert der Inhaber nach seiner Prüfung (live erscheinen die Abschnitte erst mit Inhalt) ?>
                    <?php if ($limits = todo('Bekannte Einschränkungen, z. B. ältere Projekt-Screenshots ohne ausführliche Beschreibung')): ?>
                        <h2><?= e(t('a11y.limits.title')) ?></h2>
                        <p><?= $limits ?></p>
                    <?php endif; ?>

                    <?php if ($method = todo('Werkzeuge und Datum, z. B. axe DevTools, WAVE, Lighthouse, Tastatur, Screenreader NVDA/VoiceOver')): ?>
                        <h2><?= e(t('a11y.method.title')) ?></h2>
                        <p><?= $method ?></p>
                    <?php endif; ?>

                    <h2><?= e(t('a11y.feedback.title')) ?></h2>
                    <p><?= str_replace('{link}', $mail, e(t('a11y.feedback.text'))) ?></p>

                    <?php if ($date = todo('Datum der Erklärung')): ?><p class="legal__date"><?= e(t('a11y.date')) ?> <?= $date ?></p><?php endif; ?>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
