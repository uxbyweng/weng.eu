<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Projekt: Toma Multivision - Flash Website',
    'desc'  => 'Erstellung einer Flash Website. Konzeption, Screendesign, Animation, Programmierung.',
    'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
$isEn = is_en();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main class="page-wrapper project-layout" id="startMainContent">
        <div class="container">
            <div class="row">

                <div class="project-main col-12 col-md-8 order-1">

                    <!-- ### BREADCRUMB ### -->
                    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

                    <!-- ### STAGE ### -->
                    <section class="px-3 px-md-0 py-2 py-md-5">
                        <h1>
                            <span class="font-accent">Toma</span> Multivision<br>
                        </h1>
                        <p class="fs-20 lh-1-3 my-3">
                            <em>Weiterentwicklung und Pflege des Shop-Frontends – mit Fokus auf Usability, Performance und wartbarem Code in einem agilen, crossfunktionalen Team.</em>
                        </p>
                    </section>

                    <!-- ### CONTENT ### -->
                    <section class="px-3 px-md-0 py-3">
                        <!-- Video: Toma Multivision Intro -->
                        <figure class="mb-4">
                            <div class="ratio ratio-16x9">
                                <video
                                    class="rounded box-shadow"
                                    controls
                                    playsinline
                                    muted
                                    loop
                                    preload="metadata"
                                    poster="/assets/img/projects/toma/intro_toma_multivison_thumbnail.png"
                                    aria-label="<?php echo $isEn ? 'Toma Multivision — website intro video' : 'Toma Multivision — Website-Intro-Video'; ?>">
                                    <source src="/assets/video/intro_toma_multivision_website.mp4" type="video/mp4">
                                    <?php if ($isEn): ?>
                                        Your browser does not support HTML5 video.
                                        <a href="/assets/video/intro_toma_multivision_website.mp4">Download MP4</a>.
                                    <?php else: ?>
                                        Ihr Browser unterstützt kein HTML5-Video.
                                        <a href="/assets/video/intro_toma_multivision_website.mp4">MP4 herunterladen</a>.
                                    <?php endif; ?>
                                </video>
                            </div>
                            <figcaption class="mt-2 small text-muted">
                                <?php echo $isEn ? 'Screen recording of the original Flash intro (2005–2015), restored as MP4.' : 'Screenrecording des ursprünglichen Flash-Intros (2005–2015), als MP4 wiederhergestellt.'; ?>
                            </figcaption>
                        </figure>
                        <?php if (!empty($cspNonce)): ?>
                            <script nonce="<?php echo e($cspNonce); ?>">
                                (function() {
                                    try {
                                        var v = document.querySelector('video[playsinline]');
                                        if (!v) return;
                                        var prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                                        if (!prefersReduced) {
                                            // Autoplay nur, wenn sichtbar
                                            var io = new IntersectionObserver(function(entries) {
                                                entries.forEach(function(e) {
                                                    if (e.isIntersecting) v.play().catch(function() {});
                                                    else v.pause();
                                                });
                                            }, {
                                                threshold: 0.25
                                            });
                                            io.observe(v);
                                        } else {
                                            v.removeAttribute('autoplay');
                                        }
                                    } catch (e) {}
                                })();
                            </script>
                        <?php endif; ?>
                    </section>

                </div>

                <!-- ### SIDEBAR ### -->
                <aside class="project-sidebar col-12 col-md-7 order-2">
                    <!-- Deine Sidebar-Boxen (Info, Tech-Stack, Services, URL, Zeitraum) -->
                </aside>

            </div>
        </div>
    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>