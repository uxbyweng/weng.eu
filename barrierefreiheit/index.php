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

$replace = [
    '{mail}' => '<a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>',
    '{form}' => '<a href="' . e(url('/kontakt/')) . '">' . e(t('a11y.feedback.form')) . '</a>',
];
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
                    <p><?= e(t('a11y.status.1')) ?></p>

                    <h2><?= e(t('a11y.done.title')) ?></h2>
                    <ul>
                        <?php foreach ([1, 2, 3, 4, 5] as $n): ?>
                            <li><?= e(t("a11y.done.$n")) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h2><?= e(t('a11y.unchecked.title')) ?></h2>
                    <ul>
                        <?php foreach ([1, 2, 3] as $n): ?>
                            <li><?= e(t("a11y.unchecked.$n")) ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <h2><?= e(t('a11y.feedback.title')) ?></h2>
                    <p><?= strtr(e(t('a11y.feedback.text')), $replace) ?></p>

                    <p><?= e(t('a11y.voluntary')) ?></p>
                    <?php // Festes Datum: bei jeder inhaltlichen Änderung der Erklärung aktualisieren ?>
                    <p class="legal__date"><?= e(t('a11y.date')) ?> <time datetime="2026-11"><?= e(t('a11y.date.value')) ?></time></p>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
