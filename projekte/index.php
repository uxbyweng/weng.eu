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

// Zeile unter dem Bild: Kategorie-Badge + Meta (Jahr, Rolle). $metaHtml ist bereits escaped.
$metaLine = fn(string $cat, string $metaHtml): string =>
    '<p class="project-meta project-meta--badge"><span class="badge badge--' . $cat . '">' . e(t("projects.badge.$cat")) . '</span><span>' . $metaHtml . '</span></p>';

$link = fn(string $href, string $labelKey, string $nameKey): string =>
    '<a class="project-link" href="' . e(url($href)) . '">' . e(t($labelKey)) .
    '<span class="visually-hidden">: ' . e(t($nameKey)) . '</span> <span aria-hidden="true">→</span></a>';

$chips = fn(array $items): string =>
    '<ul class="chip-list">' . implode('', array_map(fn($c) => '<li class="chip">' . e($c) . '</li>', $items)) . '</ul>';

$result = fn(string $html): string => '<p class="result">' . $html . '</p>';

// Reihenfolge wie im Entwurf. cat = Filter-Kategorie (client | employed | own).
$projects = [
    [
        'cat' => 'client',
        'img' => $picture('park-klinik/screen-startseite-park-klinik-birkenwerder', true, t('project.pk.alt'), 1200, 800, false),
        'meta' => e(t('projects.pk.meta')),
        'name' => t('project.pk.name'),
        'text' => e(t('projects.pk.text')),
        'extra' => $result(e(t('project.pk.r1'))),
        'link' => $link('/projekte/park-klinik/', 'project.read', 'project.pk.name'),
    ],
    [
        'cat' => 'employed',
        'img' => $picture('strato/screen-startseite-strato-april-2024', true, t('projects.strato.alt'), 1200, 800, false),
        'meta' => e(t('projects.strato.meta')),
        'name' => t('projects.strato.name'),
        'text' => e(t('projects.strato.text')),
        'extra' => $result(e(t('projects.strato.r1'))),
        'link' => $link('/projekte/strato/', 'project.read', 'projects.strato.name'),
    ],
    [
        'cat' => 'client',
        'img' => $picture('lisa/screen-startseite-lisa-yashodhara-haller', true, t('project.lisa.alt'), 1200, 800),
        'meta' => e(t('project.lisa.year')) . ' · ' . e(t('project.lisa.role')),
        'name' => t('project.lisa.name'),
        'text' => e(t('project.lisa.text')),
        'extra' => $result(e(t('project.lisa.r1'))),
        'link' => $link('/projekte/lisa/', 'project.read', 'project.lisa.name'),
    ],
    [
        'cat' => 'own',
        'img' => $picture('berlin-street-view/teaser-berlin-street-view', false, t('project.bsv.alt'), 600, 400),
        'meta' => e(t('projects.bsv.meta')),
        'name' => t('project.bsv.name'),
        'text' => e(t('projects.bsv.text')),
        'extra' => $chips(['Next.js', 'TypeScript', 'MongoDB', 'OAuth', 'MapLibre']),
        'link' => $link('/projekte/berlin-street-view/', 'projects.view', 'project.bsv.name'),
    ],
    [
        'cat' => 'client',
        'img' => $picture('pangolin-doxx/screen-startseite-pangolin-doxx', true, t('projects.pd.alt'), 1200, 800),
        'meta' => e(t('projects.pd.meta')),
        'name' => t('projects.pd.name'),
        'text' => e(t('projects.pd.text')),
        // Ergebnis liefert der Inhaber (live bleibt die Zeile leer, siehe todo())
        'extra' => ($todo = todo('Ergebnis, z. B. Lighthouse oder Laufzeit der Betreuung')) ? $result($todo) : '',
        'link' => $link('/projekte/pangolin-doxx/', 'projects.view', 'projects.pd.name'),
    ],
];
$total = count($projects);
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

                <?php /* Filter nur mit JS (project-filter.ts blendet ihn ein). Ohne JS sind alle Projekte sichtbar. */ ?>
                <div class="filter" role="group" aria-label="<?= e(t('projects.filter.label')) ?>" data-project-filter hidden>
                    <?php foreach (['all', 'client', 'employed', 'own'] as $i => $key): ?>
                        <button class="filter__button" type="button" data-filter="<?= $key ?>" aria-pressed="<?= $i === 0 ? 'true' : 'false' ?>"><?= e(t("projects.filter.$key")) ?></button>
                    <?php endforeach; ?>
                    <p class="visually-hidden" role="status" data-filter-status
                        data-template="<?= e(t('projects.filter.status')) ?>" data-total="<?= $total ?>"></p>
                </div>
            </div>
        </section>

        <section class="projects" aria-label="<?= e(t('projects.title')) ?>">
            <div class="wrap">
                <div class="grid project-grid project-grid--page">
                    <?php foreach ($projects as $p): ?>
                        <article class="project-card" data-category="<?= $p['cat'] ?>">
                            <?= $p['img'] ?>
                            <?= $metaLine($p['cat'], $p['meta']) ?>
                            <h2><?= e($p['name']) ?></h2>
                            <p><?= $p['text'] ?></p>
                            <?= $p['extra'] ?>
                            <?= $p['link'] ?>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div class="archive">
                    <h2 class="archive__title"><?= e(t('projects.archive.title')) ?></h2>
                    <a class="archive__row" href="<?= e(url('/projekte/circus-schatzinsel/')) ?>">
                        <span class="archive__name"><?= e(t('projects.archive.name')) ?></span>
                        <span class="archive__meta"><?= e(t('projects.archive.meta')) ?></span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
