<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// MASTER für alle Projektseiten: Aufbau und Bausteine stehen in includes/case-study.php.
$img = '/assets/img/projects/park-klinik/';
$meta = [
    'title'    => t('pkcase.meta.title'),
    'desc'     => t('pkcase.meta.desc'),
    'og_image' => $img . 'screen-startseite-redesign-park-klinik-birkenwerder.jpg',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <article aria-labelledby="case-title">
            <?php
            $shot = ['dir' => $img, 'base' => 'screen-startseite-redesign-park-klinik-birkenwerder', 'alt' => t('pkcase.shot.alt'), 'caption' => t('pkcase.shot.caption')];
            case_head(t('pkcase.eyebrow'), t('pkcase.title'), t('pkcase.lead'), [
                [t('pkcase.facts.period'), e(t('pkcase.facts.period.v'))],
                [t('pkcase.facts.role'), e(t('pkcase.facts.role.v'))],
                [t('pkcase.facts.live'), case_ext_link('https://www.park-klinik-birkenwerder.de/', 'park-klinik-birkenwerder.de')],
            ], $shot);

            case_glance(t('pkcase.results.title'), [
                ['icon' => 'gauge', 'value' => t('pkcase.results.1.v'), 'text' => t('pkcase.results.1.t')],
                ['icon' => 'grid', 'value' => t('pkcase.results.2.v'), 'text' => t('pkcase.results.2.t')],
                ['icon' => 'sliders', 'value' => t('pkcase.results.3.v'), 'text' => t('pkcase.results.3.t')],
                ['icon' => 'languages', 'value' => t('pkcase.results.4.v'), 'text' => t('pkcase.results.4.t')],
            ], ['PHP', 'SQLite', 'Vanilla JavaScript', 'HTML5', 'CSS3', 'JSON-LD'], t('pkcase.stack'));

            case_start(t('pkcase.start.title'), [t('pkcase.start.1'), t('pkcase.start.2')], array_map(
                fn(int $n): array => [t("pkcase.goals.$n.t"), t("pkcase.goals.$n.x")],
                [1, 2, 3, 4]
            ));

            case_steps(t('pkcase.steps.title'), array_map(
                fn(int $n): array => ['t' => t("pkcase.steps.$n.t"), 'x' => t("pkcase.steps.$n.x")],
                [1, 2, 3, 4, 5, 6]
            ));

            case_slider(t('pkcase.slider.label'), $img, array_merge([case_shot_slide($shot)], [
                ['base' => 'screen-startseite-mobile-redesign-park-klinik-birkenwerder', 'alt' => t('pkcase.mobile.alt'), 'caption' => t('pkcase.mobile.caption'), 'w' => 600, 'h' => 1338],
                ['base' => 'screen-brustvergroesserung-eigenfett-park-klinik-birkenwerder', 'alt' => t('pkcase.treatment.alt'), 'caption' => t('pkcase.treatment.caption'), 'w' => 1400, 'h' => 933, 'xs' => true],
                ['base' => 'screen-newsbeitrag-dgpraec-park-klinik-birkenwerder', 'alt' => t('pkcase.news.alt'), 'caption' => t('pkcase.news.caption'), 'w' => 1400, 'h' => 933, 'xs' => true],
                ['base' => 'screen-living-styleguide-park-klinik-birkenwerder', 'alt' => t('pkcase.guide.alt'), 'caption' => t('pkcase.guide.caption'), 'w' => 1400, 'h' => 788, 'xs' => true],
            ]));
            ?>

            <?php // Kundenstimme: Originalzitat aus der E-Mail der Chefärztin (23.10.), auf Deutsch; EN ist eine Übersetzung ?>
            <section class="quote case-quote" aria-label="<?= e(t('home.quote.label')) ?>">
                <figure class="wrap">
                    <blockquote><p>„<?= e(t('pkcase.quote.text')) ?>“</p></blockquote>
                    <figcaption><?= e(t('pkcase.quote.name')) ?>, <?= e(t('pkcase.quote.role')) ?> · <?= e(t('project.pk.name')) ?> · <time datetime="2026-10-23"><?= e(t('pkcase.quote.date')) ?></time></figcaption>
                </figure>
            </section>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
