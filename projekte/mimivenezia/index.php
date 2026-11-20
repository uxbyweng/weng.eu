<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php). Archiv-Projekt.
$img = 'projects/emoree/';
$meta = [
    'title'    => t('emoree.meta.title'),
    'desc'     => t('emoree.meta.desc'),
    'og_image' => img_url($img . 'screen-startseite-emoree', '.jpg'),
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
            $shot = ['dir' => $img, 'base' => 'screen-startseite-emoree', 'alt' => t('emoree.shot.alt'), 'caption' => t('emoree.shot.caption')];
            case_head(t('emoree.eyebrow'), t('emoree.title'), t('emoree.lead'), [
                [t('emoree.facts.year'), e(t('emoree.facts.year.v'))],
                [t('emoree.facts.role'), e(t('emoree.facts.role.v'))],
                [t('emoree.facts.scope'), e(t('emoree.facts.scope.v'))],
            ], $shot);

            case_start(t('emoree.idea.title'), [t('emoree.idea.1')], [], '', 'case-idea');

            case_steps(t('emoree.steps.title'), array_map(
                fn(int $n): array => ['t' => t("emoree.steps.$n.t"), 'x' => t("emoree.steps.$n.x")],
                [1, 2, 3, 4, 5, 6]
            ));

            case_slider(t('emoree.slider.label'), $img, [case_shot_slide($shot)]);
            ?>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
