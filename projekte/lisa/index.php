<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title'    => t('lisa.meta.title'),
    'desc'     => t('lisa.meta.desc'),
    'og_image' => '/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller.jpg',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$img = '/assets/img/projects/lisa/';
$stack = ['PHP', 'HTML5', 'CSS3', 'Bootstrap 5', 'JavaScript', 'jQuery', 'Schema.org'];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <article aria-labelledby="case-title">

            <!-- Kopf: Eyebrow, H1, Lead, Steckbrief -->
            <header class="page-head page-head--case">
                <div class="wrap">
                    <p class="eyebrow"><?= e(t('lisa.eyebrow')) ?></p>
                    <h1 id="case-title"><?= e(t('lisa.title')) ?></h1>
                    <p class="lead"><?= e(t('lisa.lead')) ?></p>
                    <dl class="case-facts">
                        <div><dt><?= e(t('lisa.facts.period')) ?></dt><dd><?= e(t('lisa.facts.period.v')) ?></dd></div>
                        <div><dt><?= e(t('lisa.facts.role')) ?></dt><dd><?= e(t('lisa.facts.role.v')) ?></dd></div>
                        <div><dt><?= e(t('lisa.facts.team')) ?></dt><dd><?= e(t('lisa.facts.team.v')) ?></dd></div>
                        <div><dt><?= e(t('lisa.facts.live')) ?></dt><dd><a href="https://www.lisa-yashodhara-haller.de/" rel="noopener">lisa-yashodhara-haller.de <span aria-hidden="true">↗</span></a></dd></div>
                    </dl>
                </div>
            </header>

            <!-- Screenshot (enthält bereits den Browser-Rahmen, daher kein eigener Rahmen) -->
            <section class="case-shot" aria-label="<?= e(t('lisa.shot.caption')) ?>">
                <div class="wrap">
                    <figure class="case-figure">
                        <picture>
                            <source type="image/webp" media="(max-width: 700px)" srcset="<?= $img ?>screen-startseite-lisa-yashodhara-haller_xs.webp">
                            <source type="image/webp" srcset="<?= $img ?>screen-startseite-lisa-yashodhara-haller.webp">
                            <img src="<?= $img ?>screen-startseite-lisa-yashodhara-haller.jpg" alt="<?= e(t('lisa.shot.alt')) ?>"
                                width="1200" height="800" fetchpriority="high" decoding="async">
                        </picture>
                        <figcaption><?= e(t('lisa.shot.caption')) ?></figcaption>
                    </figure>
                </div>
            </section>

            <!-- Ergebnis -->
            <section class="section section--band" aria-labelledby="case-results">
                <div class="wrap">
                    <h2 id="case-results"><?= e(t('lisa.results.title')) ?></h2>
                    <ul class="stats">
                        <?php foreach ([1, 2, 3, 4] as $n): ?>
                            <li class="stat">
                                <p class="stat__value"><?= e(t("lisa.results.$n.v")) ?></p>
                                <p class="stat__text"><?= e(t("lisa.results.$n.t")) ?></p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                    <p class="case-note"><?= e(t('lisa.results.note')) ?><?= todo('Tool und Datum der Ausgangsmessung (rund 60 %)', ' ') ?></p>
                </div>
            </section>

            <!-- Ausgangslage + Vorgehen -->
            <section class="section">
                <div class="wrap case-split">
                    <div class="case-split__intro">
                        <h2><?= e(t('lisa.start.title')) ?></h2>
                        <p><?= e(t('lisa.start.1')) ?></p>
                        <p><?= e(t('lisa.start.2')) ?><?= todo('Was störte an der alten Seite? Ein, zwei Sätze', ' ') ?></p>
                    </div>
                    <div class="case-split__main">
                        <h2><?= e(t('lisa.steps.title')) ?></h2>
                        <ol class="steps">
                            <?php foreach ([1, 2, 3, 4] as $n): ?>
                                <li class="step">
                                    <span class="step__num" aria-hidden="true">0<?= $n ?></span>
                                    <div>
                                        <h3><?= e(t("lisa.steps.$n.t")) ?></h3>
                                        <p><?= e(t("lisa.steps.$n.x")) ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </section>

            <!-- Weiteres Bild -->
            <section class="section section--surface" aria-label="<?= e(t('lisa.about.caption')) ?>">
                <div class="wrap">
                    <figure class="case-figure case-figure--narrow">
                        <picture>
                            <source type="image/webp" srcset="<?= $img ?>screen-lisa-about-page.webp">
                            <img src="<?= $img ?>screen-lisa-about-page.jpg" alt="<?= e(t('lisa.about.alt')) ?>"
                                width="1200" height="800" loading="lazy" decoding="async">
                        </picture>
                        <figcaption><?= e(t('lisa.about.caption')) ?></figcaption>
                    </figure>
                </div>
            </section>

            <?php // Kundenstimme: live erst mit echtem Zitat. Aktuell erfundener Platzhalter (home.quote.text) – darf NICHT live gehen. ?>
            <?php if (is_dev()): ?>
                <section class="quote case-quote" aria-label="<?= e(t('home.quote.label')) ?>">
                    <figure class="wrap">
                        <blockquote><p><mark class="todo">„<?= e(t('home.quote.text')) ?>“</mark></p></blockquote>
                        <figcaption><?= e(t('project.lisa.name')) ?> <?= todo('Funktion, echtes Zitat von Lisa einholen', ' ') ?></figcaption>
                    </figure>
                </section>
            <?php endif; ?>

            <!-- Tech-Stack + weiter -->
            <footer class="section case-foot">
                <div class="wrap case-foot__inner">
                    <div class="case-foot__stack">
                        <h2 class="case-foot__label"><?= e(t('lisa.stack')) ?></h2>
                        <ul class="chip-list">
                            <?php foreach ($stack as $item): ?><li class="chip"><?= e($item) ?></li><?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="case-foot__next">
                        <a class="case-foot__next-link" href="<?= e(url('/projekte/berlin-street-view/')) ?>"><?= e(t('lisa.next')) ?> <span aria-hidden="true">→</span></a>
                        <a class="more-link" href="<?= e(url('/projekte/')) ?>"><?= e(t('lisa.all')) ?></a>
                    </div>
                </div>
            </footer>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
