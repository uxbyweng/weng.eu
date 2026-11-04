<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/text-blocks.php';

$meta = [
    'title' => t('easy.meta.title'),
    'desc'  => t('easy.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

// Platzhalter in den Texten (bereits sicheres HTML)
$replace = [
    '{email}' => '<a href="mailto:' . e(SITE_EMAIL) . '">' . e(SITE_EMAIL) . '</a>',
    '{form}'  => '<a href="' . e(url('/kontakt/')) . '">' . e(t('easy.contact.form')) . '</a>',
];

// Beispiele: Kürzel (Textschlüssel easy.ex.<id>.*), Bildpfad ohne Endung, Projektseite
$examples = [
    ['pk',     'park-klinik/screen-startseite-redesign-park-klinik-birkenwerder', '/projekte/park-klinik/'],
    ['strato', 'strato/screen-startseite-strato-april-2024',                      '/projekte/strato/'],
    ['lisa',   'lisa/screen-startseite-lisa-yashodhara-haller',                   '/projekte/lisa/'],
    ['pd',     'pangolin-doxx/screen-startseite-pangolin-doxx',                   '/projekte/pangolin-doxx/'],
];
$dir = '/assets/img/projects/';
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <!-- Hero: Text + Foto (Aufbau wie bei "Über mich") -->
        <section class="about-hero" aria-labelledby="easy-title">
            <div class="wrap about-hero__inner">
                <div class="about-hero__text">
                    <p class="eyebrow"><?= e(t('easy.eyebrow')) ?></p>
                    <h1 id="easy-title"><?= e(t('easy.title')) ?></h1>
                    <div class="easy-text easy-text--lead">
                        <?= render_text_blocks('easy.intro', $replace) ?>
                    </div>
                    <p class="easy-hero__link"><a class="more-link" href="<?= e(url('/')) ?>"><?= e(t('easy.normal')) ?> <span aria-hidden="true">→</span></a></p>
                </div>
                <figure class="about-hero__figure">
                    <img src="/assets/img/home/weng_profile_1040x1300.webp"
                        srcset="/assets/img/home/weng_profile_520x650.webp 520w, /assets/img/home/weng_profile_1040x1300.webp 1040w"
                        sizes="(max-width: 460px) 100vw, 460px" alt="<?= e(t('easy.portrait.alt')) ?>" width="1040" height="1300" fetchpriority="high" decoding="async">
                </figure>
            </div>
        </section>

        <!-- Wer bin ich? -->
        <section class="section easy-section" aria-labelledby="easy-who">
            <div class="wrap">
                <h2 id="easy-who"><?= e(t('easy.who.title')) ?></h2>
                <div class="easy-text"><?= render_text_blocks('easy.who', $replace) ?></div>
            </div>
        </section>

        <!-- Was mache ich? + Erklärung "barrierefrei" -->
        <section class="section section--surface easy-section" aria-labelledby="easy-work">
            <div class="wrap">
                <h2 id="easy-work"><?= e(t('easy.work.title')) ?></h2>
                <div class="easy-text"><?= render_text_blocks('easy.work', $replace) ?></div>

                <aside class="easy-box" aria-labelledby="easy-barrier">
                    <h3 id="easy-barrier"><?= e(t('easy.barrier.title')) ?></h3>
                    <div class="easy-text"><?= render_text_blocks('easy.barrier', $replace) ?></div>
                </aside>
            </div>
        </section>

        <!-- Beispiele -->
        <section class="section easy-section" aria-labelledby="easy-examples">
            <div class="wrap">
                <h2 id="easy-examples"><?= e(t('easy.examples.title')) ?></h2>
                <div class="easy-examples">
                    <?php foreach ($examples as [$id, $image, $href]): ?>
                        <article class="easy-example">
                            <picture>
                                <source type="image/webp" srcset="<?= e($dir . $image) ?>_xs.webp 600w, <?= e($dir . $image) ?>.webp 1200w" sizes="(min-width: 800px) 40vw, 100vw">
                                <img class="project-media" src="<?= e($dir . $image) ?>.jpg" alt="<?= e(t("easy.ex.$id.alt")) ?>" width="1200" height="800" loading="lazy" decoding="async">
                            </picture>
                            <h3><?= e(t("easy.ex.$id.title")) ?></h3>
                            <div class="easy-text"><?= render_text_blocks("easy.ex.$id", $replace) ?></div>
                            <a class="project-link" href="<?= e(url($href)) ?>"><?= e(t('easy.examples.link')) ?><span class="visually-hidden">: <?= e(t("easy.ex.$id.title")) ?></span> <span aria-hidden="true">→</span></a>
                        </article>
                    <?php endforeach; ?>
                </div>
                <p class="easy-examples__note easy-text"><?= nl2br(e(t('easy.examples.note')), false) ?></p>
            </div>
        </section>

        <!-- Kontakt -->
        <section class="section section--surface easy-section easy-contact" aria-labelledby="easy-contact">
            <div class="wrap">
                <h2 id="easy-contact"><?= e(t('easy.contact.title')) ?></h2>
                <div class="easy-text"><?= render_text_blocks('easy.contact', $replace) ?></div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
