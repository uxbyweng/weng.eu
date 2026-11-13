<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php).
$img = '/assets/img/projects/circus-schatzinsel/';
$meta = [
    'title'    => t('circus.meta.title'),
    'desc'     => t('circus.meta.desc'),
    'og_image' => $img . 'teaser-campzeitung-2018.jpg',
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
            case_head(t('circus.eyebrow'), t('circus.title'), t('circus.lead'), [
                [t('circus.facts.period'), e(t('circus.facts.period.v'))],
                [t('circus.facts.role'), e(t('circus.facts.role.v'))],
                [t('circus.facts.format'), e(t('circus.facts.format.v'))],
                [t('circus.facts.pdf'), case_ext_link('/assets/pdf/20181204_campzeitung_circus_schatzinsel_dina4.pdf', t('circus.facts.pdf.v'))],
            ]);

            case_glance(t('circus.glance.title'), [
                ['icon' => 'book-open', 'value' => t('circus.glance.1.v'), 'text' => t('circus.glance.1.t')],
                ['icon' => 'image', 'value' => t('circus.glance.2.v'), 'text' => t('circus.glance.2.t')],
                ['icon' => 'type', 'value' => t('circus.glance.3.v'), 'text' => t('circus.glance.3.t')],
                ['icon' => 'grid', 'value' => t('circus.glance.4.v'), 'text' => t('circus.glance.4.t')],
            ], ['Photoshop', 'Acrobat', 'InDesign'], t('circus.tools'));

            case_start(t('circus.start.title'), [t('circus.start.1'), t('circus.start.2')]);

            case_steps(t('circus.steps.title'), array_map(
                fn(int $n): array => ['t' => t("circus.steps.$n.t"), 'x' => t("circus.steps.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('circus.slider.label'), $img, [
                ['base' => 'cover-campzeitung-2018', 'alt' => t('circus.cover.alt'), 'caption' => t('circus.cover.caption'), 'w' => 720, 'h' => 1022],
                ['base' => 'teaser-campzeitung-2018', 'alt' => t('circus.spread.alt'), 'caption' => t('circus.spread.caption'), 'w' => 600, 'h' => 400],
            ]);
            ?>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
