<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php).
$img = '/assets/img/projects/pangolin-doxx/';
$meta = [
    'title'    => t('pdcase.meta.title'),
    'desc'     => t('pdcase.meta.desc'),
    'og_image' => $img . 'screen-startseite-pangolin-doxx.jpg',
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
            $shot = ['dir' => $img, 'base' => 'screen-startseite-pangolin-doxx', 'alt' => t('pdcase.shot.alt'), 'caption' => t('pdcase.shot.caption')];
            case_head(t('pdcase.eyebrow'), t('pdcase.title'), t('pdcase.lead'), [
                [t('pdcase.facts.period'), e(t('pdcase.facts.period.v'))],
                [t('pdcase.facts.role'), e(t('pdcase.facts.role.v'))],
                [t('pdcase.facts.live'), case_ext_link('https://www.pangolin-doxx.com/', 'pangolin-doxx.com', true)],
            ], $shot);

            case_glance(t('pdcase.results.title'), [
                ['icon' => 'calendar', 'value' => t('pdcase.results.1.v'), 'text' => t('pdcase.results.1.t')],
                ['icon' => 'languages', 'value' => t('pdcase.results.2.v'), 'text' => t('pdcase.results.2.t')],
                ['icon' => 'pencil', 'value' => t('pdcase.results.3.v'), 'text' => t('pdcase.results.3.t')],
                ['icon' => 'pen-tool', 'value' => t('pdcase.results.4.v'), 'text' => t('pdcase.results.4.t')],
            ], ['PHP', 'SQLite', 'Bootstrap', 'HTML5', 'CSS3', 'JavaScript'], t('pdcase.stack'));

            case_start(t('pdcase.start.title'), [t('pdcase.start.1')], array_map(
                fn(int $n): array => [t("pdcase.goals.$n.t"), t("pdcase.goals.$n.x")],
                [1, 2, 3, 4]
            ));

            case_steps(t('pdcase.work.title'), array_map(
                fn(int $n): array => ['t' => t("pdcase.work.$n.t"), 'x' => t("pdcase.work.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('pdcase.slider.label'), $img, array_merge([case_shot_slide($shot)], [
                ['base' => 'screen-filmseite-sleepless-birds-pangolin-doxx', 'alt' => t('pdcase.film.alt'), 'caption' => t('pdcase.film.caption'), 'w' => 1200, 'h' => 800],
                ['base' => 'screen-blog-admin-php-sqlite-pangolin-doxx', 'alt' => t('pdcase.admin.alt'), 'caption' => t('pdcase.admin.caption'), 'w' => 1200, 'h' => 800],
            ]));
            ?>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
