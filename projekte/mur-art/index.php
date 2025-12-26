<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'mur.art',
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
                            <span class="font-accent">mur.art</span> — <br>
                            The Street Artist Quiz
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 order-2 order-md-3 pt-4 mt-150-md">
                        <img src="/assets/img/projects/mur-art/teaser-startseite-mur-art.jpg" alt="Teaser: mur.art - Quiz App" width="500" height="500" class="img-fluid box-shadow" loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <?php if (is_en()): ?>
                                <em>In Progress — Interactive quiz app about street art, developed as part of a JavaScript recap project.</em>
                            <?php else: ?>
                                <em>In Progress — Interaktive Quiz-App rund um Street Art, entwickelt im Rahmen eines JavaScript-Recap-Projekts.</em>
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php if (is_en()): ?>
                                mur.art is a mobile-first quiz app that playfully introduces users to street artists and their murals. The project started as a pure HTML/CSS layout and is currently being gradually expanded with interactive features using JavaScript. The focus is on clean DOM manipulation, understandable UI logic, and accessible interactions.
                            <?php else: ?>
                                mur.art ist eine mobile-first Quiz-App, die Nutzer:innen spielerisch an Street Artists und ihre Murals heranführt. Das Projekt startete als reines HTML/CSS-Layout und wird aktuell schrittweise um interaktive Funktionen mit JavaScript erweitert. Fokus: saubere DOM-Manipulation, verständliche UI-Logik und barrierearme Interaktionen.
                            <?php endif; ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <section class="px-3 px-md-0 py-3">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-7 order-1 pe-5">
                        <aricle>
                            <style>
                                .mur-art-embed {
                                    max-width: 430px;
                                    width: 100%;
                                    margin: 0 auto;
                                    aspect-ratio: 9 / 16; /* Mobile-App-Look */
                                    border-radius: 16px;
                                    overflow: hidden;
                                    box-shadow: 0 12px 30px rgba(0,0,0,.15);
                                }

                                .mur-art-embed iframe {
                                    width: 100%;
                                    height: 100%;
                                    border: 0;
                                }
                            </style>
                            <div class="mur-art-embed">
                                <iframe
                                    src="https://mur-art.de/"
                                    title="mur-art — The Street Artist Quiz"
                                    loading="lazy"
                                    allowfullscreen>
                                </iframe>
                            </div>
                        </aricle>
                    </div>

                    <aside class="col-12 col-md-5 order-2 pt-5 pt-md-0 pe-5">

                        <section class="pb-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Projekt Info</strong>
                            </h2>
                            <p>
                                <?php if (is_en()): ?>
                                    This project originated as part of a multi-part Bootcamp Recap project. While the first part focused on structure, layout, and responsive design, the second part centers on interactivity. The goal is to implement typical UI patterns of a quiz app entirely with vanilla JavaScript—without frameworks, but with clear logic and maintainable code.
                                <?php else: ?>
                                    Das Projekt entstand im Rahmen eines mehrteiligen Bootcamp-Recap-Projekts. Während im ersten Schritt der Fokus auf Struktur, Layout und responsivem Design lag, steht im zweiten Teil die Interaktivität im Mittelpunkt. Ziel ist es, typische UI-Patterns einer Quiz-App vollständig mit Vanilla JavaScript umzusetzen — ohne Frameworks, dafür mit klarer Logik und wartbarem Code.
                                <?php endif; ?>
                            </p>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Aktuell umgesetzt: </strong>
                            </h2>
                            <ul>
                                <li>Statische Quiz-Karten mit Frage, Antwort und Hashtag</li>
                                <li>Mobile-first Layout und klare visuelle Hierarchie</li>
                                <li>Wiederverwendbare Komponentenstruktur (BEM-orientiert)</li>
                                <li>Vorbereitung für interaktive Zustände (CSS-Klassen, States)</li>
                            </ul>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Geplante Features:</strong>
                            </h2>
                            <ul>
                                <li>Toggle-Funktionen</li>
                                <li>Bookmark-Seite</li>
                                <li>Add-Page (Formular)</li>
                                <li>Form-Validierung & UX</li>
                                <li>Profil-Seite</li>
                            </ul>
                        </section>

                        <section class="py-3 border-bottom">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Tech-Stack</strong>
                            </h2>
                            <ul>
                                <li style="list-style:none;"><strong>Frontend</strong></li>
                                <li>HTML5 (semantisch)</li>
                                <li>CSS3 (BEM-orientiert, responsive)</li>
                                <li>JavaScript (DOM, Events, State-Handling)</li>
                            </ul>
                            <ul>
                                <li style="list-style:none;"><strong>Workflow</strong></li>
                                <li>Git & GitHub</li>
                                <li>GitHub Actions (automatisches SFTP-Deployment)</li>
                                <li>STRATO Hosting</li>
                                <li>VS Code Tasks für lokale Entwicklung</li>
                            </ul>
                        </section>

                        <section class="py-3">
                            <h2 class="font-primary fs-20 text-uppercase">
                                <strong>Status & Links</strong>
                            </h2>
                            <ul>
                                <li>Status: In Progress</li>
                                <li>Live (in progress): <a href="http://mur-art.de/" target="_blank">mur-art.de</a></li>
                                <li>Code: <a href="https://github.com/uxbyweng/mur-art-quiz" target="_blank">GitHub Repository</a></li></li>
                                <li>Zeitraum: 11/2025-01/2026</li>
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