<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => t('projects.meta.title'),
    'desc'  => t('projects.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$link = fn(string $href, string $labelKey, string $nameKey): string =>
    '<a class="project-link" href="' . e(url($href)) . '">' . e(t($labelKey)) .
    '<span class="visually-hidden">: ' . e(t($nameKey)) . '</span> ' . chevron_icon() . '</a>';

// Reihenfolge: laufende Kunden zuerst (Park-Klinik seit 2017, Pangolin seit 2015), dann Haller, STRATO, eigenes Projekt.
$projects = [
    [
        'img' => project_picture('park-klinik/screen-startseite-redesign-park-klinik-birkenwerder', t('project.pk.alt'), false),
        'meta' => e(t('projects.pk.meta')),
        'name' => t('project.pk.name'),
        'text' => e(t('projects.pk.text')),
        'href' => '/projekte/park-klinik/',
        'link' => $link('/projekte/park-klinik/', 'project.read', 'project.pk.name'),
    ],
    [
        'img' => project_picture('pangolin-doxx/screen-startseite-pangolin-doxx', t('projects.pd.alt'), false),
        'meta' => e(t('projects.pd.meta')),
        'name' => t('projects.pd.name'),
        'text' => e(t('projects.pd.text')),
        'href' => '/projekte/pangolin-doxx/',
        'link' => $link('/projekte/pangolin-doxx/', 'projects.view', 'projects.pd.name'),
    ],
    [
        'img' => project_picture('lisa/screen-startseite-lisa-yashodhara-haller', t('project.lisa.alt')),
        'meta' => e(t('project.lisa.year')) . ' · ' . e(t('project.lisa.role')),
        'name' => t('project.lisa.name'),
        'text' => e(t('project.lisa.text')),
        'href' => '/projekte/lisa/',
        'link' => $link('/projekte/lisa/', 'project.read', 'project.lisa.name'),
    ],
    [
        'img' => project_picture('strato/screen-startseite-strato-april-2024', t('projects.strato.alt')),
        'meta' => e(t('projects.strato.meta')),
        'name' => t('projects.strato.name'),
        'text' => e(t('projects.strato.text')),
        'href' => '/projekte/strato/',
        'link' => $link('/projekte/strato/', 'project.read', 'projects.strato.name'),
    ],
    [
        'img' => project_picture('berlin-street-view/teaser-berlin-street-view', t('project.bsv.alt')),
        'meta' => e(t('projects.bsv.meta')),
        'name' => t('project.bsv.name'),
        'text' => e(t('projects.bsv.text')),
        'href' => '/projekte/berlin-street-view/',
        'link' => $link('/projekte/berlin-street-view/', 'projects.view', 'project.bsv.name'),
    ],
];

// Archiv: ältere Arbeiten
$archive = [
    [
        'img' => project_picture('circus-schatzinsel/teaser-campzeitung-2018', t('projects.circus.alt')),
        'href' => '/projekte/circus-schatzinsel/',
        'meta' => e(t('projects.circus.meta')),
        'name' => t('projects.circus.name'),
        'text' => e(t('projects.circus.text')),
        'link' => $link('/projekte/circus-schatzinsel/', 'projects.view', 'projects.circus.name'),
    ],
    [
        'img' => project_picture('toma/screen-website-toma-multivision-2004', t('projects.toma.alt')),
        'href' => '/projekte/toma-multivision/',
        'meta' => e(t('projects.toma.meta')),
        'name' => t('projects.toma.name'),
        'text' => e(t('projects.toma.text')),
        'link' => $link('/projekte/toma-multivision/', 'projects.view', 'projects.toma.name'),
    ],
    [
        'img' => project_picture('emoree/screen-startseite-emoree', t('projects.emoree.alt')),
        'href' => '/projekte/emoree/',
        'meta' => e(t('projects.emoree.meta')),
        'name' => t('projects.emoree.name'),
        'text' => e(t('projects.emoree.text')),
        'link' => $link('/projekte/emoree/', 'projects.view', 'projects.emoree.name'),
    ],
    [
        'img' => project_picture('ttz-bremerhaven/screen-iwapil', t('projects.ttz.alt')),
        'href' => '/projekte/ttz-bremerhaven/',
        'meta' => e(t('projects.ttz.meta')),
        'name' => t('projects.ttz.name'),
        'text' => e(t('projects.ttz.text')),
        'link' => $link('/projekte/ttz-bremerhaven/', 'projects.view', 'projects.ttz.name'),
    ],
    [
        'img' => project_picture('mira-beau/screen-aktuelles-mira-beau', t('projects.mira.alt')),
        'href' => '/projekte/mira-beau/',
        'meta' => e(t('projects.mira.meta')),
        'name' => t('projects.mira.name'),
        'text' => e(t('projects.mira.text')),
        'link' => $link('/projekte/mira-beau/', 'projects.view', 'projects.mira.name'),
    ],
    [
        'img' => project_picture('mimivenezia/screen_mimivenezia_homepage', t('projects.mimi.alt')),
        'href' => '/projekte/mimivenezia/',
        'meta' => e(t('projects.mimi.meta')),
        'name' => t('projects.mimi.name'),
        'text' => e(t('projects.mimi.text')),
        'link' => $link('/projekte/mimivenezia/', 'projects.view', 'projects.mimi.name'),
    ],
];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <section class="page-head" aria-labelledby="projects-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('projects.eyebrow')) ?></p>
                <h1 id="projects-title"><?= e(t('projects.title')) ?></h1>
                <p class="lead"><?= e(t('projects.lead')) ?></p>
            </div>
        </section>

        <section class="projects" aria-label="<?= e(t('projects.title')) ?>">
            <div class="wrap">
                <div class="grid project-grid project-grid--page">
                    <?php foreach ($projects as $p): ?>
                        <article class="project-card">
                            <h2><?= e($p['name']) ?></h2>
                            <a class="project-media-link" href="<?= e(url($p['href'])) ?>" tabindex="-1" aria-hidden="true"><?= $p['img'] ?></a>
                            <p class="project-meta"><?= $p['meta'] ?></p>
                            <p><?= $p['text'] ?></p>
                            <?= $p['link'] ?>
                        </article>
                    <?php endforeach; ?>
                </div>

                <?php // Archiv: eingeklappt, der Inhalt bleibt bis zum Aufklappen verborgen ?>
                <details class="archive">
                    <summary class="archive__summary">
                        <h2 class="archive__title"><?= e(t('projects.archive.title')) ?></h2>
                        <svg class="archive__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="m6 9 6 6 6-6"/></svg>
                    </summary>
                    <div class="grid project-grid project-grid--page">
                        <?php foreach ($archive as $p): ?>
                            <article class="project-card">
                                <h3><?= e($p['name']) ?></h3>
                                <a class="project-media-link" href="<?= e(url($p['href'])) ?>" tabindex="-1" aria-hidden="true"><?= $p['img'] ?></a>
                                <p class="project-meta"><?= $p['meta'] ?></p>
                                <p><?= $p['text'] ?></p>
                                <?= $p['link'] ?>
                            </article>
                        <?php endforeach; ?>
                    </div>
                </details>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
