<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$img = '/assets/img/projects/park-klinik/';
$meta = [
    'title'    => t('pkcase.meta.title'),
    'desc'     => t('pkcase.meta.desc'),
    'og_image' => $img . 'screen-startseite-redesign-park-klinik-birkenwerder.jpg',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$stack = ['PHP', 'SQLite', 'Vanilla JavaScript', 'HTML5', 'CSS3', 'JSON-LD'];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <article aria-labelledby="case-title">

            <!-- Kopf: Eyebrow, H1, Lead, Steckbrief -->
            <header class="page-head page-head--case">
                <div class="wrap">
                    <p class="eyebrow"><?= e(t('pkcase.eyebrow')) ?></p>
                    <h1 id="case-title"><?= e(t('pkcase.title')) ?></h1>
                    <p class="lead"><?= e(t('pkcase.lead')) ?></p>
                    <dl class="case-facts">
                        <div><dt><?= e(t('pkcase.facts.period')) ?></dt><dd><?= e(t('pkcase.facts.period.v')) ?><?= todo('Jahr des Relaunchs', is_en() ? ' · relaunch ' : ' · Relaunch ') ?></dd></div>
                        <div><dt><?= e(t('pkcase.facts.role')) ?></dt><dd><?= e(t('pkcase.facts.role.v')) ?></dd></div>
                        <div><dt><?= e(t('pkcase.facts.team')) ?></dt><dd><?= e(t('pkcase.facts.team.v')) ?></dd></div>
                        <div><dt><?= e(t('pkcase.facts.live')) ?></dt><dd><a href="https://www.park-klinik-birkenwerder.de/" rel="noopener">park-klinik-birkenwerder.de <span aria-hidden="true">↗</span></a></dd></div>
                    </dl>
                </div>
            </header>

            <!-- Screenshot (enthält bereits den Browser-Rahmen, daher kein eigener Rahmen) -->
            <section class="case-shot" aria-label="<?= e(t('pkcase.shot.caption')) ?>">
                <div class="wrap">
                    <figure class="case-figure">
                        <picture>
                            <source type="image/webp" media="(max-width: 700px)" srcset="<?= $img ?>screen-startseite-redesign-park-klinik-birkenwerder_xs.webp">
                            <source type="image/webp" srcset="<?= $img ?>screen-startseite-redesign-park-klinik-birkenwerder.webp">
                            <img src="<?= $img ?>screen-startseite-redesign-park-klinik-birkenwerder.jpg" alt="<?= e(t('pkcase.shot.alt')) ?>"
                                width="1200" height="800" fetchpriority="high" decoding="async">
                        </picture>
                        <figcaption><?= e(t('pkcase.shot.caption')) ?></figcaption>
                    </figure>
                </div>
            </section>

            <!-- Ergebnis -->
            <section class="section section--band" aria-labelledby="case-results">
                <div class="wrap">
                    <h2 id="case-results"><?= e(t('pkcase.results.title')) ?></h2>
                    <ul class="stats">
                        <?php foreach ([1, 2, 3] as $n): ?>
                            <li class="stat">
                                <p class="stat__value"><?= e(t("pkcase.results.$n.v")) ?></p>
                                <p class="stat__text"><?= e(t("pkcase.results.$n.t")) ?></p>
                            </li>
                        <?php endforeach; ?>
                        <?php // Lighthouse vorher → nachher liefert der Inhaber (live erscheint die Kennzahl erst mit Wert) ?>
                        <?php if ($lighthouse = todo('Lighthouse vorher → nachher, Desktop und Mobile')): ?>
                            <li class="stat">
                                <p class="stat__value"><?= e(t('pkcase.results.4.v')) ?></p>
                                <p class="stat__text"><?= $lighthouse ?></p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </section>

            <!-- Ausgangslage + Vorgehen -->
            <section class="section">
                <div class="wrap case-split">
                    <div class="case-split__intro">
                        <h2><?= e(t('pkcase.start.title')) ?></h2>
                        <p><?= e(t('pkcase.start.1')) ?><?= todo('Was war das Problem der alten Seite? Zwei, drei Sätze, z. B. schwer pflegbar, langsam auf dem Smartphone, nur einsprachig', ' ') ?></p>
                    </div>
                    <div class="case-split__main">
                        <h2><?= e(t('pkcase.steps.title')) ?></h2>
                        <ol class="steps">
                            <?php foreach ([1, 2, 3, 4] as $n): ?>
                                <li class="step">
                                    <span class="step__num" aria-hidden="true">0<?= $n ?></span>
                                    <div>
                                        <h3><?= e(t("pkcase.steps.$n.t")) ?></h3>
                                        <p><?= e(t("pkcase.steps.$n.x")) ?></p>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                </div>
            </section>

            <!-- Vorher-Vergleich -->
            <section class="section section--surface" aria-label="<?= e(t('pkcase.before.caption')) ?>">
                <div class="wrap">
                    <figure class="case-figure case-figure--narrow">
                        <picture>
                            <source type="image/webp" media="(max-width: 700px)" srcset="<?= $img ?>screen-startseite-park-klinik-birkenwerder_xs.webp">
                            <source type="image/webp" srcset="<?= $img ?>screen-startseite-park-klinik-birkenwerder.webp">
                            <img src="<?= $img ?>screen-startseite-park-klinik-birkenwerder.jpg" alt="<?= e(t('pkcase.before.alt')) ?>"
                                width="1200" height="800" loading="lazy" decoding="async">
                        </picture>
                        <figcaption><?= e(t('pkcase.before.caption')) ?></figcaption>
                    </figure>
                    <?php if ($open = todo('Noch offen: Handy-Screenshot der neuen Startseite und Auszug aus dem Living Styleguide')): ?>
                        <p class="case-note"><?= $open ?></p>
                    <?php endif; ?>
                </div>
            </section>

            <?php // Kundenstimme: live erst mit echtem Zitat der Klinik – nichts erfinden, bis der Inhaber es liefert ?>
            <?php if (is_dev()): ?>
                <section class="quote case-quote" aria-label="<?= e(t('home.quote.label')) ?>">
                    <figure class="wrap">
                        <blockquote><p>„<?= todo('Zitat aus der Klinik – zwei Sätze zur Zusammenarbeit oder zum Ergebnis.') ?>“</p></blockquote>
                        <figcaption><?= todo('Name, Funktion') ?> · <?= e(t('project.pk.name')) ?></figcaption>
                    </figure>
                </section>
            <?php endif; ?>

            <!-- Tech-Stack + weiter -->
            <footer class="section case-foot">
                <div class="wrap case-foot__inner">
                    <div class="case-foot__stack">
                        <h2 class="case-foot__label"><?= e(t('pkcase.stack')) ?></h2>
                        <ul class="chip-list">
                            <?php foreach ($stack as $item): ?><li class="chip"><?= e($item) ?></li><?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="case-foot__next">
                        <a class="case-foot__next-link" href="<?= e(url('/projekte/strato/')) ?>"><?= e(t('pkcase.next')) ?> <span aria-hidden="true">→</span></a>
                        <a class="more-link" href="<?= e(url('/projekte/')) ?>"><?= e(t('pkcase.all')) ?></a>
                    </div>
                </div>
            </footer>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
