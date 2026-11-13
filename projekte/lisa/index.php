<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php).
$img = '/assets/img/projects/lisa/';
$meta = [
    'title'    => t('lisa.meta.title'),
    'desc'     => t('lisa.meta.desc'),
    'og_image' => $img . 'screen-startseite-lisa-yashodhara-haller.jpg',
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
            $shot = ['dir' => $img, 'base' => 'screen-startseite-lisa-yashodhara-haller', 'alt' => t('lisa.shot.alt'), 'caption' => t('lisa.shot.caption')];
            case_head(t('lisa.eyebrow'), t('lisa.title'), t('lisa.lead'), [
                [t('lisa.facts.period'), e(t('lisa.facts.period.v'))],
                [t('lisa.facts.role'), e(t('lisa.facts.role.v'))],
                [t('lisa.facts.live'), case_ext_link('https://www.lisa-yashodhara-haller.de/', 'lisa-yashodhara-haller.de')],
            ], $shot);

            case_glance(t('lisa.results.title'), [
                ['icon' => 'monitor', 'value' => t('lisa.results.1.v'), 'text' => t('lisa.results.1.t')],
                ['icon' => 'smartphone', 'value' => t('lisa.results.2.v'), 'text' => t('lisa.results.2.t')],
                ['icon' => 'shield', 'value' => t('lisa.results.3.v'), 'text' => t('lisa.results.3.t')],
                ['icon' => 'lock', 'value' => t('lisa.results.4.v'), 'text' => t('lisa.results.4.t')],
            ], ['PHP', 'HTML5', 'CSS3', 'Bootstrap 5', 'JavaScript', 'jQuery', 'Schema.org'], t('lisa.stack'), e(t('lisa.results.note')));

            case_start(t('lisa.start.title'), [t('lisa.start.1'), t('lisa.start.2')]);

            case_steps(t('lisa.steps.title'), array_map(
                fn(int $n): array => ['t' => t("lisa.steps.$n.t"), 'x' => t("lisa.steps.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('lisa.slider.label'), $img, array_merge([case_shot_slide($shot)], [
                ['base' => 'screen-lisa-about-page', 'alt' => t('lisa.about.alt'), 'caption' => t('lisa.about.caption'), 'w' => 1200, 'h' => 800],
            ]));
            ?>
            <?php // Kundenstimme: bewusst keine – das Zitat von 2023 war ein Dank vor Projektstart, kein Urteil über das Ergebnis ?>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
