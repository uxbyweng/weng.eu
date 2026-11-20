<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie projekte/mira-beau/index.php (Bausteine: includes/case-study.php). Archiv-Projekt.
$img = 'projects/effectiveinenglish/';
$meta = [
    'title'    => t('eie.meta.title'),
    'desc'     => t('eie.meta.desc'),
    'og_image' => img_url($img . 'screen_effectiveinenglish_wordpress_website_01', '.jpg'),
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
            $shot = ['dir' => $img, 'base' => 'screen_effectiveinenglish_wordpress_website_01', 'alt' => t('eie.shot.alt'), 'caption' => t('eie.shot.caption')];
            case_head(t('eie.eyebrow'), t('eie.title'), t('eie.lead'), [
                [t('eie.facts.year'), e(t('eie.facts.year.v'))],
                [t('eie.facts.role'), e(t('eie.facts.role.v'))],
                [t('eie.facts.scope'), e(t('eie.facts.scope.v'))],
            ], $shot);

            case_start(t('eie.start.title'), [t('eie.start.1')], [], '', 'case-start');

            case_steps(t('eie.steps.title'), array_map(
                fn(int $n): array => ['t' => t("eie.steps.$n.t"), 'x' => t("eie.steps.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('eie.slider.label'), $img, [
                case_shot_slide($shot),
                ['base' => 'screen_effectiveinenglish_wordpress_website_02', 'alt' => t('eie.news.alt'), 'caption' => t('eie.news.caption')],
                ['base' => 'screen_effectiveinenglish_wordpress_website_03', 'alt' => t('eie.method.alt'), 'caption' => t('eie.method.caption')],
            ]);
            ?>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
