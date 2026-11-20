<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie projekte/mira-beau/index.php (Bausteine: includes/case-study.php). Archiv-Projekt.
$img = 'projects/mimivenezia/';
$meta = [
    'title'    => t('mimi.meta.title'),
    'desc'     => t('mimi.meta.desc'),
    'og_image' => img_url($img . 'screen_mimivenezia_homepage', '.jpg'),
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
            $shot = ['dir' => $img, 'base' => 'screen_mimivenezia_homepage', 'alt' => t('mimi.shot.alt'), 'caption' => t('mimi.shot.caption')];
            case_head(t('mimi.eyebrow'), t('mimi.title'), t('mimi.lead'), [
                [t('mimi.facts.year'), e(t('mimi.facts.year.v'))],
                [t('mimi.facts.role'), e(t('mimi.facts.role.v'))],
                [t('mimi.facts.scope'), e(t('mimi.facts.scope.v'))],
            ], $shot);

            case_start(t('mimi.start.title'), [t('mimi.start.1')], [], '', 'case-start');

            case_steps(t('mimi.steps.title'), array_map(
                fn(int $n): array => ['t' => t("mimi.steps.$n.t"), 'x' => t("mimi.steps.$n.x")],
                [1, 2, 3, 4]
            ));

            case_slider(t('mimi.slider.label'), $img, [
                case_shot_slide($shot),
                ['base' => 'screen_mimivenezia_company', 'alt' => t('mimi.company.alt'), 'caption' => t('mimi.company.caption')],
                ['base' => 'screen_mimivenezia_vcards', 'alt' => t('mimi.vcards.alt'), 'caption' => t('mimi.vcards.caption'), 'bare' => true],
                ['base' => 'screen_mimivenezia_poster', 'alt' => t('mimi.poster.alt'), 'caption' => t('mimi.poster.caption'), 'bare' => true],
                ['base' => 'screen_logo_styleguide', 'alt' => t('mimi.guide.alt'), 'caption' => t('mimi.guide.caption'), 'bare' => true],
            ]);
            ?>
            <div class="wrap">
                <figure class="case-figure case-figure--logo">
                    <?= img_picture($img . 'mimivenezia_color', t('mimi.logo.alt')) ?>
                    <figcaption><?= e(t('mimi.logo.caption')) ?></figcaption>
                </figure>
            </div>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
