<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';
    $meta = [
    'title' => 'WENG.EU - Creative Canvas',
    'desc'  => 'A simple canvas for sketching and sharing ideas.',
    'robots' => 'noindex, nofollow',
    ];

    $cspNonce = $_SERVER['CSP_NONCE'] ?? null;

    $docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
    $baseUrl = (( !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http')
            . '://' . ($_SERVER['HTTP_HOST'] ?? 'localhost');
    $dataDir = $docRoot . '/playground/canvas/data';

    // 1) gewünschte Version aus ?v=… (ohne .png) oder ?name=… (mit .png) lesen
    $want = $_GET['v'] ?? $_GET['name'] ?? '';
    $selectedFile = null;
    if ($want !== '') {
    // ohne .png erlauben
    if (!str_ends_with($want, '.png')) $want .= '.png';
    // validieren: YYYYMMDDHHMMSS[-slug][-N].png
    if (preg_match('/^\d{14}(?:-[a-z0-9_-]+)?(?:-\d+)?\.png$/', $want)) {
        $candidate = $dataDir . '/' . $want;
        if (is_file($candidate)) $selectedFile = $want;
    }
    }

    // 2) Fallback: latest.png
    if (!$selectedFile) {
    $selectedFile = is_file($dataDir.'/latest.png')
        ? 'latest.png'
        : null;
    }

    // 3) OG-Bild setzen (absolute URL + cache-bust)
    if ($selectedFile) {
    $fileFs = $dataDir . '/' . $selectedFile;
    $v = @filemtime($fileFs) ?: time();
    $meta['og_image'] = $baseUrl . '/playground/canvas/data/' . $selectedFile . '?v=' . $v;

    // og:url auf die teilbare URL mit ?v=… setzen (bei latest lassen wir Basis-URL)
    if ($selectedFile !== 'latest.png') {
        $meta['og_url'] = $baseUrl . '/playground/canvas/?v=' . rawurlencode(preg_replace('/\.png$/','',$selectedFile));
    } else {
        $meta['og_url'] = $baseUrl . '/playground/canvas/';
    }
    } else {
    // optionales Fallback
    $meta['og_image'] = $baseUrl . '/assets/img/logo/logo-light.svg';
    $meta['og_url']   = $baseUrl . '/playground/canvas/';
    }

    echo render_head($meta, $cspNonce);
    $isEn = is_en();

    // CSRF
    if (empty($_SESSION['canvas_csrf'])) {
    $_SESSION['canvas_csrf'] = bin2hex(random_bytes(16));
    }
    $canvasCsrf = $_SESSION['canvas_csrf'];
?>
    <body>

    <!-- ### NAVIGATION ### -->
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>

    <!-- ### BREADCRUMB ### -->  
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

    <main class="page-wrapper px-3 px-md-0" id="startMainContent">
        <div class="container">
            <div class="row">

                <article class="col-12 col-md-9 order-1">
                    
                    <!-- ### STAGE ### -->    
                    <section class="py-3">
                        <h1>
                            Creative <span class="font-accent">Canvas</span>
                        </h1>
                        <p>
                            <em>Sketch your ideas. Be creative.</em>
                        </p>
                    </section>

                    <!-- ### CANVAS BOX ### -->
                    <section class="py-3">
                        <div class="canvas-box">
                            <canvas id="canvas"
                                width="900" height="675"
                                data-save-url="/playground/canvas/save.php"
                                data-load-url="/playground/canvas/current.php"
                                data-initial-name="<?= isset($selectedFile) && $selectedFile && $selectedFile!=='latest.png' ? e($selectedFile) : '' ?>"
                                data-csrf="<?= e($canvasCsrf) ?>">
                            </canvas>
                        </div>
                    </section>

                    <!-- ### CANVAS ACTIONS ### -->
                    <section class="py-3">
                        <div class="canvas-actions">
                            <input type="text" id="bildname" class="wng-input--mobile-full"placeholder="Assign image name" aria-label="Assign image name">
                            <button id="clearBtn" class="wng-btn">Clear</button>
                            <a id="dlBtn" class="wng-btn" download="canvas.png">Download</a>
                            <button id="saveBtn" class="wng-btn">Save</button>
                            <button id="shareBtn" class="wng-btn">Copy</button>
                            <script>
                                document.getElementById('shareBtn')?.addEventListener('click', async () => {
                                const url = location.href; // enthält ?v=… dank pushState / direktem Aufruf
                                try { await navigator.clipboard.writeText(url); } catch {}
                                });
                            </script>
                            <p>                            
                                <small id="status" class="text-body-secondary ms-2"></small>
                            </p>
                        </div>
                    </section>

                    <!-- ### CANVAS VERSIONS ### -->
                    <section class="py-3">
                        <div class="canvas-versions mt-3">
                            <h3 class="fs-6 mb-2">Saved Versions</h3>
                            <ul id="versionList" class="pg-version-list"></ul>
                        </div>
                    </section>

                </article>

                <aside class="col-12 offset-md-1 col-md-2 order-2">

                    <?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/playground-navi.php" ); ?>

                </aside>   
    
            </div>
        </div>
     </main> 

    <?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );?>

    <link rel="stylesheet" href="/playground/canvas/canvas.css">
    <script src="/playground/canvas/canvas.js" defer></script>