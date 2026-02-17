<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Projekte, Arbeiten & Experimente',
    'desc'  => 'Eine Auswahl an Projekten, Arbeiten und Konzepten, die ich umgesetzt habe – oder aktuell begleite.',
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
        <section class="px-3 px-md-0 py-2 py-md-5 ">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1>
                            <?php if ($sprache === 'en'): ?>
                                <span class="font-accent">Projects</span>, Works & Experiments
                            <?php else: ?>
                                <span class="font-accent">Projekte</span>, Arbeiten & Experimente
                            <?php endif; ?>
                        </h1>
                        <p class="fs-20 lh-1-5 my-3">
                            <?php if ($sprache === 'en'): ?>
                                <em> A selection of projects, works and concepts that I have implemented – or am currently involved in. </em>
                            <?php else: ?>
                                <em> Eine Auswahl an Projekten, Arbeiten und Konzepten, die ich umgesetzt habe – oder aktuell begleite. </em>
                            <?php endif; ?>
                        </p>
                    </div>
                    <div class="col-12 col-md-6">

                    </div>
                </div>
            </div>
        </section>

        <!-- ### WEB PROJEKTE ### -->
        <section class="px-3 px-md-0 py-5 border-bottom">
            <div class="container">
                <h2 class="font-primary mt-0 mb-4">
                    Websites
                </h2>
                <div class="row g-4">

                    <!-- Shopfrontend: STRATO -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/strato/">
                                    <img class="img-fluid" src="/assets/img/projects/strato/screen-startseite-strato-april-2024.jpg" alt="STRATO" loading="lazy">
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/strato/" class="text-link fw-400">
                                    STRATO
                                </a>
                            </div>
                        </article>
                    </div>

                    <!-- Website: Lisa Yasodhara Haller -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/lisa/">
                                    <img class="img-fluid screen-img" src="/assets/img/projects/lisa/screen-startseite-lisa-yashodhara-haller.jpg" alt="Prof. Dr. Lisa Yashodhara Haller" loading="lazy">
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/lisa/" class="text-link fw-400">
                                    Prof. Dr. Lisa Y. Haller
                                </a>
                            </div>
                        </article>
                    </div>

                    <!-- Website: Park-Klinik -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/park-klinik/">
                                    <img class="img-fluid" src="/assets/img/projects/park-klinik/screen-startseite-park-klinik-birkenwerder.jpg" alt="Park-Klinik Birkenwerder" loading="lazy">
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/park-klinik/" class="text-link fw-400">
                                    Park-Klinik Birkenwerder
                                </a>
                            </div>
                        </article>
                    </div>

                    <!-- Website: Pangolin-Doxx -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/pangolin-doxx/">
                                    <img class="img-fluid" src="/assets/img/projects/pangolin-doxx/screen-startseite-pangolin-doxx.jpg" alt="Pangolin-Doxx" loading="lazy">
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/pangolin-doxx/" class="text-link fw-400">
                                    Pangolin-Doxx
                                </a>
                            </div>
                        </article>
                    </div>

                </div>
            </div>
        </section>

        <!-- ### APPS ### -->
        <section class="px-3 px-md-0 py-5 border-bottom">
            <div class="container">
                <h2 class="font-primary mt-0 mb-4">
                    Apps
                </h2>
                <div class="row g-4">

                    <!-- Quiz-App -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/mur-art/">
                                    <picture>
                                        <source srcset="/assets/img/projects/mur-art/teaser-startseite-mur-art.webp" type="image/webp">
                                        <img src="/assets/img/projects/strato/teaser-startseite-mur-art.jpg" class="img-fluid screen-img" alt="Teaser: mur.art - Quiz App" width="360" height="240" loading="lazy">
                                    </picture>
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/mur-art/" class="text-link fw-400">
                                    mur-art - Quiz-App
                                </a>
                            </div>
                        </article>
                    </div>

                    <!-- HexaChrome App -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="#">
                                    <picture>
                                        <source srcset="/assets/img/projects/hexachrome/teaser-hexachrome.webp" type="image/webp">
                                        <img src="/assets/img/projects/strato/teaser-hexachrome.jpg" class="img-fluid screen-img" alt="Teaser: HexaChrome - Theme Creator App" width="360" height="240" loading="lazy">
                                    </picture>
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="#" class="text-link fw-400">
                                    HexaChrome - Theme Creator App
                                </a>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-4 website">
                        <article></article>
                    </div>

                    <div class="col-lg-4 website">
                        <article></article>
                    </div>

                </div>
            </div>
        </section>

        <!-- ### PRINT PROJEKTE ### -->
        <section class="px-3 px-md-0 py-5 border-bottom">
            <div class="container">
                <h2 class="font-primary mt-0 mb-4">
                    Print
                </h2>
                <div class="row g-4">

                    <!-- Campzeitung circuscamp 2018 -->
                    <div class="col-lg-4 website">
                        <article>
                            <div class="image-wrapper box-shadow">
                                <a href="/projekte/circus-schatzinsel/">
                                    <picture>
                                        <source srcset="/assets/img/projects/circus-schatzinsel/teaser-campzeitung-2018.jpg" type="image/webp">
                                        <img src="/assets/img/projects/circus-schatzinsel/teaser-campzeitung-2018.jpg" class="img-fluid screen-img" alt="<?php echo is_en() ? 'Teaser: Camp newspaper for the International Circus Camp 2018' : 'Teaser: Campzeitung für das Internationale Circuscamp 2018'; ?>" width="360" height="240" loading="lazy">
                                    </picture>
                                </a>
                            </div>
                            <div class="text-wrapper pt-2">
                                <a href="/projekte/circus-schatzinsel/" class="text-link fw-400">
                                    Campzeitung - Internationales Circuscamp 2018
                                </a>
                            </div>
                        </article>
                    </div>

                    <div class="col-lg-4 website">
                        <article></article>
                    </div>

                    <div class="col-lg-4 website">
                        <article></article>
                    </div>

                    <div class="col-lg-4 website">
                        <article></article>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>