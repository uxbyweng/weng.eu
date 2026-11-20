<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php). Archiv-Projekt.
$img = 'projects/mira-beau/';
$meta = [
    'title'    => t('mira.meta.title'),
    'desc'     => t('mira.meta.desc'),
    'og_image' => img_url($img . 'screen-aktuelles-mira-beau', '.jpg'),
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
            $shot = ['dir' => $img, 'base' => 'screen-aktuelles-mira-beau', 'alt' => t('mira.shot.alt'), 'caption' => t('mira.shot.caption')];
            case_head(t('mira.eyebrow'), t('mira.title'), t('mira.lead'), [
                [t('mira.facts.year'), e(t('mira.facts.year.v'))],
                [t('mira.facts.role'), e(t('mira.facts.role.v'))],
                [t('mira.facts.scope'), e(t('mira.facts.scope.v'))],
            ], $shot);

            case_start(t('mira.start.title'), [t('mira.start.1')], [], '', 'case-start');

            case_steps(t('mira.steps.title'), array_map(
                fn(int $n): array => ['t' => t("mira.steps.$n.t"), 'x' => t("mira.steps.$n.x")],
                [1, 2, 3, 4, 5, 6]
            ));

            case_slider(t('mira.slider.label'), $img, [case_shot_slide($shot)]);

            case_start(t('mira.today.title'), [t('mira.today.1')], [], '', 'case-today');
            ?>
            <div class="wrap">
                <figure class="case-figure case-figure--logo">
                    <?= img_picture($img . 'logo-mira-beau', t('mira.logo.alt')) ?>
                    <figcaption><?= e(t('mira.logo.caption')) ?></figcaption>
                </figure>
            </div>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
