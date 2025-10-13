<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Easy-to-Read Language / Leichte Sprache',
    'desc'  => 'What makes a good website - explained simply.',
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
                <div class="row">

                    <div class="col-12 col-md-7 order-1">
                        <h1>
                            <?php if ($sprache === 'en'): ?>
                                Website in<br>
                                <span class="font-accent">Easy-to-Read Language</span>
                            <?php else: ?>
                                Website in<br>
                                <span class="font-accent">Leichter Sprache</span>
                            <?php endif; ?>
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/home/undraw_user-flow_d1ya.svg" alt="User Flow Illustration" width="500" height="500" class="img-fluid">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-5 my-3">
                            <?php if ($sprache === 'en'): ?>
                                What makes a good website - explained simply:<br>
                                Good websites are not only visually appealing but also easy to use. They load quickly, are accessible, and can be easily found via search engines. The design is clear. The code is clean.
                            <?php else: ?>
                                Was gute Webseiten ausmacht – einfach erklärt:<br>
                                Gute Webseiten sehen nicht nur schön aus sondern sind auch leicht zu benutzen. Sie laden schnell, sind barrierefrei und gut über Suchmaschinen zu finden. Das Design ist klar. Der Code ist sauber.
                            <?php endif; ?>
                        </p>
                        <div class="text-center text-md-start">
                            <a href="/kontakt/" class="btn btn-secondary d-inline-flex align-items-center gap-2 my-4 px-4 py-2">
                                <?php if ($sprache === 'en'): ?>
                                    Get in touch
                                <?php else: ?>
                                    Kontakt aufnehmen
                                <?php endif; ?>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- ### SERVICES ### -->
        <section class="px-3 px-md-0 py-5">
            <div class="container">
                <h2 class="font-primary mt-0 mb-4">
                    <?php if ($sprache === 'en'): ?>
                        Services
                    <?php else: ?>
                        Leistungen
                    <?php endif; ?>
                </h2>
                <ul>
                    <?php if ($sprache === 'en'): ?>
                        <li>
                            <h3>Making websites easy to use and clearly structured</h3>
                        </li>
                        <li>
                            <h3>Programming web applications</h3>
                        </li>
                        <li>
                            <h3>Making websites accessible and faster to load</h3>
                        </li>
                        <li>
                            <h3>Optimizing websites for search engines like Google</h3>
                        </li>
                        <li>
                            <h3>Taking and editing photos</h3>
                        </li>
                    <?php else: ?>
                        <li>
                            <h3>Webseiten leicht bedienbar machen und übersichtlich gestalten </h3>
                        </li>
                        <li>
                            <h3>Programmierung von Webanwendungen</h3>
                        </li>
                        <li>
                            <h3>Webseiten barrierefrei machen und schneller laden lassen</h3>
                        </li>
                        <li>
                            <h3>Webseiten für Suchmaschinen wie z.B. Google optimieren</h3>
                        </li>
                        <li>
                            <h3>Fotos machen und bearbeiten</h3>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </section>

        <!-- ### ARBEITSBEISPIELE (inline, Leichte Sprache) ### -->
        <section class="px-3 px-md-0 py-5">
            <div class="container">

                <h2 class="font-primary mt-0 mb-4">
                    <?php if ($sprache === 'en'): ?>
                        Work Samples
                    <?php else: ?>
                        Arbeitsbeispiele
                    <?php endif; ?>
                </h2>

                <div class="row g-4">

                    <!-- STRATO -->
                    <article class="col-lg-12 row g-0">
                        <div class="col-lg-6 p-4">
                            <div class="box-shadow">
                                <img class="img-fluid" src="/assets/img/projects/strato/screen-strato-startseite-03-2024-xs.jpg" alt="<?php if ($sprache === 'en'): ?>Project STRATO: Screen of the homepage<?php else: ?>Projekt STRATO: Screen der Startseite<?php endif; ?>" loading="lazy">
                            </div>
                        </div>
                        <div class="col-lg-6 p-4">
                            <div class="pt-3">
                                <h3 class="font-primary fs-24 mb-3">
                                    STRATO – Shop-Frontend
                                </h3>
                                <p class="fs-20 my-3">
                                    <?php if ($sprache === 'en'): ?>
                                        Continuous development and maintenance of the shop frontend – focusing on usability, performance, and maintainable code in an agile, cross-functional team.
                                    <?php else: ?>
                                        Kontinuierliche Weiterentwicklung und Pflege des Shop-Frontends – mit Fokus auf Usability, Performance und wartbarem Code in einem agilen, crossfunktionalen Team.
                                    <?php endif; ?>
                                </p>
                                <p class="fs-20 my-3">
                                    <a href="https://www.strato.de" rel="nofollow" target="_blank">strato.de</a>
                                </p>
                                <a href="/projekte/strato/" class="btn btn-secondary d-inline-flex align-items-center gap-2 my-3 px-4 py-2">
                                    <?php if ($sprache === 'en'): ?>
                                        More info about Project STRATO
                                    <?php else: ?>
                                        Mehr Infos zum Projekt STRATO
                                    <?php endif; ?>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <hr>

                    <!-- LISA -->
                    <article class="col-lg-12 row g-0">
                        <div class="col-lg-6 p-4">
                            <div class="box-shadow">
                                <img class="img-fluid" src="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller.jpg" alt="Website von Prof. Dr. Lisa Yashodhara Haller" loading="lazy">
                            </div>
                        </div>
                        <div class="col-lg-6 p-4">
                            <div class="pt-3">
                                <h3 class="font-primary fs-24 mb-3">
                                    Prof. Dr. Lisa Y. Haller – Website
                                </h3>
                                <p class="fs-20 my-3">
                                    <?php if ($sprache === 'en'): ?>
                                        Complete relaunch of the website – including website conception, design, responsive frontend, and technical implementation. Focus: Accessibility, performance, and a clearly structured appearance.
                                    <?php else: ?>
                                        Komplett-Relaunch der Website – inklusive Website-Konzeption, Design, responsivem Frontend und technischer Umsetzung. Fokus: Zugänglichkeit, Performance und ein klar strukturierter Auftritt.
                                    <?php endif; ?>
                                </p>
                                <p class="fs-20 my-3">
                                    <a href="https://www.lisa-yashodhara-haller.de/" rel="nofollow" target="_blank">lisa-yashodhara-haller.de</a>
                                </p>
                                <a href="/projekte/lisa/" class="btn btn-secondary d-inline-flex align-items-center gap-2 my-3 px-4 py-2">
                                    <?php if ($sprache === 'en'): ?>
                                        More info about Project Lisa
                                    <?php else: ?>
                                        Mehr Infos zum Projekt Lisa
                                    <?php endif; ?>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <hr>

                    <!-- PARK-KLINIK BIRKENWERDER -->
                    <article class="col-lg-12 row g-0">
                        <div class="col-lg-6 p-4">
                            <div class="box-shadow">
                                <img class="img-fluid" src="/assets/img/projects/park-klinik/screen-startseite-park-klinik-birkenwerder.jpg" alt="Screen: Startseite der Park-Klinik Birkenwerder" loading="lazy">
                            </div>
                        </div>
                        <div class="col-lg-6 p-4">
                            <div class="pt-3">
                                <h3 class="font-primary fs-24 mb-3">
                                    Park-Klinik Birkenwerder – Website
                                </h3>
                                <p class="fs-20 my-3">
                                    <?php if ($sprache === 'en'): ?>
                                        Complete relaunch of the website – including website conception, design, responsive frontend, and technical implementation. Focus: Accessibility, performance, and a clearly structured appearance.
                                    <?php else: ?>
                                        Konzeption, Design und die komplette technische Umsetzung auf Basis von Bootstrap 5. Fokus: Barrierearme UX, Performance, saubere SEO-Grundlagen und effiziente Pflege mit PHP-Includes.
                                    <?php endif; ?>
                                </p>
                                <p class="fs-20 my-3">
                                    <a href="https://www.park-klinik-birkenwerder.de/" rel="nofollow" target="_blank">park-klinik-birkenwerder.de</a>
                                </p>
                                <a href="/projekte/park-klinik/" class="btn btn-secondary d-inline-flex align-items-center gap-2 my-3 px-4 py-2">
                                    <?php if ($sprache === 'en'): ?>
                                        More info about Project Park-Klinik
                                    <?php else: ?>
                                        Mehr Infos zum Projekt Park-Klinik
                                    <?php endif; ?>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                    <hr>

                    <!-- PANGOLIN-DOXX -->
                    <article class="col-lg-12 row g-0">
                        <div class="col-lg-6 p-4">
                            <div class="box-shadow">
                                <img class="img-fluid" src="/assets/img/projects/pangolin-doxx/screen-startseite-pangolin-doxx.jpg" alt="Screen: Startseite von Pangolin-Doxx" loading="lazy">
                            </div>
                        </div>
                        <div class="col-lg-6 p-4">
                            <div class="pt-3">
                                <h3 class="font-primary fs-24 mb-3">
                                    Pangolin-Doxx – Website
                                </h3>
                                <p class="fs-20 my-3">
                                    <?php if ($sprache === 'en'): ?>
                                        Complete relaunch of the website – including website conception, design, responsive frontend, and technical implementation. Focus: Accessibility, performance, and a clearly structured appearance.
                                    <?php else: ?>
                                        Langfristige Betreuung seit 2015: Konzeption, Design, Frontend & Backend (PHP) mit Fokus auf Stabilität, Performance und einfacher Pflege. Logo-Redesign inklusive, zweisprachige DE/EN-Struktur und ein leichtgewichtiges Blog-System auf PHP/SQLite-Basis.
                                    <?php endif; ?>
                                </p>
                                <p class="fs-20 my-3">
                                    <a href="https://www.pangolin-doxx.com/" rel="nofollow" target="_blank">pangolin-doxx.com</a>
                                </p>
                                <a href="/projekte/park-klinik/" class="btn btn-secondary d-inline-flex align-items-center gap-2 my-3 px-4 py-2">
                                    <?php if ($sprache === 'en'): ?>
                                        More info about Project Pangolin-Doxx
                                    <?php else: ?>
                                        Mehr Infos zum Projekt Pangolin-Doxx
                                    <?php endif; ?>
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </article>

                </div>
            </div>
        </section>

        <!-- ### ABOUT ME ### -->
        <section class="about-me-section-wrapper">
            <div class="about-me-section">
                <div class="about-me-content container-xxl">
                    <div class="row justify-content-center text-white">
                        <div class="col-xl-10">
                            <p class="font-handwriting display-6 fw-light">
                                „Gute Webentwicklung bedeutet offene Kommunikation, geteiltes Wissen und Lösungen, die für Menschen verständlich sind – nicht nur für den Code.“
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>