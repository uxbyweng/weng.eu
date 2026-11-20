<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie projekte/mira-beau/index.php (Bausteine: includes/case-study.php). Archiv-Projekt.
// Das Flash-Intro der früheren Website (Original: docs/_archiv/holzblaeser/intro.swf) steht als Video in assets/video/; Poster: Standbild bei 3 s.
$img = 'projects/holzblaeser/';
$meta = [
    'title'    => t('holz.meta.title'),
    'desc'     => t('holz.meta.desc'),
    'og_image' => img_url($img . 'screen_holzblaeser_website_startseite_2015', '.jpg'),
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
            $shot = ['dir' => $img, 'base' => 'screen_holzblaeser_website_startseite_2015', 'alt' => t('holz.shot.alt'), 'caption' => t('holz.shot.caption')];
            case_head(t('holz.eyebrow'), t('holz.title'), t('holz.lead'), [
                [t('holz.facts.year'), e(t('holz.facts.year.v'))],
                [t('holz.facts.role'), e(t('holz.facts.role.v'))],
                [t('holz.facts.scope'), e(t('holz.facts.scope.v'))],
            ], $shot);

            case_start(t('holz.start.title'), [t('holz.start.1')], [], '', 'case-start');

            case_steps(t('holz.steps.title'), array_map(
                fn(int $n): array => ['t' => t("holz.steps.$n.t"), 'x' => t("holz.steps.$n.x")],
                [1, 2, 3, 4, 5, 6]
            ));

            case_slider(t('holz.slider.label'), $img, [
                case_shot_slide($shot),
                ['base' => 'screen_holzblaeser_fassaden_foto_01', 'alt' => t('holz.foto1.alt'), 'caption' => t('holz.foto1.caption')],
                ['base' => 'screen_holzblaeser_fassaden_foto_02', 'alt' => t('holz.foto2.alt'), 'caption' => t('holz.foto2.caption')],
                ['base' => 'screen_holzblaeser_fassade_konzept', 'alt' => t('holz.konzept.alt'), 'caption' => t('holz.konzept.caption'), 'bare' => true],
                ['base' => 'screen_holzblaeser_fassade_motive', 'alt' => t('holz.motive.alt'), 'caption' => t('holz.motive.caption'), 'bare' => true],
            ]);

            case_start(t('holz.intro.title'), [t('holz.intro.1')], [], '', 'case-intro');

            case_video(t('holz.video.label'), '/assets/video/intro_holzblaeser_website.mp4', '/assets/img/projects/holzblaeser/intro-holzblaeser-poster', t('holz.video.caption'));
            ?>
        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
