<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';
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
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>

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
                                Websites that not only work, but impress.
                                Fast. Accessible. SEO-optimized. Responsive.
                                Developed with clean code and impactful design.
                            <?php else: ?>
                                Websites, die nicht nur funktionieren, sondern überzeugen.
                                Schnell. Barrierefrei. SEO-optimiert. Responsiv.
                                Entwickelt mit sauberem Code und Design mit Wirkung.
                            <?php endif; ?>
                            </em>
                        </p>
                        <div class="text-center text-md-start">
                            <a href="/kontakt/" class="btn btn-secondary d-inline-flex align-items-center gap-2 my-4 px-4 py-2">
                                <?php if (is_en()): ?>
                                Make contact
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

        <!-- ### PROJECTS ### -->
        <section class="px-3 px-md-0 py-5">
            <div class="container">
                <h2 class="font-nidorina mt-0 mb-4">
                    Latest Projects
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
                                <a href="/projekte/strato/">
                                    <h3>
                                        STRATO 
                                    </h3>
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
                                <a href="/projekte/lisa/">
                                    <h3 class="fs-24">
                                        Website Prof. Dr. Lisa Y. Haller 
                                    </h3>
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
                                <a href="/projekte/park-klinik/">
                                    <h3 class="fs-24">
                                        Website Park-Klinik Birkenwerder
                                    </h3>
                                </a>
                            </div>
                        </article>
                    </div>
                </div>
                <div class="text-center">
                    <a href="/projekte/" class="btn btn-secondary d-inline-flex align-items-center gap-2 m-4">
                        <?php if (is_en()): ?>
                            View all projects
                        <?php else: ?>
                            Alle Projekte ansehen
                        <?php endif; ?>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>

        <!-- ### SERVICES ### -->
        <section class="px-3 px-md-0 py-5">
            <div class="container">
                <h2 class="font-nidorina mt-0 mb-4">Services</h2>
                <ul class="service">
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>UX</h3>
                        </a>
                    </li>
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>UI</h3>
                        </a>
                    </li>
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>
                                <?php if (is_en()): ?>
                                    Web Design
                                <?php else: ?>
                                    Webdesign
                                <?php endif; ?>
                            </h3>
                        </a>
                    </li>
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>Web Development</h3>
                        </a>
                    </li>

                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>Accessebility</h3>
                        </a>
                    </li>
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>Performance</h3>
                        </a>
                    </li>
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>SEO</h3>
                        </a>
                    </li>
                    <li>
                        <a href="/service-details" style="cursor: none">
                            <h3>Photography</h3>
                        </a>
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
                            <p class="font-handwriting display-6 fw-light">
                                <?php if (is_en()): ?>
                                    “Good web development means communication on equal terms with solutions that work for people – not just in code.”
                                <?php else: ?>
                                    “Gute Webentwicklung bedeutet Kommunikation auf Augenhöhe mit Lösungen, die für Menschen funktionieren – nicht nur im Code.”
                                <?php endif; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );?>
