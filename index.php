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

// Kundenzeile (Namen sind in beiden Sprachen gleich)
$clients = [t('project.pk.name'), t('project.lisa.name'), 'Hausarztpraxis Mengel & Roggan', 'Pangolin Doxx Film', 'STRATO (2005–2025)'];
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
                    <img src="/assets/img/home/weng_profile_square_640.webp"
                        srcset="/assets/img/home/weng_profile_square_320.webp 320w, /assets/img/home/weng_profile_square_640.webp 640w, /assets/img/home/weng_profile_square_960.webp 960w"
                        sizes="(max-width: 320px) 100vw, 320px" alt="<?= e(t('home.hero.portrait_alt')) ?>" width="640" height="640" fetchpriority="high" decoding="async">
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
                        <a class="project-media-link" href="<?= e(url('/projekte/park-klinik/')) ?>" tabindex="-1" aria-hidden="true">
                            <img class="project-media" src="/assets/img/projects/park-klinik/screen-startseite-redesign-park-klinik-birkenwerder.jpg"
                                alt="<?= e(t('project.pk.alt')) ?>" width="1200" height="800" loading="lazy" decoding="async">
                        </a>
                        <p class="project-meta"><?= e(t('project.pk.meta')) ?></p>
                        <h3><?= e(t('project.pk.name')) ?></h3>
                        <p><?= e(t('project.pk.text')) ?></p>
                        <?= $projectLink('/projekte/park-klinik/', 'project.pk.name') ?>
                    </article>

                    <article class="project-card">
                        <a class="project-media-link" href="<?= e(url('/projekte/lisa/')) ?>" tabindex="-1" aria-hidden="true">
                            <img class="project-media" src="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller.jpg"
                                alt="<?= e(t('project.lisa.alt')) ?>" width="1200" height="800" loading="lazy" decoding="async">
                        </a>
                        <p class="project-meta"><?= e(t('project.lisa.kind')) ?> · <?= e(t('project.lisa.year')) ?> · <?= e(t('project.lisa.role')) ?></p>
                        <h3><?= e(t('project.lisa.name')) ?></h3>
                        <p><?= e(t('project.lisa.text')) ?></p>
                        <?= $projectLink('/projekte/lisa/', 'project.lisa.name') ?>
                    </article>
                </div>
            </div>
        </section>

        <!-- Kunden -->
        <section class="clients" aria-labelledby="clients-title">
            <div class="wrap">
                <p class="clients__label" id="clients-title"><?= e(t('home.clients.label')) ?></p>
                <ul class="clients__list">
                    <?php foreach ($clients as $client): ?><li><?= e($client) ?></li><?php endforeach; ?>
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
                    <img src="/assets/img/home/weng_at_work_1400x1120.webp"
                        srcset="/assets/img/home/weng_at_work_700x560.webp 700w, /assets/img/home/weng_at_work_1400x1120.webp 1400w"
                        sizes="(min-width: 1000px) 480px, 100vw" alt="<?= e(t('home.about.photo_alt')) ?>"
                        width="1400" height="1120" loading="lazy" decoding="async">
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
