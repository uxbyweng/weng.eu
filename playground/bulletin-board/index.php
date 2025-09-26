<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';
$meta = [
  'title' => 'WENG.EU - Bulletin Board',
  'desc'  => 'A simple bulletin board for sharing and discussing ideas.',
  'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
$isEn = is_en();

session_start();
if (empty($_SESSION['board_csrf'])) {
  $_SESSION['board_csrf'] = bin2hex(random_bytes(16));
}
$boardCsrf = $_SESSION['board_csrf'];
?>
<style>
    #board { display:block; width:100%; height:100%; touch-action:none; cursor:crosshair; }
    .board-box {
        width:min(900px,100%);
        aspect-ratio:4/3;
        border:1px solid rgba(255,255,255,.2);
        border-radius:12px;
        background:#fff;
        position:relative;
    }
    .board-box > canvas{
        position:absolute; inset:0;
        width:100%; height:100%;
        display:block;
        touch-action:none; cursor:crosshair;
    }
</style>
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
                        Bulletin <span class="font-accent">Board</span>
                    </h1>
                    <p class="fs-20 lh-1-5 my-3">
                        <em>Collaborative space for sharing ideas, feedback, and announcements.</em>
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="panel" aria-label="Boukketin Board">
                <div class="topbar" aria-hidden="true">
                    <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
                    <span class="title">Bulletin-Board</span>
                </div>
                <div class="editor p-3">
                    <div class="d-flex gap-2 align-items-center mb-2 flex-wrap">
                    <input type="color" id="penColor" value="#000000" class="form-control form-control-color">
                    <input type="range" id="penSize" min="1" max="36" value="4" class="form-range" style="width:140px">
                    <button id="undoBtn" class="btn btn-secondary">Undo</button>
                    <button id="clearBtn" class="btn btn-secondary">Clear</button>
                    <span class="hint ms-auto">Zeichne direkt auf die Fläche. Speichert automatisch.</span>
                    </div>
                    <!--div class="ratio ratio-4x3" style="max-width:900px; border:1px solid rgba(255,255,255,.2); border-radius:12px; background:#fff;">
                        <canvas id="board" aria-label="Schwarzes Brett" class="w-100 h-100"></canvas>
                    </div-->
                    <div class="board-box">
                        <canvas id="board" aria-label="Schwarzes Brett"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
   
    <script nonce="<?= e($cspNonce) ?>">
    window.BOARD_CFG = {
        csrf: "<?= e($boardCsrf) ?>",
        saveUrl: "/playground/boukketin-board/save.php",
        currentUrl: "/playground/boukketin-board/current.php"
    };
    </script>
    <script nonce="<?= e($cspNonce) ?>">
        (() => {
        const cvs = document.getElementById('board');
        const ctx = cvs.getContext('2d', { willReadFrequently: true });
        const wrapper = cvs.parentElement; // .board-box

        const colorEl = document.getElementById('penColor');
        const sizeEl  = document.getElementById('penSize');
        const undoBtn = document.getElementById('undoBtn');
        const clearBtn= document.getElementById('clearBtn');

        let cssW = 0, cssH = 0;

        function fitCanvasOnce() {
            const rect = wrapper.getBoundingClientRect();
            if (!rect.width || !rect.height) return false; // noch zu früh
            cssW = rect.width; cssH = rect.height;
            const dpr = Math.max(1, window.devicePixelRatio || 1);
            cvs.width  = Math.round(cssW * dpr);
            cvs.height = Math.round(cssH * dpr);
            ctx.setTransform(dpr,0,0,dpr,0,0);
            return true;
        }

        // Robust: Warte bis Maße > 0 (falls CSS/Fonts noch laden)
        function ensureSizedThen(cb){
            let tries = 0;
            function tick(){
            if (fitCanvasOnce() || tries > 60) { // ~1s
                cb(); return;
            }
            tries++; requestAnimationFrame(tick);
            }
            tick();
        }

        function fitCanvas(){ // bei echten Resizes
            if (fitCanvasOnce()) redraw();
        }

        // Zeichen-Stack
        let strokes = [];
        let current = null;
        let bgImg = new Image();
        let bgVersion = 0;

        function redraw() {
            // Hintergrund weiß (CSS-Pixel benutzen!)
            ctx.fillStyle = '#fff';
            ctx.fillRect(0, 0, cssW, cssH);

            // Server-Hintergrund
            if (bgImg.complete && bgImg.naturalWidth) {
            ctx.drawImage(bgImg, 0, 0, cssW, cssH);
            }
            // Strokes
            for (const s of strokes) drawStroke(s);
            if (current) drawStroke(current);
        }

        function drawStroke(s) {
            if (!s.points || s.points.length < 1) return;
            ctx.strokeStyle = s.color;
            ctx.lineWidth   = s.size;
            ctx.lineCap = 'round'; ctx.lineJoin = 'round';
            ctx.beginPath();
            ctx.moveTo(s.points[0].x, s.points[0].y);
            for (let i=1;i<s.points.length;i++) ctx.lineTo(s.points[i].x, s.points[i].y);
            ctx.stroke();
        }

        // Pointer-Handling
        let drawing = false;
        function pt(ev) {
            const r = cvs.getBoundingClientRect();
            const x = (ev.clientX ?? (ev.touches?.[0]?.clientX||0)) - r.left;
            const y = (ev.clientY ?? (ev.touches?.[0]?.clientY||0)) - r.top;
            return {x,y};
        }
        function start(ev) {
            ev.preventDefault();
            drawing = true;
            const p = pt(ev);
            current = { color: colorEl.value, size: parseInt(sizeEl.value,10) || 4, points:[p] };
            redraw();
        }
        function move(ev) {
            if (!drawing) return;
            const p = pt(ev);
            current.points.push(p);
            redraw();
            scheduleSave();
        }
        function end() {
            if (!drawing) return;
            drawing = false;
            if (current && current.points.length > 1) strokes.push(current);
            current = null;
            redraw();
            scheduleSave(true);
        }

        cvs.addEventListener('pointerdown', start);
        cvs.addEventListener('pointermove', move);
        window.addEventListener('pointerup', end);
        cvs.addEventListener('touchstart', start, {passive:false});
        cvs.addEventListener('touchmove',  move,  {passive:false});
        window.addEventListener('touchend', end);

        // Undo / Clear
        undoBtn.addEventListener('click', () => { strokes.pop(); redraw(); scheduleSave(true); });
        clearBtn.addEventListener('click', () => {
            if (!confirm('Wirklich alles löschen?')) return;
            strokes = []; redraw(); scheduleSave(true);
        });

        // Autosave
        let saveTimer = null, saving = false, lastSaveAt = 0;
        function scheduleSave(force=false) {
            if (saveTimer) clearTimeout(saveTimer);
            saveTimer = setTimeout(() => save(force), force ? 10 : 500);
        }
        async function save(force=false) {
            if (saving) return;
            if (!force && Date.now() - lastSaveAt < 800) return;
            saving = true;
            try {
            const blob = await new Promise(res => cvs.toBlob(res, 'image/png', 0.9));
            const fd = new FormData();
            fd.append('csrf', BOARD_CFG.csrf);
            fd.append('png', blob, 'board.png');
            const r = await fetch(BOARD_CFG.saveUrl, { method:'POST', body: fd, credentials:'same-origin' });
            if (!r.ok) throw new Error('Save failed: '+r.status);
            lastSaveAt = Date.now();
            refreshBackground(true);
            } catch(e) {
            console.error(e);
            } finally { saving = false; }
        }

        function refreshBackground(bump=false) {
            if (bump) bgVersion++;
            const url = BOARD_CFG.currentUrl + '?v=' + bgVersion;
            const img = new Image();
            img.onload = () => { bgImg = img; redraw(); };
            img.src = url;
        }

        // ► Reagiere auf Layoutänderungen des Wrappers (CSS lädt → Größe ändert sich)
        const ro = new ResizeObserver(() => fitCanvas());
        if (wrapper) ro.observe(wrapper);

        // Polling für Fremd-Updates
        setInterval(() => refreshBackground(true), 5000);

        // Init: sicherstellen, dass CSS geladen ist
        // 1) Beim Laden der Seite
        window.addEventListener('load', () => { fitCanvas(); refreshBackground(true); });
        // 2) Fallback direkt jetzt (falls CSS schon da ist)
        fitCanvas();
        })();
</script>

</main>


<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>