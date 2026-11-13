<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php).
$img = '/assets/img/projects/toma/';
$meta = [
    'title'    => t('tomacase.meta.title'),
    'desc'     => t('tomacase.meta.desc'),
    'og_image' => $img . 'screen-website-toma-multivision-2004.jpg',
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
            $shot = ['dir' => $img, 'base' => 'screen-website-toma-multivision-2004', 'alt' => t('tomacase.shot.alt'), 'caption' => t('tomacase.shot.caption')];
            case_head(t('tomacase.eyebrow'), t('tomacase.title'), t('tomacase.lead'), [
                [t('tomacase.facts.year'), e(t('tomacase.facts.year.v'))],
                [t('tomacase.facts.role'), e(t('tomacase.facts.role.v'))],
                [t('tomacase.facts.tech'), e(t('tomacase.facts.tech.v'))],
            ], $shot);

            case_start(t('tomacase.idea.title'), [t('tomacase.idea.1')], [], '', 'case-idea');

            case_steps(t('tomacase.steps.title'), array_map(
                fn(int $n): array => ['t' => t("tomacase.steps.$n.t"), 'x' => t("tomacase.steps.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('tomacase.slider.label'), $img, [case_shot_slide($shot)]);

            case_start(t('tomacase.today.title'), [t('tomacase.today.1')], [], '', 'case-today');

            case_video(t('tomacase.video.label'), '/assets/video/intro_toma_multivision_website.mp4', $img . 'intro-toma-multivision-poster', t('tomacase.video.caption'));
            ?>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
