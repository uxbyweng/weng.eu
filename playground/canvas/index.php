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
        <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>

        <main class="page-wrapper" id="startMainContent">

            <!-- ### BREADCRUMB ### -->  
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

            <!-- ### STAGE ### -->    
            <section class="px-3 px-md-0 py-2 pt-md-5 pt-mb-0">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-7 order-1">
                            <h1>
                                Creative <span class="font-accent">Canvas</span>
                            </h1>
                            <p>
                                <em>Sketch your ideas. Be creative.</em>
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ### CANVAS (minimal) ### -->
            <section class="px-3 px-md-0 py-5">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-md-10 order-1 pe-5">
                            <div class="canvas-box">
                                <canvas id="canvas"
                                    width="900" height="675"
                                    data-save-url="/playground/canvas/save.php"
                                    data-load-url="/playground/canvas/current.php"
                                    data-initial-name="<?= isset($selectedFile) && $selectedFile && $selectedFile!=='latest.png' ? e($selectedFile) : '' ?>"
                                    data-csrf="<?= e($canvasCsrf) ?>">
                                </canvas>
                            </div>
                            <div class="canvas-actions">
                                <button id="saveBtn" class="btn btn-secondary">Save</button>
                                <input type="text" id="bildname" placeholder="Image name (optional)" aria-label="Image name (optional)">
                                <button id="clearBtn" class="btn btn-secondary">Clear</button>
                                <a id="dlBtn" class="btn btn-secondary" download="canvas.png">Download PNG</a>
                                <button id="shareBtn" class="btn btn-secondary">Link kopieren</button>
                                <script>
                                document.getElementById('shareBtn')?.addEventListener('click', async () => {
                                const url = location.href; // enthält ?v=… dank pushState / direktem Aufruf
                                try { await navigator.clipboard.writeText(url); } catch {}
                                });
                                </script>
                                <small id="status" class="text-body-secondary ms-2"></small>
                            </div>
                            <div class="canvas-versions mt-3">
                                <h3 class="fs-6 mb-2">Saved Versions</h3>
                                <ul id="versionList" class="pg-version-list"></ul>
                            </div>
                        </div>
                        <aside class="col-12 col-md-2 order-2 pt-5 pt-md-0 pe-5">
                            <section class="pb-3 border-bottom">
                            <?php
                                $items = [
                                ['path' => '/playground/canvas/', 'de' => 'Canvas',       'en' => 'Canvas'],
                                ['path' => '/playground/console/',        'de' => 'JavaScript Konsole',   'en' => 'JavaScript Console'],
                                ['path' => '/playground/library/',        'de' => 'Pattern Library',      'en' => 'Pattern Library'],
                                ['path' => '/playground/tdd/',            'de' => 'TDD Sandbox',          'en' => 'TDD Sandbox'],
                                ];
                                $currentPath = rtrim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/', '/') . '/';
                                $en = is_en();
                            ?>
                            <nav class="pg-nav" aria-label="<?= $en ? 'Playground navigation' : 'Playground-Navigation' ?>">
                                <h2 class="fs-20 text-uppercase"><strong><?= $en ? 'Playground' : 'Playground' ?></strong></h2>
                                <ul class="pg-nav-list">
                                <?php foreach ($items as $it):
                                    $active = ($currentPath === $it['path']);
                                ?>
                                    <li>
                                    <a href="<?= e($it['path']) ?>"
                                        class="<?= $active ? 'active' : '' ?>"
                                        aria-current="<?= $active ? 'page' : 'false' ?>">
                                        <?= e($en ? $it['en'] : $it['de']) ?>
                                    </a>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            </nav>
                            </section>
                        </aside>

                    </div>
                </div>
            </section>

        </main>

        <?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );?>

        <link rel="stylesheet" href="/playground/canvas/canvas.css">
        <script src="/playground/canvas/canvas.js" defer></script>