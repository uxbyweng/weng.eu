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
    'daily'    => ['chip--strong', ['HTML5', 'CSS3 / SCSS', 'JavaScript', 'Figma', 'WordPress', 'PHP', 'Git']],
    'solid'    => ['chip--outline', ['React', 'Next.js', 'TypeScript', 'Bootstrap', 'Eleventy', 'Nunjucks', 'MySQL', 'Photoshop', 'Illustrator']],
    'learning' => ['chip--learning', ['Node.js', 'SQL & Prisma', 'Auth', 'WebSockets', 'LangChain']],
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
                        <?php foreach (['place', 'exp', 'focus', 'lang'] as $key): ?>
                            <div><dt><?= e(t("about.facts.$key")) ?></dt><dd><?= e(t("about.facts.$key.v")) ?></dd></div>
                        <?php endforeach; ?>
                    </dl>
                    <?php if ($portraitTodo = todo('Aktuelles Porträt (hochformatig) – hier steht noch das Foto der Startseite')): ?><p><?= $portraitTodo ?></p><?php endif; ?>
                </div>
                <figure class="about-hero__figure">
                    <img src="/assets/img/home/about-me.jpg" alt="<?= e(t('about.portrait.alt')) ?>" width="900" height="1153" fetchpriority="high" decoding="async">
                </figure>
            </div>
        </section>

        <!-- Werdegang -->
        <section class="section" aria-labelledby="career-title">
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
                                <p class="timeline__text"><?= e(t("about.st.$n.x")) ?></p>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ol>
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
                <h2 id="tools-title"><?= e(t('about.tools.title')) ?><?= todo('Einstufung der Werkzeuge prüfen', ' ') ?></h2>
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
            </div>
        </section>

        <!-- Weiterbildung (dunkles Band) -->
        <section class="section section--band" aria-labelledby="training-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('about.training.eyebrow')) ?></p>
                <h2 id="training-title"><?= e(t('about.training.title')) ?></h2>
                <p class="training__lead"><?= e(t('about.training.lead')) ?></p>
                <div class="training">
                    <article class="training__card">
                        <p class="training__period"><?= e(t('about.training.1.p')) ?></p>
                        <h3><?= e(t('about.training.1.t')) ?></h3>
                        <p><?= e(t('about.training.1.x')) ?></p>
                        <a class="training__link" href="<?= e(url('/projekte/berlin-street-view/')) ?>"><?= e(t('about.training.1.l')) ?> <span aria-hidden="true">→</span></a>
                    </article>
                    <article class="training__card">
                        <p class="training__period"><?= e(t('about.training.2.p')) ?></p>
                        <h3><?= e(t('about.training.2.t')) ?></h3>
                        <p><?= e(t('about.training.2.x')) ?></p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Zusammenarbeit -->
        <section class="section" aria-label="<?= e(t('about.closing.contact')) ?>">
            <div class="wrap">
                <p class="about-closing__lead"><?= e(t('about.closing.lead')) ?></p>
                <div class="about-closing__actions">
                    <a class="button" href="<?= e(url('/kontakt/')) ?>"><?= e(t('about.closing.contact')) ?></a>
                    <a class="button button--secondary" href="<?= e(SITE_LINKEDIN) ?>" rel="noopener"><?= e(t('about.closing.linkedin')) ?> <span aria-hidden="true">↗</span></a>
                </div>
                <p class="about-closing__note"><?= e(t('about.closing.note')) ?></p>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
