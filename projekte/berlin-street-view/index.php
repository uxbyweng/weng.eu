<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

$meta = [
    'title' => 'Berlin Street View',
    'desc'  => 'Mobile-first Full-Stack-Webanwendung zur visuellen und standortbezogenen Erfassung von Street Art in Berlin.',
    'og_image' => '/assets/img/projects/berlin-street-view/teaser-berlin-street-view.jpg',
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
                            <span class="font-accent">Berlin Street View</span> — <br>
                            Explore Street Art in Berlin
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 order-2 order-md-3 pt-4 mt-150-md">
                        <img src="/assets/img/projects/berlin-street-view/teaser-berlin-street-view.jpg" alt="Teaser: Berlin Street View" width="500" height="500" class="img-fluid box-shadow" loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <?php if (is_en()): ?>
                                <em>A mobile-first full-stack web application for visually and location-based exploration of street art in Berlin, featuring map view, upload functionality, and role-based workflows.</em>
                            <?php else: ?>
                                <em>Eine mobile-first Full-Stack-Webanwendung für Street Art in Berlin mit Kartenansicht, Upload und rollenbasierten Workflows.</em>
                            <?php endif; ?>
                        </p>
                        <ul>
                            <?php if (is_en()): ?>
                                <li>Public overview and detail pages for artworks</li>
                                <li>Map view with location-based artwork markers</li>
                                <li>Role-based create, edit and delete workflows</li>
                                <li>Image upload with automatic EXIF GPS extraction</li>
                                <li>Protected routes and API access for authenticated users</li>
                            <?php else: ?>
                                <li>Interaktive Kartenansicht mit MapLibre</li>
                                <li>Automatische GPS-Erkennung aus EXIF-Daten</li>
                                <li>Full-Stack mit React, Next.js und MongoDB</li>
                                <li>Rollenbasierte CRUD-Workflows</li>
                                <li>Geschützte Routen und sicherer Login</li>
                            <?php endif; ?>
                        </ul>
                    </div>

                </div>
            </div>
        </section>

        <section class="px-3 px-md-0 py-3">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-7 order-1 pe-5">
                        <article>
                            <style>
                                .berlin-street-view-embed {
                                    max-width: 350px;
                                    width: 100%;
                                    margin: 0 auto;
                                    aspect-ratio: 1 / 2;
                                    overflow: hidden;
                                }
        .tech-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
            margin-top: 1.25rem;
        }

        .tech-tags span {
            padding: 0.25rem 0.65rem;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 999px;
            background: rgba(143, 184, 255, 0.15);
            color: #8fb8ff;
            white-space: nowrap;
        }

                            </style>

                            <div class="berlin-street-view-embed">
                                <a href="https://www.berlin-street-view.de/" target="_blank" rel="noopener noreferrer">
                                <img src="/assets/img/projects/berlin-street-view/berlin-street-view-mobile-map-view.png" alt="Teaser: Berlin Street View" width="350" height="694" class="img-fluid box-shadow" loading="lazy">
                                </a>
                            </div>
                        </article>
                    </div>

                    <aside class="col-12 col-md-5 order-2 pt-5 pt-md-0 pe-5">

                        <section class="pb-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <?php if (is_en()): ?>
                                    <strong>Project Context</strong>
                                <?php else: ?>
                                <strong>Projektkontext</strong>
                                <?php endif; ?>
                            </h2>
                            <p>
                                <?php if (is_en()): ?>
                                    Mobile-first full-stack web application focused on responsive UI, role-based workflows and maintainable frontend architecture. Centered around location-based content, clear user guidance and clean extensibility.
                                <?php else: ?>
                                    Mobile-first Full-Stack-Webanwendung mit Fokus auf responsive UI, rollenbasierte Workflows und wartbare Frontend-Architektur. Im Zentrum stehen standortbezogene Inhalte, klare Nutzerführung und saubere Erweiterbarkeit.
                                <?php endif; ?>
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <?php if (is_en()): ?>
                                <strong>Features</strong>
                                <?php else: ?>
                                <strong>Funktionen</strong>
                                <?php endif; ?>
                            </h2>
                            <ul>
                                <?php if (is_en()): ?>
                                    <li>Interactive 3D map (MapLibre)</li> 
                                    <li>Role-based CRUD Workflow</li> 
                                    <li>Image upload with GPS reading via EXIF</li> 
                                    <li>Smart geo-tagging (EXIF)</li> 
                                    <li>Single Sign-On (OAuth)</li>
                                <?php else: ?>  
                                    <li>Interaktive 3D-Map (MapLibre)</li>
                                    <li>Rollenbasierter CRUD Workflow</li>
                                    <li>Bild-Upload mit GPS Auslesung via EXIF</li>
                                    <li>Smartes Geo-Tagging (EXIF)</li>
                                    <li>Single-Sign-On (OAuth)</li>
                                <?php endif; ?>
                            </ul>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <?php if (is_en()): ?>
                                    <strong>Technical Focus</strong>
                                <?php else: ?>
                                <strong>Technischer Fokus</strong>
                                <?php endif; ?>
                            </h2>
                            
                            <ul>
                                <?php if (is_en()): ?>
                                    <li>Mobile-first and responsive UI development</li>
                                    <li>Clear separation of frontend, data access and application logic</li>
                                    <li>Role-based access control for protected areas</li>
                                    <li>Maintainable component structure and clear user guidance</li>
                                    <li>Foundation for robust and accessible interfaces</li>
                                <?php else: ?>
                                    <li>Responsive mobile-first UI-Entwicklung</li>
                                    <li>Saubere Trennung von UI, Datenzugriff und Logik</li>
                                    <li>Rollenbasierte Zugriffskontrolle</li>
                                    <li>Wartbare Komponentenstruktur</li>
                                    <li>Barrierefrei</li>
                                <?php endif; ?>
                            </ul>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <?php if (is_en()): ?>
                                    <strong>Scalable Full-Stack</strong>
                                <?php else: ?>
                                <strong>Skalierbarer Full-Stack</strong>
                                <?php endif; ?>
                            </h2>
                            <div class="tech-tags">
                                <span>React</span>
                                <span>Next.js</span>
                                <span>MongoDB</span>
                                <span>MapLibre GL</span>
                                <span>NextAuth</span>
                                <span>Cloudinary</span>
                                <span>Vercel</span>
                            </div>
                        </section>

                        <section class="py-3">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Links</strong>
                            </h2>
                            <ul>
                                <li>Live: <a href="https://www.berlin-street-view.de/" target="_blank" rel="noopener noreferrer">berlin-street-view.de</a></li>
                                <li>Code: <a href="https://github.com/uxbyweng/berlin-street-view" target="_blank" rel="noopener noreferrer">GitHub Repository</a></li>
                                <li>
                                    <?php if (is_en()): ?>
                                        Timeframe: since 03/2026
                                    <?php else: ?>
                                    Zeitraum: seit 03/2026
                                    <?php endif; ?>

                                </li>
                            </ul>
                        </section>

                    </aside>

                </div>
            </div>
        </section>

    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>
</body>