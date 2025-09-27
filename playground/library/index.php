<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';
$meta = [
  'title' => 'WENG.EU - Pattern Library',
  'desc'  => 'A collection of reusable UI components and design patterns.',
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
                        Pattern <span class="font-accent">Library</span> of UI components 
                    </h1>
                </div>

                <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                    <img src="/assets/img/library/undraw_design-components.svg" alt="Design Components" width="500" height="500" class="img-fluid">
                </div>

                <div class="col-12 col-md-7 order-3 order-md-2"> 
                    <p class="fs-20 lh-1-5 my-3">
                        <em>Consistent, reusable UI patterns addressing common design problems — reducing redundancy and ensuring scalable front-end development.</em>
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- ### TYPOGRAPHY ### -->
    <section class="px-3 px-md-0 py-2 py-md-5">
        <div class="container">
            <div class="row">
              <div class="col-lg-9">
                  <section class="py-5 border-bottom" id="section-typography">
                    <div class="container">
                      <h2 class="font-nidorina mt-0 mb-5">Typography</h2>
                      <div class="row g-4">
                        <div class="col-12">
                          <h1>H1 Quicksand | 48px</h1>
                        </div>
                        <div class="col-12">
                          <h2>H2 Quicksand | 38px</h2>
                        </div>
                        <div class="col-12">
                          <h3>H3 Quicksand | 32px</h3>
                        </div>
                        <div class="col-12">
                          <h4>H4 Quicksand | 25px</h4>
                        </div>
                        <div class="col-12">
                          <p><strong>P Noto Bold | 18px | 700</strong></p>
                        </div>
                        <div class="col-12">
                          <p>P Noto Regular | 18px | 400</p>
                        </div>
                      </div>
                    </div>
                  </section>

                  <!-- Buttons -->
                  <section class="py-5 border-bottom" id="section-buttons">
                    <div class="container">
                      <h2 class="font-nidorina mt-0 mb-5">Buttons</h2>
                      <div class="row g-4">
                        <div class="col-md-4">
                            <a href="/kontakt/" class="btn btn-secondary d-inline-flex align-items-center gap-2 px-4 py-2">
                              <?php if ($sprache === 'en'): ?>
                              Make contact
                              <?php else: ?>
                              Kontakt aufnehmen
                              <?php endif; ?>
                              <i class="fa-solid fa-arrow-right"></i>
                          </a>
                        </div>
                        <div class="col-md-4">
                            <a href="/projekte/" class="btn btn-secondary d-inline-flex align-items-center gap-2 px-4 py-2">
                              <?php if ($sprache === 'en'): ?>
                                  View all projects
                              <?php else: ?>
                                  Alle Projekte ansehen
                              <?php endif; ?>
                              <i class="fa-solid fa-arrow-right"></i>
                          </a>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-primary px-4 py-2"><?php if ($sprache === 'en'): ?>Send Message<?php else: ?>Nachricht senden<?php endif; ?></button>
                        </div>
                      </div>
                    </div>
                  </section>

                  <!-- Colors -->
                  <section class="py-5 border-bottom" id="section-colors">
                    <div class="container">
                      <h2 class="font-nidorina mt-0 mb-5">Colors</h2>
                      <div class="row g-4">
                        <div class="col-md-4">
                            <div class="bg-primary" style="width:100px; height:100px; background-color:#d72b00; border-radius:100px;"></div>
                             <p>
                              <strong>Primary</strong><br>
                              .bg-primary<br>
                               #d72b00
                              </p>
                        </div>
                        <div class="col-md-4">
                            <div class="bg-nidorina" style="width:100px; height:100px; border-radius:100px;"></div>
                            <p>
                              <strong>Secondary</strong><br>
                              .bg-nidorina<br>
                              #669999 - #22373f (gradient)
                              </p>
                        </div>
                        <div class="col-md-4">
                            <div class="body-color" style="width:100px; height:100px; border-radius:100px; border: 1px solid #888;"></div>
                             <p>
                              <strong>Font Color</strong><br>
                              .bg-body<br>
                               #333 (light mode)<br>
                               #eee (dark mode)
                              </p>
                        </div>
                        <div class="col-md-4">
                            <div class="body-color" style="width:100px; height:100px; border-radius:100px; border: 1px solid #888;"></div>
                             <p>
                              <strong>Font Color</strong><br>
                              .bg-body<br>
                               #333 (light mode)<br>
                               #eee (dark mode)
                              </p>
                        </div>
                      </div>
                    </div>
                  </section>

                  <!-- Icons -->
                  <section class="py-5 border-bottom" id="section-icons">
                    <div class="container">
                      <h2 class="nidorina mt-0 mb-4">Icons</h2>
                      <p><code>p</code> uses Noto | <code>font-size:</code> clamp(1rem, 1.5vw, 1.2rem)</p>
                      <p>Lorem ipsum dolor sit amet, <a href="#">dies ist ein Link</a> im Fließtext.</p>
                    </div>
                  </section>
                  
                  <!-- Links -->
                  <section class="py-5 border-bottom" id="section-links">
                    <div class="container">
                      <h2 class="nidorina mt-0 mb-4">Links</h2>
                      <p><code>p</code> uses Noto | <code>font-size:</code> clamp(1rem, 1.5vw, 1.2rem)</p>
                      <p>Lorem ipsum dolor sit amet, <a href="#">dies ist ein Link</a> im Fließtext.</p>
                    </div>
                  </section>

              </div>

              <!-- Side-Navi rechts -->
              <aside class="col-lg-3 d-none d-lg-block">
                <nav id="content-nav" class="sticky-sidebar">
                    <span class="content-nav-header d-block mb-3"><u>Seiteninhalt</u></span>
                    <ul class="nav flex-column small">
                        <li class="nav-item"><a class="nav-link" href="#section-typography">Typography</a></li>
                        <li class="nav-item"><a class="nav-link" href="#section-buttons">Buttons</a></li>
                        <li class="nav-item"><a class="nav-link" href="#section-colors">Colors</a></li>
                        <li class="nav-item"><a class="nav-link" href="#section-icons">Icons</a></li>
                        <li class="nav-item"><a class="nav-link" href="#section-links">Links</a></li>
                    </ul>
                </nav>
            </aside>

            </div>

        </div>
    </section>

  </main>

<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>
