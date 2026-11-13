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

$dir = '/assets/img/projects/';

// Screenshot als <picture>: WebP (mit kleiner Variante, falls vorhanden) und JPG als Fallback
$picture = function (string $base, bool $hasXs, string $alt, int $w, int $h, bool $lazy = true) use ($dir): string {
    $webp = $hasXs
        ? $dir . $base . '_xs.webp 600w, ' . $dir . $base . '.webp 1200w'
        : $dir . $base . '.webp ' . $w . 'w';
    return '<picture><source type="image/webp" srcset="' . e($webp) . '" sizes="(min-width: 800px) 40vw, 100vw">'
        . '<img class="project-media" src="' . e($dir . $base) . '.jpg" alt="' . e($alt) . '" width="' . $w . '" height="' . $h . '"'
        . ($lazy ? ' loading="lazy"' : '') . ' decoding="async"></picture>';
};

$link = fn(string $href, string $labelKey, string $nameKey): string =>
    '<a class="project-link" href="' . e(url($href)) . '">' . e(t($labelKey)) .
    '<span class="visually-hidden">: ' . e(t($nameKey)) . '</span> ' . chevron_icon() . '</a>';

// Reihenfolge: laufende Kunden zuerst (Park-Klinik seit 2017, Pangolin seit 2015), dann Haller, STRATO, eigenes Projekt.
$projects = [
    [
        'img' => $picture('park-klinik/screen-startseite-redesign-park-klinik-birkenwerder', true, t('project.pk.alt'), 1200, 800, false),
        'meta' => e(t('projects.pk.meta')),
        'name' => t('project.pk.name'),
        'text' => e(t('projects.pk.text')),
        'href' => '/projekte/park-klinik/',
        'link' => $link('/projekte/park-klinik/', 'project.read', 'project.pk.name'),
    ],
    [
        'img' => $picture('pangolin-doxx/screen-startseite-pangolin-doxx', true, t('projects.pd.alt'), 1200, 800, false),
        'meta' => e(t('projects.pd.meta')),
        'name' => t('projects.pd.name'),
        'text' => e(t('projects.pd.text')),
        'href' => '/projekte/pangolin-doxx/',
        'link' => $link('/projekte/pangolin-doxx/', 'projects.view', 'projects.pd.name'),
    ],
    [
        'img' => $picture('lisa/screen-startseite-lisa-yashodhara-haller', true, t('project.lisa.alt'), 1200, 800),
        'meta' => e(t('project.lisa.year')) . ' · ' . e(t('project.lisa.role')),
        'name' => t('project.lisa.name'),
        'text' => e(t('project.lisa.text')),
        'href' => '/projekte/lisa/',
        'link' => $link('/projekte/lisa/', 'project.read', 'project.lisa.name'),
    ],
    [
        'img' => $picture('strato/screen-startseite-strato-april-2024', true, t('projects.strato.alt'), 1200, 800),
        'meta' => e(t('projects.strato.meta')),
        'name' => t('projects.strato.name'),
        'text' => e(t('projects.strato.text')),
        'href' => '/projekte/strato/',
        'link' => $link('/projekte/strato/', 'project.read', 'projects.strato.name'),
    ],
    [
        'img' => $picture('berlin-street-view/teaser-berlin-street-view', false, t('project.bsv.alt'), 600, 400),
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
        'img' => $picture('circus-schatzinsel/teaser-campzeitung-2018', false, t('projects.circus.alt'), 600, 400),
        'href' => '/projekte/circus-schatzinsel/',
        'meta' => e(t('projects.circus.meta')),
        'name' => t('projects.circus.name'),
        'text' => e(t('projects.circus.text')),
        'link' => $link('/projekte/circus-schatzinsel/', 'projects.view', 'projects.circus.name'),
    ],
    [
        'img' => $picture('toma/screen-website-toma-multivision-2004', true, t('projects.toma.alt'), 1200, 800),
        'href' => '/projekte/toma-multivision/',
        'meta' => e(t('projects.toma.meta')),
        'name' => t('projects.toma.name'),
        'text' => e(t('projects.toma.text')),
        'link' => $link('/projekte/toma-multivision/', 'projects.view', 'projects.toma.name'),
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
                            <a class="project-media-link" href="<?= e(url($p['href'])) ?>" tabindex="-1" aria-hidden="true"><?= $p['img'] ?></a>
                            <p class="project-meta"><?= $p['meta'] ?></p>
                            <h2><?= e($p['name']) ?></h2>
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
                                <a class="project-media-link" href="<?= e(url($p['href'])) ?>" tabindex="-1" aria-hidden="true"><?= $p['img'] ?></a>
                                <p class="project-meta"><?= $p['meta'] ?></p>
                                <h3><?= e($p['name']) ?></h3>
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
