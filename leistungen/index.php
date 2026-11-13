<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => t('services.meta.title'),
    'desc'  => t('services.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

// Schwerpunkte: Anzahl Stichpunkte und Beispiel-Links (Pfad, Textschlüssel)
$services = [
    1 => ['items' => 4, 'examples' => [['/projekte/park-klinik/', 'services.1.e1']]],
    2 => ['items' => 5, 'examples' => [['/projekte/strato/', 'services.2.e1']]],
    3 => ['items' => 4, 'examples' => [['/projekte/park-klinik/', 'services.3.e1'], ['/projekte/lisa/', 'services.3.e2']]],
];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <section class="page-head page-head--services" aria-labelledby="services-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('services.eyebrow')) ?></p>
                <h1 id="services-title"><?= e(t('services.title')) ?></h1>
                <p class="lead"><?= e(t('services.lead')) ?></p>
            </div>
        </section>

        <section class="offers" aria-label="<?= e(t('services.list.label')) ?>">
            <div class="wrap"><div class="offers__list">
                <?php foreach ($services as $n => $service): ?>
                    <article class="offer">
                        <div class="offer__main">
                            <p class="offer__num" aria-hidden="true">0<?= $n ?></p>
                            <h2><?= e(t("services.$n.title")) ?></h2>
                            <p><?= e(t("services.$n.text")) ?></p>
                        </div>
                        <div class="offer__aside">
                            <h3 class="offer__label"><?= e(t('services.includes')) ?></h3>
                            <ul>
                                <?php for ($i = 1; $i <= $service['items']; $i++): ?>
                                    <li><?= e(t("services.$n.i$i")) ?></li>
                                <?php endfor; ?>
                            </ul>
                            <p class="offer__examples"><?= e(t('services.example')) ?>
                                <?php foreach ($service['examples'] as $k => [$href, $key]): ?>
                                    <?= $k > 0 ? ' · ' : '' ?><a href="<?= e(url($href)) ?>"><?= e(t($key)) ?> <?= chevron_icon() ?></a>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div></div>
        </section>

        <section class="section section--surface" aria-labelledby="process-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('services.process.eyebrow')) ?></p>
                <h2 id="process-title"><?= e(t('services.process.title')) ?></h2>
                <ol class="process">
                    <?php foreach ([1, 2, 3, 4] as $n): ?>
                        <li class="card process__step">
                            <p class="process__num" aria-hidden="true"><?= $n ?></p>
                            <h3><?= e(t("services.process.$n.t")) ?></h3>
                            <p><?= e(t("services.process.$n.x")) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
