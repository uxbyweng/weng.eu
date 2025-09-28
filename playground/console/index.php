<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';
$meta = [
  'title' => 'WENG.EU - JavaScript Console',
  'desc'  => 'A simple JavaScript console for testing and debugging.',
  'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
$isEn = is_en();
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/default.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/languages/go.min.js"></script>
<script>hljs.highlightAll();</script>
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
                            JavaScript <span class="font-accent">Console</span>
                        </h1>
                        <p class="fs-20 lh-1-5 my-3">
                            <em>Minimal in-page JS console with history, console.* hook, error handling & shortcuts.</em>
                        </p>
                    </section>

                    <!-- ### CONSOLE INPUT ### -->
                    <section class="py-3">
                        <div class="panel" aria-label="In-Page JavaScript Console">
                            <div class="topbar" aria-hidden="true">
                                <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
                                <span class="title">mini-console</span>
                            </div> 
                            <div class="editor">
                                <textarea id="code" class="language-javascript" spellcheck="false" placeholder="// Paste JavaScript code here..."></textarea>
                                <div class="controls mt-3">
                                    <button id="runBtn" class="btn btn-primary" title="Ausführen (Ctrl/⌘+Enter)">Ausführen</button>
                                    <button id="clearBtn" class="btn btn-secondary" title="Ausgabe löschen">Löschen</button>
                                    <span class="hint px-5">Shortcuts: <span class="kbd">Ctrl/⌘+Enter</span> ausführen, <span class="kbd">Shift+Enter</span> neue Zeile, <span class="kbd">↑/↓</span> Verlauf</span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ### CONSOLE OUTPUT ### -->
                    <section class="py-3">
                        <div class="panel my-3" aria-label="In-Page JavaScript Console">
                            <div class="topbar" aria-hidden="true">
                                <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
                                <span class="title">output</span>
                            </div>
                            <div id="output" class="output" role="log" aria-live="polite" aria-atomic="false"></div>
                            <div class="footer">
                            </div>
                        </div>
                    </section>

                </article>

                <aside class="col-12 offset-md-1 col-md-2 order-2">

                    <?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/playground-navi.php" ); ?>

                </aside>   
    
            </div>
        </div>
     </main> 

    <?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" ); ?>

    <link rel="stylesheet" href="/playground/console/console.css">
    <script src="/playground/console/console.js" defer></script>