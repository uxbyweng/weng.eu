<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

// Fehlerseite 500 (per ErrorDocument in .htaccess). Nicht indexieren.
$meta = [
    'title'  => t('error.500.meta'),
    'desc'   => t('error.500.text'),
    'robots' => 'noindex, follow',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <section class="page-head" aria-labelledby="error-title">
            <div class="wrap">
                <p class="eyebrow">500</p>
                <h1 id="error-title"><?= e(t('error.500.title')) ?></h1>
                <p class="lead"><?= e(t('error.500.text')) ?></p>
                <div class="hero__actions">
                    <a class="button" href="<?= e(url('/')) ?>"><?= e(t('error.home')) ?></a>
                    <a class="button button--secondary" href="<?= e(url('/projekte/')) ?>"><?= e(t('error.projects')) ?></a>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
