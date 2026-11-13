<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php).
$img = '/assets/img/projects/strato/';
$meta = [
    'title'    => t('strato.meta.title'),
    'desc'     => t('strato.meta.desc'),
    'og_image' => $img . 'screen-startseite-strato-april-2024.jpg',
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
            $shot = ['dir' => $img, 'base' => 'screen-startseite-strato-april-2024', 'alt' => t('strato.shot.alt'), 'caption' => t('strato.shot.caption')];
            case_head(t('strato.eyebrow'), t('strato.title'), t('strato.lead'), [
                [t('strato.facts.period'), e(t('strato.facts.period.v'))],
                [t('strato.facts.role'), e(t('strato.facts.role.v'))],
                [t('strato.facts.live'), case_ext_link('https://www.strato.de', 'strato.de')],
            ], $shot);

            case_glance(t('strato.results.title'), [
                ['icon' => 'calendar', 'value' => t('strato.results.1.v'), 'text' => t('strato.results.1.t')],
                ['icon' => 'cart', 'value' => t('strato.results.2.v'), 'text' => t('strato.results.2.t')],
                ['icon' => 'smartphone', 'value' => t('strato.results.3.v'), 'text' => t('strato.results.3.t')],
                ['icon' => 'eye', 'value' => t('strato.results.4.v'), 'text' => t('strato.results.4.t')],
            ], ['Bootstrap 5', 'Eleventy', 'Nunjucks', 'Imperia CMS', 'Strapi', 'GitLab', 'Jenkins', 'Figma'], t('strato.stack'));

            case_steps(t('strato.work.title'), array_map(
                fn(int $n): array => ['t' => t("strato.work.$n.t"), 'x' => t("strato.work.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('strato.slider.label'), $img, array_merge([case_shot_slide($shot)], [
                ['base' => 'screen-strato-woocommerce-ausschnitt-mai-2024', 'alt' => t('strato.woo.alt'), 'caption' => t('strato.woo.caption'), 'w' => 1200, 'h' => 675, 'xs' => true],
            ]));
            ?>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
