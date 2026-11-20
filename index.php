<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head([], $cspNonce); // Startseite: Standard-Title/-Description aus i18n (meta.default_*)

// Projekt-Karten teilen sich Aufbau und Link-Text
$projectLink = fn(string $href, string $nameKey): string =>
    '<a class="project-link" href="' . e(url($href)) . '">' . e(t('project.read')) .
    '<span class="visually-hidden">: ' . e(t($nameKey)) . '</span> ' . chevron_icon() . '</a>';

// Kundenzeile: Name, Logo, Breite, Höhe, Anzeigehöhe in px. Logo = Bildschlüssel unter clients/ (Maße aus dem Bild-Manifest, Breite/Höhe null)
// oder – bei SVG/GIF – Dateiname in assets/img/clients/ (mit Breite und Höhe). Ohne Logo erscheint der Name als Text.
$clients = [
    [t('project.pk.name'), 'park-klinik', null, null, 40],
    [t('project.lisa.name'), 'lisa-haller.svg', 385, 73, 34],
    ['Hausarztpraxis Mengel & Roggan', 'hausarztpraxis-mengel', null, null, 44],
    ['Pangolin Doxx Film', 'pangolin-doxx', null, null, 44],
    ['STRATO (2005–2025)', 'strato.svg', 531, 114, 30],
    ['Die Holzbläser', 'die-holzblaeser', null, null, 56],
    ['PITAYO', 'pitayo', null, null, 56],
    ['Emoree', 'emoree', null, null, 44],
    ['Mira-Beau', 'mira-beau', null, null, 40],
    ['Circus Schatzinsel', 'circus-schatzinsel', null, null, 22],
    ['Mimi Venezia', 'mimivenezia', null, null, 40],
    ['Toma Multivision', 'toma.gif', 110, 110, 44],
    ['TTZ Bremerhaven', 'ttz-bremerhaven', null, null, 52],
];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">

        <!-- Hero (Variante A: Porträt) -->
        <section class="hero">
            <div class="wrap hero__inner">
                <div class="hero__text">
                    <h1 class="hero__title">
                        <span class="hero__name"><?= e(t('home.hero.name')) ?></span>
                        <span class="visually-hidden"> – </span>
                        <span class="hero__role"><?= e(t('home.hero.role')) ?></span>
                    </h1>
                    <p class="lead hero__lead"><?= e(t('home.hero.lead')) ?></p>
                    <div class="hero__actions">
                        <a class="button" href="<?= e(url('/projekte/')) ?>"><?= e(t('home.hero.cta_projects')) ?></a>
                        <a class="button button--secondary" href="<?= e(url('/kontakt/')) ?>"><?= e(t('home.hero.cta_contact')) ?></a>
                    </div>
                </div>
                <figure class="hero__figure portrait">
                    <?= img_picture('home/weng_profile_square', t('home.hero.portrait_alt'), ['sizes' => '(max-width: 859px) 250px, 320px', 'lazy' => false, 'priority' => 'high']) ?>
                </figure>
            </div>
        </section>

        <!-- Aktuelle Projekte -->
        <section class="section" id="projekte" aria-labelledby="projekte-title">
            <div class="wrap">
                <div class="section-head">
                    <div>
                        <p class="eyebrow"><?= e(t('home.projects.eyebrow')) ?></p>
                        <h2 id="projekte-title"><?= e(t('home.projects.title')) ?></h2>
                    </div>
                    <a class="more-link" href="<?= e(url('/projekte/')) ?>"><?= e(t('home.projects.all')) ?> <?= chevron_icon() ?></a>
                </div>

                <div class="grid project-grid">
                    <article class="project-card">
                        <h3><?= e(t('project.pk.name')) ?></h3>
                        <a class="project-media-link" href="<?= e(url('/projekte/park-klinik/')) ?>" tabindex="-1" aria-hidden="true">
                            <?= project_picture('park-klinik/screen-startseite-redesign-park-klinik-birkenwerder', t('project.pk.alt')) ?>
                        </a>
                        <p class="project-meta"><?= e(t('project.pk.meta')) ?></p>
                        <p><?= e(t('project.pk.text')) ?></p>
                        <?= $projectLink('/projekte/park-klinik/', 'project.pk.name') ?>
                    </article>

                    <article class="project-card">
                        <h3><?= e(t('project.lisa.name')) ?></h3>
                        <a class="project-media-link" href="<?= e(url('/projekte/lisa/')) ?>" tabindex="-1" aria-hidden="true">
                            <?= project_picture('lisa/screen-startseite-lisa-yashodhara-haller', t('project.lisa.alt')) ?>
                        </a>
                        <p class="project-meta"><?= e(t('project.lisa.kind')) ?> · <?= e(t('project.lisa.year')) ?> · <?= e(t('project.lisa.role')) ?></p>
                        <p><?= e(t('project.lisa.text')) ?></p>
                        <?= $projectLink('/projekte/lisa/', 'project.lisa.name') ?>
                    </article>
                </div>
            </div>
        </section>

        <!-- Kunden -->
        <section class="clients" aria-labelledby="clients-title">
            <div class="wrap">
                <p class="clients__label" id="clients-title">
                    <?= e(t('home.clients.label')) ?>
                </p>
                <ul class="clients__list">
                    <?php foreach ($clients as [$name, $logo, $w, $h, $show]): ?>
                        <li>
                            <?php if (!$logo): ?>
                                <span class="clients__name"><?= e($name) ?></span>
                            <?php elseif ($w): ?>
                                <img class="clients__logo" src="/assets/img/clients/<?= e($logo) ?>" alt="<?= e($name) ?>" width="<?= $w ?>" height="<?= $h ?>"
                                    style="--logo-h: <?= $show ?>px" loading="lazy" decoding="async">
                            <?php else: ?>
                                <?= img_picture('clients/' . $logo, $name, ['class' => 'clients__logo', 'style' => "--logo-h: {$show}px"]) ?>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>

        <!-- Leistungen -->
        <section class="section section--surface" id="leistungen" aria-labelledby="leistungen-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('home.services.eyebrow')) ?></p>
                <h2 id="leistungen-title"><?= e(t('home.services.title')) ?></h2>
                <div class="grid service-grid">
                    <?php foreach ([1, 2, 3] as $n): ?>
                        <article class="card service-card">
                            <span class="service-card__num" aria-hidden="true">0<?= $n ?></span>
                            <h3><?= e(t("home.services.$n.title")) ?></h3>
                            <p><?= e(t("home.services.$n.text")) ?></p>
                            <p class="service-card__tools"><?= e(t("home.services.$n.tools")) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
                <p class="section-foot"><a class="more-link" href="<?= e(url('/leistungen/')) ?>"><?= e(t('home.services.all')) ?> <?= chevron_icon() ?></a></p>
            </div>
        </section>

        <!-- Über mich (Teaser) -->
        <section class="section" aria-labelledby="teaser-title">
            <div class="wrap teaser">
                <figure class="teaser__photo">
                    <?= img_picture('home/weng_at_work', t('home.about.photo_alt'), ['sizes' => '(min-width: 1000px) 480px, 100vw']) ?>
                </figure>
                <div class="teaser__text">
                    <p class="eyebrow"><?= e(t('home.about.eyebrow')) ?></p>
                    <h2 id="teaser-title"><?= e(t('home.about.title')) ?></h2>
                    <p><?= e(t('home.about.text')) ?></p>
                    <a class="more-link" href="<?= e(url('/ueber-mich/')) ?>"><?= e(t('home.about.more')) ?> <?= chevron_icon() ?></a>
                </div>
            </div>
        </section>

        <?php // Kundenstimme: Originalzitat aus der E-Mail der Chefärztin der Park-Klinik (23.10.2026), auf Deutsch; EN ist eine Übersetzung ?>
        <section class="quote" aria-label="<?= e(t('home.quote.label')) ?>">
            <figure class="wrap">
                <blockquote><p>„<?= e(t('home.quote.text')) ?>“</p></blockquote>
                <figcaption><?= e(t('home.quote.name')) ?>, <?= e(t('home.quote.role')) ?> · <time datetime="2026-10-23"><?= e(t('home.quote.date')) ?></time></figcaption>
            </figure>
        </section>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
