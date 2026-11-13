<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Aufbau wie der Master projekte/park-klinik/index.php (Bausteine: includes/case-study.php).
$img = '/assets/img/projects/berlin-street-view/';
$meta = [
    'title'    => t('bsv.meta.title'),
    'desc'     => t('bsv.meta.desc'),
    'og_image' => $img . 'teaser-berlin-street-view.jpg',
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
            case_head(t('bsv.eyebrow'), t('bsv.title'), t('bsv.lead'), [
                [t('bsv.facts.period'), e(t('bsv.facts.period.v'))],
                [t('bsv.facts.role'), e(t('bsv.facts.role.v'))],
                [t('bsv.facts.live'), case_ext_link('https://www.berlin-street-view.de/', 'berlin-street-view.de')],
                [t('bsv.facts.code'), case_ext_link('https://github.com/uxbyweng/berlin-street-view', 'GitHub')],
            ]);

            case_glance(t('bsv.glance.title'), [
                ['icon' => 'map-pin', 'value' => t('bsv.glance.1.v'), 'text' => t('bsv.glance.1.t')],
                ['icon' => 'upload', 'value' => t('bsv.glance.2.v'), 'text' => t('bsv.glance.2.t')],
                ['icon' => 'lock', 'value' => t('bsv.glance.3.v'), 'text' => t('bsv.glance.3.t')],
                ['icon' => 'image', 'value' => t('bsv.glance.4.v'), 'text' => t('bsv.glance.4.t')],
            ], ['Next.js', 'React', 'TypeScript', 'MongoDB', 'Auth.js', 'MapLibre GL', 'Cloudinary', 'Vercel'], t('bsv.stack'));

            // Abschnitt erst live, wenn der Inhaber ihn schreibt: eine echte technische Entscheidung oder ein Problem
            if ($techTodo = todo('Zwei, drei Sätze zu einer echten Entscheidung oder einem Problem, z. B. EXIF-Daten auslesen, bevor Cloudinary sie entfernt, oder Rechteprüfung auf dem Server statt nur im Interface')) {
                case_start(t('bsv.tech.title'), [], [], $techTodo);
            }

            case_slider(t('bsv.slider.label'), $img, [
                ['base' => 'berlin-street-view-mobile-map-view', 'alt' => t('bsv.shot.alt'), 'caption' => t('bsv.shot.caption'), 'w' => 600, 'h' => 1189, 'ext' => 'png', 'bare' => true],
                ['base' => 'teaser-berlin-street-view', 'alt' => t('bsv.home.alt'), 'caption' => t('bsv.home.caption'), 'w' => 600, 'h' => 400],
            ]);
            ?>

        </article>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
