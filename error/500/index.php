<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';

$meta = [
  'title' => 'WENG.EU - Error 500 / Fehler 500',
  'desc'  => 'An internal server error occurred.',
  'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;

echo render_head($meta, $cspNonce);
?>

<body> 
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header_neu.php'; ?>

    <main class="page-wrapper" id="startMainContent">

    <!-- ### BREADCRUMB ### -->  
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

    <!-- ### STAGE ### -->    
    <section class="px-3 px-md-0 py-2 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h1>
                        <?php if ($sprache === 'en'): ?>
                            <span class="font-accent">Error 500</span>
                        <?php else: ?>
                            <span class="font-accent">Fehler 500</span>
                        <?php endif; ?>
                    </h1>
                </div>

                 <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                    <img src="/assets/img/privacy/undraw_personal-data_a1n8.svg" alt="Personal Data" width="500" height="500" class="img-fluid">
                </div>

                <div class="col-12 col-md-7 order-3 order-md-2"> 
                    <p class="fs-20 lh-1-5 my-3">
                        <?php if ($sprache === 'en'): ?>
                            <em>An internal server error occurred.</em>
                        <?php else: ?>
                            <em>Ein interner Serverfehler ist aufgetreten.</em>
                        <?php endif; ?>
                    </p>
                </div>

            </div>
        </div>
    </section>

</main>

<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>