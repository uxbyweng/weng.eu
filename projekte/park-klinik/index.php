<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Projekt: Park-Klinik Birkenwerder – Web Development & Betreuung',
    'desc'  => 'Web Development & laufende Betreuung der Park-Klinik Birkenwerder. Fokus: Barrierearme UX, Performance, saubere SEO-Grundlagen und effiziente Pflege mit PHP-Includes.',
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
                            <span class="font-accent">Park-Klinik Birkenwerder</span><br>
                            <?php if (is_en()): ?>
                                Website relaunch & ongoing maintenance
                            <?php else: ?>
                                Website-Relaunch & laufende Betreuung
                            <?php endif; ?>
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/projects/park-klinik/screen-startseite-park-klinik-birkenwerder.jpg"
                            alt="Screen: Park-Klinik Birkenwerder – Startseite"
                            width="500" height="500"
                            class="img-fluid box-shadow" loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <?php if (is_en()): ?>
                                <em>Since 2017 responsible for conception, design and complete technical implementation based on Bootstrap 5. Focus: Accessible UX, performance, solid SEO fundamentals and efficient maintenance with PHP includes.</em>
                            <?php else: ?>
                                <em>Seit 2017 verantwortlich für Konzeption, Design und die komplette technische Umsetzung auf Basis von Bootstrap 5. Fokus: Barrierearme UX, Performance, saubere SEO-Grundlagen und effiziente Pflege mit PHP-Includes.</em>
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
                            <img src="/assets/img/projects/park-klinik/screen-brustvergroesserung-mit-eigenfett-park-klinik-birkenwerder.jpg"
                                alt="Screen: Unterseite – Brustvergrößerung mit Eigenfett"
                                class="img-fluid box-shadow mb-4" loading="lazy">
                            <figcaption class="text-muted small mt-2">
                                <?php if (is_en()): ?>
                                    Treatment page "Breast Augmentation with Autologous Fat"
                                <?php else: ?>
                                    Behandlungsseite "Brustvergrößerung mit Eigenfett"
                                <?php endif; ?>
                            </figcaption>
                        </article>

                        <article class="mt-4">
                            <h2 class="font-primary fs-20 text-uppercase mb-3"><strong>Highlights</strong></h2>
                            <ul class="mb-4">
                                <?php if (is_en()): ?>
                                    <li class="mb-2"><strong>Bootstrap 5 Frontend</strong> with modular PHP includes (header, navigation, footer, snippets)</li>
                                    <li class="mb-2"><strong>Multilingual (DE/EN)</strong> via <code>$language</code> switch, <code>hreflang</code> & canonical logic</li>
                                    <li class="mb-2"><strong>Performance</strong>: image compression, <code>srcset/picture</code>, preloads, critical CSS, lazy loading</li>
                                    <li class="mb-2"><strong>SEO</strong>: clean metadata, OG/Twitter cards, structured data (JSON-LD, MedicalOrganization)</li>
                                    <li class="mb-2"><strong>Media processing</strong>: image & video preps (YouTube/Vimeo embeds, thumbnails, WebP)</li>
                                    <li class="mb-2"><strong>UX</strong>: clear IA (face/breast/body/lipoedema), appointment CTAs, trust elements (eKomi)</li>
                                    <li class="mb-2"><strong>Compliance</strong>: cookie consent, GDPR assets, low barrier access</li>
                                <?php else: ?>
                                    <li class="mb-2"><strong>Bootstrap 5 Frontend</strong> mit modularen PHP-Includes (Header, Navigation, Footer, Snippets)</li>
                                    <li class="mb-2"><strong>Mehrsprachigkeit (DE/EN)</strong> via <code>$sprache</code>-Switch, <code>hreflang</code> & Canonical-Logik</li>
                                    <li class="mb-2"><strong>Performance</strong>: Bildkompression, <code>srcset/picture</code>, Preloads, kritisches CSS, Lazy-Loading</li>
                                    <li class="mb-2"><strong>SEO</strong>: saubere Metadaten, OG/Twitter Cards, strukturierte Daten (JSON-LD, MedicalOrganization)</li>
                                    <li class="mb-2"><strong>Medienbearbeitung</strong>: Bild- & Videopreps (YouTube/Vimeo-Embeds, Thumbnails, WebP)</li>
                                    <li class="mb-2"><strong>UX</strong>: klare IA (Gesicht/Brust/Körper/Lipödem), Termin-CTAs, Trust-Elemente (eKomi)</li>
                                    <li class="mb-2"><strong>Compliance</strong>: Cookie-Consent, DSGVO-Assets, Barrierearmut</li>
                                <?php endif; ?>
                            </ul>
                        </article>

                        <article class="mt-4">
                            <img src="/assets/img/projects/park-klinik/screen-startseite-mobile-park-klinik-birkenwerder.png" alt="Screen: Mobile Startseite" class="img-fluid mb-2" loading="lazy" width="300" height="600">
                            <figcaption class="text-muted small">
                                <?php if (is_en()): ?>
                                    Mobile view of the homepage
                                <?php else: ?>
                                    Mobile Ansicht der Startseite
                                <?php endif; ?>
                            </figcaption>
                        </article>

                    </div>

                    <aside class="col-12 col-md-4 order-2 pt-5 pt-md-0 pe-5">
                        <section class="pb-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>Info</strong></h2>
                            <p>
                                <?php if (is_en()): ?>
                                    Since 2017, I have been responsible for the comprehensive support of <em>Park-Klinik Birkenwerder</em>: UX conception, design, frontend & PHP integration, media processing, technical SEO as well as ongoing optimizations. The goal is a robust, fast website with clear patient guidance.
                                <?php else: ?>
                                    Für die <em>Park-Klinik Birkenwerder</em> übernehme ich seit 2017 die ganzheitliche Betreuung: UX-Konzeption, Design, Frontend & PHP-Integration, Medienaufbereitung, technische SEO sowie laufende Optimierungen. Ziel ist eine robuste, schnelle Website mit klarer Patient:innenführung.
                                <?php endif; ?>
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Tech-Stack</strong>
                            </h2>
                            <?php if (is_en()): ?>
                                <p>
                                    Bootstrap&nbsp;5, HTML5, CSS3, PHP, JavaScript, image & video processing, JSON-LD
                                </p>
                            <?php else: ?>
                                <p>
                                    Bootstrap&nbsp;5, HTML5, CSS3, PHP, JavaScript, Bild- &amp; Videobearbeitung, JSON-LD
                                </p>
                            <?php endif; ?>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Features</strong>
                            </h2>
                            <?php if (is_en()): ?>
                                <p>
                                    Preloads, OG/Twitter meta, structured data, cookie consent, YouTube/Vimeo embeds.
                                </p>
                            <?php else: ?>
                                <p>
                                    Preloads, OG/Twitter-Meta, strukturierte Daten, Cookie-Consent, YouTube/Vimeo-Embeds.
                                </p>
                            <?php endif; ?>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Services</strong>
                            </h2>
                            <?php if (is_en()): ?>
                                <p>
                                    UX conception & IA, responsive web design, frontend development, PHP includes, performance tuning, SEO setup, low-barrier access, image/video production, maintenance & ongoing development
                                </p>
                            <?php else: ?>
                                <p>
                                    UX-Konzeption & IA, Responsive Webdesign, Frontend-Entwicklung, PHP-Includes, Performance-Tuning, SEO-Setup, Barrierearmut, Bild/Video-Produktion, Wartung & Weiterentwicklung
                                </p>
                            <?php endif; ?>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase"><strong>URL</strong></h2>
                            <p>
                                <a href="https://www.park-klinik-birkenwerder.de/" rel="nofollow">park-klinik-birkenwerder.de</a>
                            </p>
                        </section>

                        <section class="py-3">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <?php if (is_en()): ?>
                                    <strong>Period</strong>
                                <?php else: ?>
                                    <strong>Zeitraum</strong>
                                <?php endif; ?>
                            </h2>
                            <p>
                                <?php if (is_en()): ?>
                                    2017 – present (ongoing)
                                <?php else: ?>
                                    2017 – heute (laufend)
                                <?php endif; ?>
                            </p>
                        </section>
                    </aside>

                </div>
            </div>
        </section>

    </main>

    <?php require $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>