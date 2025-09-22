<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';
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
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>

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

    <!-- ### PROJEKTE ### --> 
    <section class="px-3 px-md-0 py-5 border-bottom">
        <div class="container">
            <h2 class="font-nidorina mt-0 mb-4">
                <?php if (is_en()): ?>
                    Web Projects
                <?php else: ?>
                    Web Projekte
                <?php endif; ?>
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
                            <a href="/projekte/strato/">
                                <p>
                                    Shopfrontend
                                </p>
                                <h3>
                                    STRATO 
                                </h3>
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
                            <a href="/projekte/lisa/">
                                <p>
                                    Website 
                                </p>
                                <h3>
                                    Prof. Dr. Lisa Yashodhara Haller 
                                </h3>
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
                            <a href="/projekte/park-klinik/">
                                <p>
                                    Website
                                </p>
                                <h3>
                                    Park-Klinik Birkenwerder
                                </h3>
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
                            <a href="/projekte/pangolin-doxx/">
                                <p>
                                    Website
                                </p>
                                <h3>
                                    Pangolin-Doxx
                                </h3>
                            </a>
                        </div>
                    </article>
                </div>
                
            </div>
        </div> 
    </section>

</main>

<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>