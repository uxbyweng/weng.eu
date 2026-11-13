<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => t('about.meta.title'),
    'desc'  => t('about.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

// Werkzeuge: Gruppe => [chip-Variante, Einträge]
$tools = [
    'daily'    => ['chip--strong', ['HTML5', 'CSS3 / SCSS', 'JavaScript', 'WordPress', 'PHP', 'Git', 'Bootstrap', 'SQLite', 'Photoshop']],
    'solid'    => ['chip--outline', ['Figma', 'React', 'Next.js', 'TypeScript', 'Eleventy', 'Nunjucks', 'MySQL', 'Illustrator']],
];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <!-- Hero: Text + Porträt -->
        <section class="about-hero" aria-labelledby="about-title">
            <div class="wrap about-hero__inner">
                <div class="about-hero__text">
                    <p class="eyebrow"><?= e(t('about.eyebrow')) ?></p>
                    <h1 id="about-title"><?= e(t('about.title')) ?></h1>
                    <p class="lead"><?= e(t('about.lead1')) ?></p>
                    <p class="lead"><?= e(t('about.lead2')) ?></p>
                    <dl class="case-facts case-facts--compact">
                        <?php foreach (['place', 'focus'] as $key): ?>
                            <div><dt><?= e(t("about.facts.$key")) ?></dt><dd><?= e(t("about.facts.$key.v")) ?></dd></div>
                        <?php endforeach; ?>
                    </dl>
                </div>
                <figure class="about-hero__figure">
                    <img src="/assets/img/home/weng_profile_1040x1300.webp"
                        srcset="/assets/img/home/weng_profile_520x650.webp 520w, /assets/img/home/weng_profile_1040x1300.webp 1040w"
                        sizes="(max-width: 460px) 100vw, 460px" alt="<?= e(t('about.portrait.alt')) ?>" width="1040" height="1300" fetchpriority="high" decoding="async">
                </figure>
            </div>
        </section>

        <!-- Arbeitsweise -->
        <section class="section section--surface" aria-labelledby="work-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('about.work.eyebrow')) ?></p>
                <h2 id="work-title"><?= e(t('about.work.title')) ?></h2>
                <div class="grid approach">
                    <?php foreach ([1, 2, 3] as $n): ?>
                        <article class="card">
                            <h3><?= e(t("about.work.$n.t")) ?></h3>
                            <p><?= e(t("about.work.$n.x")) ?></p>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Werkzeuge -->
        <section class="section" aria-labelledby="tools-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('about.tools.eyebrow')) ?></p>
                <h2 id="tools-title"><?= e(t('about.tools.title')) ?></h2>
                <div class="tools">
                    <?php foreach ($tools as $group => [$variant, $items]): ?>
                        <div class="tools__group">
                            <h3><?= e(t("about.tools.$group")) ?></h3>
                            <ul class="chip-list">
                                <?php foreach ($items as $item): ?><li class="chip <?= $variant ?>"><?= e($item) ?></li><?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="tools__note"><?= e(t('about.tools.note')) ?>
                    <a class="more-link" href="<?= e(url('/projekte/berlin-street-view/')) ?>"><?= e(t('about.tools.note.link')) ?> <?= chevron_icon() ?></a></p>
            </div>
        </section>

        <!-- Werdegang -->
        <section class="section section--surface" aria-labelledby="career-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('about.career.eyebrow')) ?></p>
                <h2 id="career-title" class="about-section-title"><?= e(t('about.career.title')) ?></h2>
                <ol class="timeline">
                    <?php foreach ([1, 2, 3, 4, 5, 6] as $n): ?>
                        <li class="timeline__item">
                            <p class="timeline__period"><?= e(t("about.st.$n.p")) ?></p>
                            <div class="timeline__body">
                                <h3><?= e(t("about.st.$n.t")) ?></h3>
                                <p class="timeline__org"><?= e(t("about.st.$n.o")) ?></p>
                                <?php if (t("about.st.$n.x") !== ''): ?><p class="timeline__text"><?= e(t("about.st.$n.x")) ?></p><?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </div>
        </section>

        <!-- Zusammenarbeit -->
        <section class="section" aria-label="<?= e(t('about.closing.contact')) ?>">
            <div class="wrap">
                <p class="about-closing__lead"><?= e(t('about.closing.lead')) ?></p>
                <div class="about-closing__actions">
                    <a class="button" href="<?= e(url('/kontakt/')) ?>"><?= e(t('about.closing.contact')) ?></a>
                    <a class="button button--secondary" href="<?= e(SITE_LINKEDIN) ?>" target="_blank" rel="noopener noreferrer"><?= e(t('about.closing.linkedin')) ?> <?= ext_icon() ?><?= new_window_hint() ?></a>
                </div>
                <p class="about-closing__note"><?= e(t('about.closing.note')) ?></p>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
