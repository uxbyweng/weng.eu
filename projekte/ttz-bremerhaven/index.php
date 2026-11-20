<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php). Archiv-Projekt.
$img = 'projects/ttz-bremerhaven/';
$meta = [
    'title'    => t('ttz.meta.title'),
    'desc'     => t('ttz.meta.desc'),
    'og_image' => img_url($img . 'screen-iwapil', '.jpg'),
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
            $shot = ['dir' => $img, 'base' => 'screen-iwapil', 'alt' => t('ttz.shot.alt'), 'caption' => t('ttz.shot.caption')];
            case_head(t('ttz.eyebrow'), t('ttz.title'), t('ttz.lead'), [
                [t('ttz.facts.year'), e(t('ttz.facts.year.v'))],
                [t('ttz.facts.role'), e(t('ttz.facts.role.v'))],
                [t('ttz.facts.scope'), e(t('ttz.facts.scope.v'))],
            ], $shot);

            case_start(t('ttz.start.title'), [t('ttz.start.1')], [], '', 'case-start');

            case_start(t('ttz.common.title'), [], array_map(
                fn(int $n): array => [t("ttz.common.$n.l"), t("ttz.common.$n.x")],
                [1, 2, 3, 4]
            ), '', 'case-common');

            case_steps(t('ttz.steps.title'), array_map(
                fn(int $n): array => ['t' => t("ttz.steps.$n.t"), 'x' => t("ttz.steps.$n.x")],
                [1, 2, 3, 4, 5]
            ));

            // Reihenfolge wie die Texte oben; IWAPIL steht schon im Kopf und ist hier die erste Folie nach case_shot_slide
            $slide = fn(string $id): array => ['base' => "screen-$id", 'alt' => t("ttz.slide.$id.alt"), 'caption' => t("ttz.slide.$id.cap")];
            case_slider(t('ttz.slider.label'), $img, array_map($slide, ['iwapil', 'inasoop', 'inawab', 'wacosys', 'ladas']));
            ?>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
