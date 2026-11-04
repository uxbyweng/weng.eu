<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$img = '/assets/img/projects/strato/';
$meta = [
    'title'    => t('strato.meta.title'),
    'desc'     => t('strato.meta.desc'),
    'og_image' => $img . 'screen-startseite-strato-april-2024.jpg',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$stack = ['Bootstrap 5', 'Eleventy', 'Nunjucks', 'GitLab', 'Jenkins', 'Imperia CMS', 'Strapi', 'Jira', 'Confluence', 'Figma'];
$phases = [1 => 3, 2 => 4]; // Phase => Anzahl Stichpunkte
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <article aria-labelledby="case-title">

            <!-- Kopf: Eyebrow, H1, Lead, Steckbrief -->
            <header class="page-head page-head--case">
                <div class="wrap">
                    <p class="eyebrow"><?= e(t('strato.eyebrow')) ?></p>
                    <h1 id="case-title"><?= e(t('strato.title')) ?></h1>
                    <p class="lead"><?= e(t('strato.lead')) ?></p>
                    <dl class="case-facts">
                        <div><dt><?= e(t('strato.facts.period')) ?></dt><dd><?= e(t('strato.facts.period.v')) ?></dd></div>
                        <div><dt><?= e(t('strato.facts.role')) ?></dt><dd><?= e(t('strato.facts.role.v')) ?></dd></div>
                        <div><dt><?= e(t('strato.facts.team')) ?></dt><dd><?= e(t('strato.facts.team.v')) ?></dd></div>
                        <div><dt><?= e(t('strato.facts.live')) ?></dt><dd><a href="https://www.strato.de" rel="noopener">strato.de <span aria-hidden="true">↗</span></a></dd></div>
                    </dl>
                </div>
            </header>

            <!-- Screenshot (enthält bereits den Browser-Rahmen, daher kein eigener Rahmen) -->
            <section class="case-shot" aria-label="<?= e(t('strato.shot.caption')) ?>">
                <div class="wrap">
                    <figure class="case-figure">
                        <picture>
                            <source type="image/webp" media="(max-width: 700px)" srcset="<?= $img ?>screen-startseite-strato-april-2024_xs.webp">
                            <source type="image/webp" srcset="<?= $img ?>screen-startseite-strato-april-2024.webp">
                            <img src="<?= $img ?>screen-startseite-strato-april-2024.jpg" alt="<?= e(t('strato.shot.alt')) ?>"
                                width="1200" height="800" fetchpriority="high" decoding="async">
                        </picture>
                        <figcaption><?= e(t('strato.shot.caption')) ?></figcaption>
                    </figure>
                </div>
            </section>

            <!-- Was ich bewegt habe -->
            <section class="section section--band" aria-labelledby="case-results">
                <div class="wrap">
                    <h2 id="case-results"><?= e(t('strato.results.title')) ?></h2>
                    <ul class="stats">
                        <?php foreach ([1, 2, 3] as $n): ?>
                            <li class="stat">
                                <p class="stat__value"><?= e(t("strato.results.$n.v")) ?></p>
                                <?php // Ausgangswert und Tool des Accessibility-Scores liefert der Inhaber (live leer, siehe todo()) ?>
                                <p class="stat__text"><?= e(t("strato.results.$n.t")) ?><?= $n === 2 ? todo('Ausgangswert und Tool', ' ') : '' ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </section>

            <!-- Zwei Phasen -->
            <section class="section" aria-labelledby="case-phases">
                <div class="wrap">
                    <h2 id="case-phases"><?= e(t('strato.phases.title')) ?></h2>
                    <div class="phases">
                        <?php foreach ($phases as $phase => $count): ?>
                            <article class="card phase">
                                <p class="phase__period"><?= e(t("strato.phase$phase.period")) ?></p>
                                <h3><?= e(t("strato.phase$phase.title")) ?></h3>
                                <ul>
                                    <?php for ($i = 1; $i <= $count; $i++): ?>
                                        <li><?= e(t("strato.phase$phase.$i")) ?></li>
                                    <?php endfor; ?>
                                </ul>
                            </article>
                        <?php endforeach; ?>
                    </div>

                    <figure class="case-figure case-figure--spaced">
                        <picture>
                            <source type="image/webp" media="(max-width: 700px)" srcset="<?= $img ?>screen-strato-woocommerce-ausschnitt-mai-2024_xs.webp">
                            <source type="image/webp" srcset="<?= $img ?>screen-strato-woocommerce-ausschnitt-mai-2024.webp">
                            <img src="<?= $img ?>screen-strato-woocommerce-ausschnitt-mai-2024.jpg" alt="<?= e(t('strato.woo.alt')) ?>"
                                width="1200" height="675" loading="lazy" decoding="async">
                        </picture>
                        <figcaption><?= e(t('strato.woo.caption')) ?></figcaption>
                    </figure>
                </div>
            </section>

            <?php // Referenz: live erst mit echter Empfehlung (z. B. LinkedIn) – nichts erfinden, bis der Inhaber sie liefert ?>
            <?php if (is_dev()): ?>
                <section class="quote case-quote" aria-label="<?= e(t('home.quote.label')) ?>">
                    <figure class="wrap">
                        <blockquote><p>„<?= todo('Empfehlung einer ehemaligen Teamleitung, z. B. von LinkedIn') ?>“</p></blockquote>
                        <figcaption><?= todo('Name, Funktion') ?> · STRATO</figcaption>
                    </figure>
                </section>
            <?php endif; ?>

            <!-- Tech-Stack + weiter -->
            <footer class="section case-foot">
                <div class="wrap case-foot__inner">
                    <div class="case-foot__stack">
                        <h2 class="case-foot__label"><?= e(t('strato.stack')) ?></h2>
                        <ul class="chip-list">
                            <?php foreach ($stack as $item): ?><li class="chip"><?= e($item) ?></li><?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="case-foot__next">
                        <a class="case-foot__next-link" href="<?= e(url('/projekte/lisa/')) ?>"><?= e(t('strato.next')) ?> <span aria-hidden="true">→</span></a>
                        <a class="more-link" href="<?= e(url('/projekte/')) ?>"><?= e(t('strato.all')) ?></a>
                    </div>
                </div>
            </footer>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
