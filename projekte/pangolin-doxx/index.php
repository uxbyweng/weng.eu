<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Projekt: Pangolin Doxx Film - Webdesign & Entwicklung',
    'desc'  => 'Betreuung,Konzeption, Design, Frontend & Backend (PHP) mit Fokus auf Stabilität, Performance und einfacher Pflege. ',
    'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
$isEn = is_en();
?>

<body>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main class="page-wrapper" id="startMainContent">

        <!-- ### BREADCRUMB ### -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <!-- ### STAGE ### -->
        <section class="px-3 px-md-0 py-2 py-md-5">
            <div class="container">
                <div class="row align-items-center">

                    <div class="col-12 col-md-7 order-1">
                        <h1>
                            <span class="font-accent">Pangolin Doxx Film</span><br>
                            <?php if (is_en()): ?>
                                Webdesign & Development
                            <?php else: ?>
                                Webdesign & Entwicklung
                            <?php endif; ?>
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/projects/pangolin-doxx/screen-startseite-pangolin-doxx.jpg"
                            alt="Screen: Pangolin Doxx Film – Startseite"
                            width="500" height="500"
                            class="img-fluid box-shadow" loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <?php if (is_en()): ?>
                                <em>Ongoing support since 2015: conception, design, frontend & backend (PHP) with a focus on stability, performance and easy maintenance. Logo redesign included, bilingual DE/EN structure and a lightweight blog system based on PHP/SQLite.</em>
                            <?php else: ?>
                                <em>Langfristige Betreuung seit 2015: Konzeption, Design, Frontend & Backend (PHP) mit Fokus auf Stabilität, Performance und einfacher Pflege. Logo-Redesign inklusive, zweisprachige DE/EN-Struktur und ein leichtgewichtiges Blog-System auf PHP/SQLite-Basis.</em>
                            <?php endif; ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="px-3 px-md-0 py-3">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-8 order-1 pe-5">
                        <article>
                            <img src="/assets/img/projects/pangolin-doxx/screen-filmseite-sleepless-birds-pangolin-doxx.jpg"
                                alt="Screen: Pangolin Doxx Film – Filmseoite 'Sleepless Birds'"
                                class="img-fluid box-shadow mb-4" loading="lazy">
                            <figcaption class="text-muted small mt-2">
                                <?php if (is_en()): ?>
                                    Film page with synopsis, credits, press reviews, festival selections, trailer and photo gallery
                                <?php else: ?>
                                    Startseite mit klarer Bildsprache und schnellen Ladezeiten (optimierte Assets)
                                <?php endif; ?>
                            </figcaption>
                        </article>

                        <article class="mt-5">
                            <h2 class="font-primary fs-20 text-uppercase mb-3"><strong>Highlights</strong></h2>
                            <ul class="list-unstyled mb-4">
                                <?php if (is_en()): ?>
                                    <li class="mb-2">• Bilingual (DE/EN) with easy language switching</li>
                                    <li class="mb-2">• Custom blog ("News") as a PHP mini-CMS (SQLite, login, CRUD)</li>
                                    <li class="mb-2">• New logo development & consistent branding</li>
                                    <li class="mb-2">• Bootstrap 3 frontend (customer-side) + clean HTML/CSS/JS</li>
                                    <li class="mb-2">• Performance tuning (lazy loading, image compression, caching)</li>
                                    <li class="mb-2">• Continuous maintenance & security updates</li>
                                <?php else: ?>
                                    <li class="mb-2">• <strong>Zweisprachigkeit (DE/EN)</strong> mit einfacher Sprachumschaltung</li>
                                    <li class="mb-2">• <strong>Custom-Blog („Aktuelles“)</strong> als PHP-Mini-CMS (SQLite, Login, CRUD)</li>
                                    <li class="mb-2">• <strong>Logo-Neuentwicklung</strong> & konsistentes Branding</li>
                                    <li class="mb-2">• <strong>Bootstrap-3-Frontend</strong> (kundenseitig) + sauberes HTML/CSS/JS</li>
                                    <li class="mb-2">• <strong>Performance-Tuning</strong> (Lazy-Loading, Bildkompression, Caching)</li>
                                    <li class="mb-2">• <strong>Kontinuierliche Pflege</strong> & Security-Updates</li>
                                <?php endif; ?>
                            </ul>
                        </article>

                        <article class="mt-4">
                            <a href="/assets/img/projects/pangolin-doxx/screen-blog-admin-php-sqlite-pangolin-doxx.jpg" target="_blank"><img src="/assets/img/projects/pangolin-doxx/screen-blog-admin-php-sqlite-pangolin-doxx.jpg"
                                    alt="Screen: Blog-Admin (PHP/SQLite) – Beiträge verwalten"
                                    class="img-fluid box-shadow mb-2" loading="lazy"></a>
                            <figcaption class="text-muted small">
                                <?php if (is_en()): ?>
                                    PHP/SQLite-based admin area with 5 input fields (title, teaser, date, text, image) – create, edit, delete posts
                                <?php else: ?>
                                    PHP/SQLite-basierter Admin-Bereich mit 5 Eingabefeldern (Titel, Teaser, Datum, Text, Bild) – Beiträge anlegen, bearbeiten, löschen
                                <?php endif; ?>
                            </figcaption>
                        </article>

                        <!--article class="mt-4">
                        <a href="/assets/img/projects/pangolin-doxx/screen-pangolin-language-switch.jpg" target="_blank"><img src="/assets/img/projects/pangolin-doxx/screen-pangolin-language-switch.jpg"
                             alt="Screen: Sprachumschaltung DE/EN"
                             class="img-fluid box-shadow mb-2" loading="lazy"></a>
                        <figcaption class="text-muted small">
                            <?php if (is_en()): ?>
                                DE/EN language switch: semantically correct, SEO-friendly and easy for editors
                            <?php else: ?>
                                DE/EN-Sprachumschaltung: semantisch sauber, suchmaschinenfreundlich und für Redakteure unkompliziert
                            <?php endif; ?>
                        </figcaption>
                    </article-->
                    </div>

                    <aside class="col-12 col-md-4 order-2 pt-5 pt-md-0 pe-5">
                        <section class="pb-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>Info</strong></h2>
                            <p>
                                <?php if (is_en()): ?>
                                    Since 2015, I have been holistically managing the website of <em>Pangolin Doxx Film</em>: from design to technical implementation to ongoing development. Goal: a long-lasting, robust solution – without overhead, with quick editing.
                                <?php else: ?>
                                    Seit 2015 betreue ich die Website von <em>Pangolin Doxx Film</em> ganzheitlich: von der Gestaltung über die technische Umsetzung bis zur laufenden Weiterentwicklung. Ziel: langlebige, robuste Lösung – ohne Overhead, mit schneller Redaktion.
                                <?php endif; ?>
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>Tech-Stack</strong></h2>
                            <p>
                                Bootstrap&nbsp;3, HTML5, CSS3, PHP, JavaScript, SQLite
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>Services</strong></h2>
                            <p>
                                <?php if (is_en()): ?>
                                    Conception, responsive web design, frontend development, PHP integration, logo design, bilingualism (DE/EN), performance optimization, accessibility, operation & maintenance, editorial training
                                <?php else: ?>
                                    Konzeption, Responsive Webdesign, Frontend-Entwicklung, PHP-Integration, Logo-Design, Mehrsprachigkeit (DE/EN), Performance-Optimierung, Barrierearmut, Betrieb & Wartung, Redaktionsschulungen
                                <?php endif; ?>
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>URL</strong></h2>
                            <p>
                                <a href="https://www.pangolin-doxx.com/" class="text-link" rel="nofollow" target="_blank">pangolin-doxx.com</a>
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>Blog/CMS</strong></h2>
                            <p>
                                <?php if (is_en()): ?>
                                    Lightweight login-protected admin interface 5 fields (DE/EN) per post: title, teaser, text, image, link. With DB backup option and post output as paginated news list.
                                <?php else: ?>
                                    Leichtgewichtiges login-geschütztesAdmin-Interface, 5 Felder (de/en) je Beitrag: Titel, Teaser, Text, Bild, Link. Mit DB-Backup Möglichkeit und Beitrags-Ausgabe als paginierte News-Liste.
                                <?php endif; ?>
                            </p>
                        </section>

                        <section class="py-3">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>Zeitraum</strong></h2>
                            <p>
                                <?php if (is_en()): ?>
                                    2015 – present (ongoing)
                                <?php else: ?>
                                    2015 – heute (laufend)
                                <?php endif; ?>
                            </p>
                        </section>
                    </aside>

                </div>
            </div>
        </section>

    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>