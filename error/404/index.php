<?php
require $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php'; 
$use_isotope = true;
require $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
?>

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
                            <span class="font-accent">Error 404</span>
                        <?php else: ?>
                            <span class="font-accent">Fehler 404</span>
                        <?php endif; ?>
                    </h1>
                </div>

                 <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                    <img src="/assets/img/privacy/undraw_personal-data_a1n8.svg" alt="Personal Data" width="500" height="500" class="img-fluid">
                </div>

                <div class="col-12 col-md-7 order-3 order-md-2"> 
                    <p class="fs-20 lh-1-5 my-3">
                        <?php if ($sprache === 'en'): ?>
                            <em>We respect your privacy. Below we inform you about which personal data we collect, for what purposes we process it, and what rights you have.</em>
                        <?php else: ?>
                            <em>Wir respektieren Ihre Privatsphäre. Im Folgenden informieren wir Sie darüber, welche personenbezogenen Daten wir erheben, zu welchen Zwecken wir diese verarbeiten und welche Rechte Ihnen zustehen.</em>
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