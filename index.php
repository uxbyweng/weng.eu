<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => '',
    'desc'  => '',
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
                            UX/UI Web Design — <br>
                            <span class="font-accent">Built for People.</span>
                        </h1>
                    </div>
                    <div class="col-12 col-md-5 text-center position-relative order-2 order-md-3 p-4 mh-200 mt-150-md">
                        <div id="blob1" class="position-absolute"></div>
                        <div id="blob2" class="position-absolute"></div>
                        <img src="/assets/img/home/undraw_user-flow_d1ya.svg" alt="User Flow Illustration" width="500" height="254" fetchpriority="high" decoding="async" class="img-fluid" style="position:absolute; left:0rem;z-index:3;">
                    </div>
                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-5 my-3">
                            <em>
                                <?php if (is_en()): ?>
                                    Websites that not only work, but impress.<br class="br-desktop">
                                    Fast. Accessible. SEO-optimized. Responsive.<br class="br-desktop">
                                    Developed with clean code and impactful design.
                                <?php else: ?>
                                    Websites, die nicht nur funktionieren, sondern überzeugen.<br class="br-desktop">
                                    Schnell. Barrierefrei. SEO-optimiert. Responsiv.<br class="br-desktop">
                                    Entwickelt mit sauberem Code und wirkungsvollem Design.
                                <?php endif; ?>
                            </em>
                        </p>
                        <div class="text-center text-md-start">
                            <a href="/kontakt/" class="wng-btn d-inline-flex align-items-center gap-2 my-4 px-4 py-2">
                                <?php if (is_en()): ?>
                                    Say Hello
                                <?php else: ?>
                                    Sag Hallo
                                <?php endif; ?>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ### PROJECTS ### -->
        <section class="px-3 px-md-0 py-5">
            <div class="container">
                <h2 class="font-primary mt-0 mb-4">
                    <?php if (is_en()): ?>
                        Latest Projects
                    <?php else: ?>
                        Neueste Projekte
                    <?php endif; ?>
                </h2>
                <div class="row g-5">
                    <div class="col-lg-4">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/strato/">
                                    <picture>
                                        <source srcset="/assets/img/projects/strato/screen-startseite-strato-april-2024_xs.webp" type="image/webp">
                                        <img src="/assets/img/projects/strato/screen-startseite-strato-april-2024_xs.jpg" class="img-fluid screen-img" alt="Screen: Website STRATO" width="360" height="240" loading="lazy">
                                    </picture>
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/strato/" class="text-link fw-400">
                                    STRATO
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/lisa/">
                                    <picture>
                                        <source srcset="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller_xs.webp" type="image/webp">
                                        <img src="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller_xs.jpg" class="img-fluid screen-img" alt="Screen: Website Prof. Dr. Lisa Yashodhara Haller" width="360" height="240" loading="lazy">
                                    </picture>
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/lisa/" class="text-link fw-400">
                                    Prof. Dr. Lisa Y. Haller
                                </a>
                            </div>
                        </article>
                    </div>
                    <div class="col-lg-4">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/park-klinik/">
                                    <picture>
                                        <source srcset="/assets/img/projects/park-klinik/screen-startseite-park-klinik-birkenwerder_xs.webp" type="image/webp">
                                        <img src="/assets/img/projects/park-klinik/screen-startseite-park-klinik-birkenwerder_xs.jpg" class="img-fluid screen-img" alt="Screen: Website Park-Klinik Birkenwerder" width="360" height="240" loading="lazy">
                                    </picture>
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/park-klinik/" class="text-link fw-400">
                                    Park-Klinik Birkenwerder
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="text-center">
                    <a href="/projekte/" class="wng-btn d-inline-flex align-items-center gap-2 m-4">
                        <?php if (is_en()): ?>
                            View all projects
                        <?php else: ?>
                            Alle Projekte ansehen
                        <?php endif; ?>
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- ### SERVICES ### -->
        <section class="px-3 px-md-0 py-5">
            <div class="container">
                <h2 class="font-accent mt-0 mb-4">Services</h2>
                <ul class="service">
                    <li>
                        <h3>
                            UX/UI Web Design
                        </h3>
                        <p>
                            <?php if (is_en()): ?>
                                Designing thoughtful, responsive interfaces with a focus on usability, aesthetics, and brand identity.
                            <?php else: ?>
                                Gestaltung durchdachter, responsiver Interfaces mit Fokus auf Nutzerfreundlichkeit, Ästhetik und Markenidentität.
                            <?php endif; ?>
                        </p>
                    </li>
                    <li>
                        <h3>
                            <?php if (is_en()): ?>
                                Web Development
                            <?php else: ?>
                                Webentwicklung
                            <?php endif; ?>
                        </h3>
                        <p>
                            <?php if (is_en()): ?>
                                Clean, performant code for stable, accessible, and maintainable websites – from prototype to live project.
                            <?php else: ?>
                                Sauberer, performanter Code für stabile, barrierefreie und wartbare Websites – vom Prototyp bis zum Live-Projekt.
                            <?php endif; ?>
                        </p>
                    </li>
                    <li>
                        <h3>
                            <?php if (is_en()): ?>
                                Accessibility
                            <?php else: ?>
                                Barrierefreiheit
                            <?php endif; ?>
                        </h3>
                        <p>
                            <?php if (is_en()): ?>
                                Development according to WCAG standards for inclusive digital experiences, accessible to all user groups.
                            <?php else: ?>
                                Entwicklung nach WCAG-Standards für inklusive digitale Erlebnisse, zugänglich für alle Nutzergruppen.
                            <?php endif; ?>
                        </p>
                    </li>
                    <li>
                        <h3>
                            Performance
                        </h3>
                        <p>
                            <?php if (is_en()): ?>
                                Optimization of load times, code, and Core Web Vitals for a measurably better user experience.
                            <?php else: ?>
                                Optimierung von Ladezeiten, Code und Core Web Vitals für eine messbar bessere User Experience.
                            <?php endif; ?>
                        </p>
                    </li>
                    <li>
                        <h3>
                            SEO
                        </h3>
                        <p>
                            <?php if (is_en()): ?>
                                Technical and content-related search engine optimization for long-term visibility and reach.
                            <?php else: ?>
                                Technische und inhaltliche Suchmaschinenoptimierung für langfristige Sichtbarkeit und Reichweite.
                            <?php endif; ?>
                        </p>
                    </li>
                    <li>
                        <h3>
                            <?php if (is_en()): ?>
                                Photography
                            <?php else: ?>
                                Fotografie
                            <?php endif; ?>
                        </h3>
                        <p>
                            <?php if (is_en()): ?>
                                Authentic image concepts and photography that visually enhance projects and convey stories.
                            <?php else: ?>
                                Authentische Bildkonzepte und Fotografie, die Projekte visuell stärken und Geschichten transportieren.
                            <?php endif; ?>
                        </p>
                    </li>
                </ul>
            </div>
        </section>

        <!-- ### ABOUT ME ### -->
        <section class="about-me-section-wrapper">
            <div class="about-me-section">
                <div class="about-me-content container-xxl">
                    <div class="row justify-content-center text-white">
                        <div class="col-xl-10">
                            <p class="font-handwriting display-6 fw-light mt150">
                                <?php if (is_en()): ?>
                                    „Good web development means communication on equal terms with solutions that work for people – not just in code.“
                                <?php else: ?>
                                    „Gute Webentwicklung bedeutet Kommunikation auf Augenhöhe mit Lösungen, die für Menschen funktionieren – nicht nur im Code.“
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"); ?>