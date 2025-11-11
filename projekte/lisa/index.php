<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Projekt: Website-Relaunch Prof. Dr. Lisa Y. Haller',
    'desc'  => 'Ein umfassender Relaunch der Website von Prof. Dr. Lisa Y. Haller.',
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
                            <span class="font-accent">Prof. Dr. Lisa Y. Haller</span><br>
                            Website-Relaunch
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/projects/lisa/screen-lisa-about-page.jpg" alt="Screen: Prof. Dr. Lisa Yashodhara Haller - About Page" width="500" height="500" class="img-fluid box-shadow" loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <?php if (is_en()): ?>
                                <em>Complete relaunch of the website – including website conception, design, responsive frontend and technical implementation. Focus: accessibility, performance and a clearly structured appearance.</em>
                            <?php else: ?>
                                <em>Komplett-Relaunch der Website – inklusive Website-Konzeption, Design, responsivem Frontend und technischer Umsetzung. Fokus: Zugänglichkeit, Performance und ein klar strukturierter Auftritt.</em>
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
                        <aricle>
                            <img src="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller.jpg" alt="Screen: Prof. Dr. Lisa Yashodhara Haller - Startseite 2025" class="img-fluid box-shadow mb-5" loading="lazy">
                            <figcaption class="text-muted small mt-2">
                                <?php if (is_en()): ?>
                                    Clearly structured homepage with a focus on readability and lightness
                                <?php else: ?>
                                    Klar strukturierte Startseite mit Fokus auf Lesbarkeit und Leichtigkeit
                                <?php endif; ?>
                            </figcaption>
                        </aricle>
                        <!--aricle>
                        <img src="/assets/img/projects/screen-strato-windows-v-server-filtertabelle.jpg" alt="Screen: Filterbare Windows V-Server Tabelle" class="img-fluid mb-5" loading="lazy">
                    </aricle>
                    <aricle>
                        <img src="/assets/img/projects/strato/screen-strato-trust-leiste-2024.png" alt="Screen: STRATO Trust-Icon-Bar" class="img-fluid box-shadow mb-5" loading="lazy">
                    </aricle>
                    <aricle>
                        <div class="row g-4 mb-5">
                            <div class="col-12 col-md-6 px-5">
                                <img src="/assets/img/projects/strato/undraw_hosting_vorteile_inklusive.svg" alt="Illustration: STRATO FAQ Icon" class="img-fluid" loading="lazy">
                            </div>
                            <div class="col-12 col-md-6 px-5">
                                <img src="/assets/img/projects/strato/undraw_lupe.svg" alt="Illustration: STRATO FAQ Icon" class="img-fluid" loading="lazy">
                            </div>
                            <div class="col-12 col-md-6 px-5">
                                <img src="/assets/img/projects/strato/faireinfacht_2020.svg" alt="Illustration: STRATO #FAIREINFACHT" class="img-fluid" loading="lazy">
                            </div>
                        </div>
                    </aricle-->
                    </div>

                    <aside class="col-12 col-md-4 order-2 pt-5 pt-md-0 pe-5">
                        <section class="pb-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Info</strong>
                            </h2>
                            <p>
                                <?php if (is_en()): ?>
                                    The new web presence for Prof. Dr. Lisa Y. Haller was designed from scratch. The goal was a contemporary, professional appearance with a clear content structure and responsive design.
                                <?php else: ?>
                                    Die neue Webpräsenz für Prof. Dr. Lisa Y. Haller wurde von Grund auf neu konzipiert. Ziel war ein zeitgemäßer, professioneller Auftritt mit klarer inhaltlicher Struktur und responsivem Design.
                                <?php endif; ?>
                            </p>
                        </section>
                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Tech-Stack</strong>
                            </h2>
                            <p>
                                Bootstrap 5, HTML5, CSS3, PHP, JavaScript
                            </p>
                        </section>
                        <section class="py-3 border-bottom">
                            <h2 class="fs-20 text-uppercase">
                                <strong>Services</strong>
                            </h2>
                            <p>
                                <?php if (is_en()): ?>
                                    Conception, Responsive Web Design, Frontend Development, PHP Integration, UI/UX, Image Optimization, Accessibility, Logo Design
                                <?php else: ?>
                                    Konzeption, Responsive Webdesign, Frontend-Entwicklung, PHP-Integration, UI/UX, Bildoptimierung, Barrierefreiheit, Logo-Design
                                <?php endif; ?>
                            </p>
                        </section>
                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>URL</strong>
                            </h2>
                            <p>
                                <a href="https://www.lisa-yashodhara-haller.de/" class="text-link" rel="nofollow">lisa-yashodhara-haller.de</a>
                            </p>
                        </section>
                        <section class="py-3">
                            <h2 class="fs-20 text-uppercase">
                                <?php if (is_en()): ?>
                                    <strong>Period</strong>
                                <?php else: ?>
                                    <strong>Zeitraum</strong>
                                <?php endif; ?>
                            </h2>
                            <p>2023–2024</p>
                        </section>
                    </aside>

                </div>
            </div>
        </section>


    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>