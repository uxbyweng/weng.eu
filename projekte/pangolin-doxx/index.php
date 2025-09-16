<?php 
require $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php'; 
require $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
?>

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
                        Webdesign & Entwicklung
                    </h1>
                </div>

                <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                    <img src="/assets/img/projects/pangolin-doxx/screen-startseite-pangolin-doxx.jpg"
                         alt="Screen: Pangolin Doxx Film – Startseite"
                         width="500" height="500"
                         class="img-fluid box-shadow" loading="lazy">
                </div>

                <div class="col-12 col-md-7 order-3 order-md-2">
                    <p class="fs-24 lh-1-3 my-3">
                        <em>Langfristige Betreuung seit 2015: Konzeption, Design, Frontend & Backend (PHP) mit Fokus auf Stabilität, Performance und einfacher Pflege.
                            Logo-Redesign inklusive, zweisprachige DE/EN-Struktur und ein leichtgewichtiges Blog-System auf PHP/SQLite-Basis.</em>
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
                            Startseite mit klarer Bildsprache und schnellen Ladezeiten (optimierte Assets)
                        </figcaption>
                    </article>

                    <article class="mt-5">
                        <h2 class="fs-20 text-uppercase mb-3"><strong>Highlights</strong></h2>
                        <ul class="list-unstyled mb-4">
                            <li class="mb-2">• <strong>Zweisprachigkeit (DE/EN)</strong> mit einfacher Sprachumschaltung</li>
                            <li class="mb-2">• <strong>Custom-Blog („Aktuelles“)</strong> als PHP-Mini-CMS (SQLite, Login, CRUD)</li>
                            <li class="mb-2">• <strong>Logo-Neuentwicklung</strong> & konsistentes Branding</li>
                            <li class="mb-2">• <strong>Bootstrap-3-Frontend</strong> (kundenseitig) + sauberes HTML/CSS/JS</li>
                            <li class="mb-2">• <strong>Performance-Tuning</strong> (Lazy-Loading, Bildkompression, Caching)</li>
                            <li class="mb-2">• <strong>Kontinuierliche Pflege</strong> & Security-Updates</li>
                        </ul>
                    </article>

                    <article class="mt-4">
                        <a href="/assets/img/projects/pangolin-doxx/screen-blog-admin-php-sqlite-pangolin-doxx.jpg" target="_blank"><img src="/assets/img/projects/pangolin-doxx/screen-blog-admin-php-sqlite-pangolin-doxx.jpg"
                             alt="Screen: Blog-Admin (PHP/SQLite) – Beiträge verwalten"
                             class="img-fluid box-shadow mb-2" loading="lazy"></a>
                        <figcaption class="text-muted small">
                            PHP/SQLite-basierter Admin-Bereich mit 5 Eingabefeldern (Titel, Teaser, Datum, Text, Bild) – Beiträge anlegen, bearbeiten, löschen
                        </figcaption>
                    </article>

                    <article class="mt-4">
                        <a href="/assets/img/projects/pangolin-doxx/screen-pangolin-language-switch.jpg" target="_blank"><img src="/assets/img/projects/pangolin-doxx/screen-pangolin-language-switch.jpg"
                             alt="Screen: Sprachumschaltung DE/EN"
                             class="img-fluid box-shadow mb-2" loading="lazy"></a>
                        <figcaption class="text-muted small">
                            DE/EN-Sprachumschaltung: semantisch sauber, suchmaschinenfreundlich und für Redakteure unkompliziert
                        </figcaption>
                    </article>
                </div>

                <aside class="col-12 col-md-4 order-2 pt-5 pt-md-0 pe-5">
                    <section class="pb-3 border-bottom">
                        <h2 class="fs-20 text-uppercase"><strong>Info</strong></h2>
                        <p>
                            Seit 2015 betreue ich die Website von <em>Pangolin Doxx Film</em> ganzheitlich: von
                            der Gestaltung über die technische Umsetzung bis zur laufenden Weiterentwicklung.
                            Ziel: langlebige, robuste Lösung – ohne Overhead, mit schneller Redaktion.
                        </p>
                    </section>

                    <section class="py-3 border-bottom">
                        <h2 class="fs-20 text-uppercase"><strong>Tech-Stack</strong></h2>
                        <p>
                            Bootstrap&nbsp;3, HTML5, CSS3, PHP, JavaScript, SQLite
                        </p>
                    </section>

                    <section class="py-3 border-bottom">
                        <h2 class="fs-20 text-uppercase"><strong>Services</strong></h2>
                        <p>
                            Konzeption, Responsive Webdesign, Frontend-Entwicklung, PHP-Integration,
                            Logo-Design, Mehrsprachigkeit (DE/EN), Performance-Optimierung,
                            Barrierearmut, Betrieb & Wartung, Redaktionsschulungen
                        </p>
                    </section>

                    <section class="py-3 border-bottom">
                        <h2 class="fs-20 text-uppercase"><strong>URL</strong></h2>
                        <p>
                            <a href="https://www.pangolin-doxx.com/" rel="nofollow" target="_blank">pangolin-doxx.com</a>
                        </p>
                    </section>

                    <section class="py-3 border-bottom">
                        <h2 class="fs-20 text-uppercase"><strong>Blog/CMS</strong></h2>
                        <p>
                            Leichtgewichtiges login-geschütztesAdmin-Interface, 5 Felder (de/en) je Beitrag:
                            Titel, Teaser, Text, Bild, Link. Mit DB-Backup Möglichkeit und Beitrags-
                            Ausgabe als paginierte News-Liste.
                        </p>
                    </section>

                    <section class="py-3">
                        <h2 class="fs-20 text-uppercase"><strong>Zeitraum</strong></h2>
                        <p>2015 – heute (laufend)</p>
                    </section>
                </aside>

            </div>
        </div>
    </section>

</main>

<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>
