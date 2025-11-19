<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Projekt: STRATO Shop-Frontend',
    'desc'  => 'Web Development & laufende Betreuung des STRATO Shop-Frontends. Fokus: Barrierearme UX, Performance. Wartbarer Code in einem agilen, crossfunktionalen Team.',
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
                            <span class="font-accent">STRATO</span><br>
                            Shop-Frontend
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/projects/strato/screen-startseite-strato-april-2024.jpg" alt="Screen: STRATO Startseite 2024" class="img-fluid box-shadow" loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <em>Weiterentwicklung und Pflege des Shop-Frontends – mit Fokus auf Usability, Performance und wartbarem Code in einem agilen, crossfunktionalen Team.</em>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="px-3 px-md-0 py-3">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-8 order-1 pe-2 pe-md-5">

                        <div class="ref-viewport" role="region" aria-label="Scrollable reference screen" tabindex="0">
                            <figure>
                                <picture>
                                    <source srcset="/assets/img/projects/strato/screen_strato_woocommerce_full_page_mai_2024.webp" type="image/webp">
                                    <img
                                        src="/assets/img/projects/strato/screen_strato_woocommerce_full_page_mai_2024.jpg"
                                        class="screen-img"
                                        alt="STRATO WooCommerce – vollständiger Seiten-Screenshot, Stand Mai 2024"
                                        loading="lazy"
                                        decoding="async"
                                        sizes="(min-width: 992px) 800px, 100vw">
                                </picture>
                                <figcaption>Screen: STRATO WooCommerce Full Page Mai 2024 — <a href="/assets/img/projects/strato/screen_strato_woocommerce_full_page_mai_2024.jpg" target="_blank" rel="noopener">In neuem Tab öffnen</a></figcaption>
                            </figure>
                        </div>


                        <!--aricle>
                        <img src="/assets/img/projects/strato/screen-strato-mobile-menu-2024.jpg" alt="Screen: STRATO Mobile Menu 2024" class="img-fluid box-shadow mb-5" loading="lazy">
                    </aricle>
                    <aricle>
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
                                Die STRATO Shopplattform basiert auf einem modularen, responsiven Frontend. Eingebettet in ein agiles Setup kommen moderne Webtechnologien und Headless-Architekturen zum Einsatz.
                            </p>
                        </section>
                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Tech-Stack</strong>
                            </h2>
                            <p>
                                Bootstrap 5, Eleventy (Static Site Generator), Nunjucks, GitLab, Jenkins, Imperia CMS, Strapi (Headless CMS), JIRA, Confluence, Figma
                            </p>
                        </section>
                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Services</strong>
                            </h2>
                            <p>
                                UI/UX Design, Frontend-Entwicklung, Design-Systeme, SEO, Accessibility, Web-konforme Bildbearbeitung
                            </p>
                        </section>
                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>URL</strong>
                            </h2>
                            <p>
                                <a href="http://www.strato.de" class="text-link" rel="nofollow">www.strato.de </a>
                            </p>
                        </section>
                        <section class="py-3">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Zeitraum</strong>
                            </h2>
                            <p>2005 -2025</p>
                        </section>
                    </aside>

                </div>
            </div>
        </section>


    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>