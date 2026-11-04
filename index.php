<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head([], $cspNonce); // Startseite: Standard-Title/-Description aus i18n (meta.default_*)

// Projekt-Karten teilen sich Aufbau und Link-Text
$projectLink = fn(string $href, string $nameKey): string =>
    '<a class="project-link" href="' . e(url($href)) . '">' . e(t('project.read')) .
    '<span class="visually-hidden">: ' . e(t($nameKey)) . '</span> <span aria-hidden="true">→</span></a>';
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
                    <p class="hero__sub"><?= e(t('home.hero.sub')) ?></p>
                    <div class="hero__actions">
                        <a class="button" href="<?= e(url('/projekte/')) ?>"><?= e(t('home.hero.cta_projects')) ?></a>
                        <a class="button button--secondary" href="<?= e(url('/kontakt/')) ?>"><?= e(t('home.hero.cta_contact')) ?></a>
                    </div>
                </div>
                <figure class="hero__figure portrait">
                    <img src="/assets/img/home/weng_profile_1040x1300.webp"
                        srcset="/assets/img/home/weng_profile_520x650.webp 520w, /assets/img/home/weng_profile_1040x1300.webp 1040w"
                        sizes="(max-width: 520px) 100vw, 520px" alt="<?= e(t('home.hero.portrait_alt')) ?>" width="1040" height="1300" fetchpriority="high" decoding="async">
                    <figcaption class="portrait__badge">
                        <strong><?= e(t('home.hero.badge_since')) ?></strong>
                        <span><?= e(t('home.hero.badge_for')) ?></span>
                    </figcaption>
                </figure>
            </div>
        </section>

        <!-- Ausgewählte Arbeiten -->
        <section class="section" id="projekte" aria-labelledby="projekte-title">
            <div class="wrap">
                <div class="section-head">
                    <div>
                        <p class="eyebrow"><?= e(t('home.projects.eyebrow')) ?></p>
                        <h2 id="projekte-title"><?= e(t('home.projects.title')) ?></h2>
                    </div>
                    <a class="more-link" href="<?= e(url('/projekte/')) ?>"><?= e(t('home.projects.all')) ?> <span aria-hidden="true">→</span></a>
                </div>

                <article class="project-feature">
                    <img class="project-media" src="/assets/img/projects/park-klinik/screen-startseite-redesign-park-klinik-birkenwerder.jpg"
                        alt="<?= e(t('project.pk.alt')) ?>" width="1200" height="800" loading="lazy" decoding="async">
                    <div class="project-feature__body">
                        <p class="project-meta"><?= e(t('project.pk.meta')) ?></p>
                        <h3><?= e(t('project.pk.name')) ?></h3>
                        <p><?= e(t('project.pk.text')) ?></p>
                        <ul class="results">
                            <li class="result"><?= e(t('project.pk.r1')) ?></li>
                            <li class="result"><?= e(t('project.pk.r2')) ?></li>
                        </ul>
                        <ul class="chip-list">
                            <li class="chip">PHP</li>
                            <li class="chip">SQLite</li>
                            <li class="chip">Vanilla JS</li>
                            <li class="chip">JSON-LD</li>
                        </ul>
                        <?= $projectLink('/projekte/park-klinik/', 'project.pk.name') ?>
                    </div>
                </article>

                <div class="grid project-grid">
                    <article class="project-card">
                        <img class="project-media" src="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller.jpg"
                            alt="<?= e(t('project.lisa.alt')) ?>" width="1200" height="800" loading="lazy" decoding="async">
                        <?php // Werte nachher: PageSpeed Insights, gemessen am 04.11.2026 (Mobil 93, Desktop 100) ?>
                        <p class="project-meta"><?= e(t('project.lisa.kind')) ?> · <?= e(t('project.lisa.year')) ?> · <?= e(t('project.lisa.role')) ?></p>
                        <h3><?= e(t('project.lisa.name')) ?></h3>
                        <p><?= e(t('project.lisa.text')) ?></p>
                        <ul class="results">
                            <li class="result"><?= e(t('project.lisa.r1')) ?></li>
                            <li class="result"><?= e(t('project.lisa.r2')) ?></li>
                        </ul>
                        <?= $projectLink('/projekte/lisa/', 'project.lisa.name') ?>
                    </article>

                    <article class="project-card">
                        <img class="project-media" src="/assets/img/projects/berlin-street-view/teaser-berlin-street-view.jpg"
                            alt="<?= e(t('project.bsv.alt')) ?>" width="600" height="400" loading="lazy" decoding="async">
                        <p class="project-meta"><?= e(t('project.bsv.meta')) ?></p>
                        <h3><?= e(t('project.bsv.name')) ?></h3>
                        <p><?= e(t('project.bsv.text')) ?></p>
                        <ul class="chip-list">
                            <li class="chip">Next.js</li>
                            <li class="chip">TypeScript</li>
                            <li class="chip">MongoDB</li>
                            <li class="chip">OAuth</li>
                            <li class="chip">MapLibre</li>
                        </ul>
                        <?= $projectLink('/projekte/berlin-street-view/', 'project.bsv.name') ?>
                    </article>
                </div>
            </div>
        </section>

        <!-- Erfahrung -->
        <section class="section section--band" aria-labelledby="erfahrung-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('home.exp.eyebrow')) ?></p>
                <h2 id="erfahrung-title"><?= e(t('home.exp.title')) ?></h2>
                <ul class="stats">
                    <?php foreach ([1, 2, 3, 4] as $n): ?>
                        <li class="stat">
                            <p class="stat__value"><?= e(t("home.exp.$n.value")) ?></p>
                            <p class="stat__text"><?= e(t("home.exp.$n.text")) ?><?= $n === 3 ? todo('Ausgangswert und Tool', ' ') : '' ?></p>
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
                <p class="section-foot"><a class="more-link" href="<?= e(url('/leistungen/')) ?>"><?= e(t('home.services.all')) ?> <span aria-hidden="true">→</span></a></p>
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
                    <a class="more-link" href="<?= e(url('/ueber-mich/')) ?>"><?= e(t('home.about.more')) ?> <span aria-hidden="true">→</span></a>
                </div>
            </div>
        </section>

        <?php // Kundenstimme: erscheint live erst, wenn ein echtes Zitat geliefert ist.
        // Aktuell ein erfundener Platzhalter für Prof. Haller (home.quote.text) – darf NICHT live gehen. ?>
        <?php if (is_dev()): ?>
            <section class="quote" aria-label="<?= e(t('home.quote.label')) ?>">
                <figure class="wrap">
                    <blockquote><p><mark class="todo">„<?= e(t('home.quote.text')) ?>“</mark></p></blockquote>
                    <figcaption><?= e(t('project.lisa.name')) ?> <?= todo('Funktion, echtes Zitat von Lisa einholen', ' ') ?></figcaption>
                </figure>
            </section>
        <?php endif; ?>

    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
