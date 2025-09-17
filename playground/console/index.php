<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';

$meta = [
  'title' => 'WENG.EU - JavaScript Console',
  'desc'  => 'A simple JavaScript console for testing and debugging.',
  'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;

echo render_head($meta, $cspNonce);
?>

<body>
    <style>
        :root {
            --bg: #0f1220;
            --panel: #2a444c;
            --fg: #e6e8f0;
            --muted: #a6adbb;
            --accent: #777;
            --ok: #9ae6b4;
            --warn: #f6ad55;
            --err: #f87171;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.35);
            --radius: 14px;
            --console: #00ff00;
            --console-error: #ff3300;
        }
        [data-bs-theme="dark"] {
            --bg: #f6f8ff;
            --panel: #d9d9d9;
            --fg: #1a2233;
            --muted: #4b5563;
            --accent: #2a444c;
            --ok: #047857;
            --warn: #b45309;
            --err: #b91c1c;
            --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --console: #094b09;
            --console-error: #d72b00;
        }

        html,
        body {
            height: 100%;
        }
        body {
            margin: 0;
            /* background: radial-gradient(1200px 600px at 10% -10%, rgba(138, 180, 255, 0.12), transparent 60%),
                radial-gradient(1200px 600px at 110% 10%, rgba(138, 180, 255, 0.12), transparent 60%), var(--bg); 
            color: var(--fg);
            font: 16px/1.45 ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            */
        }

        .wrap {
            max-width: 960px;
            margin: 32px auto;
            padding: 0 16px;
        }

        .sub {
            color: var(--muted);
            margin-bottom: 16px;
        }

        .panel {
            background: var(--panel);
            border-radius: var(--radius);
            /* box-shadow: var(--shadow); */
            overflow: hidden;
        }

        .topbar {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px;
        }
        .topbar .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }
        .topbar .dot.red {
            background: #ff5f56;
        }
        .topbar .dot.yellow {
            background: #ffbd2e;
        }
        .topbar .dot.green {
            background: #27c93f;
        }
        .topbar .title {
            margin-left: 8px;
            color: var(--muted);
            font-size: 13px;
        }

        .output {
            color: var(--fg);
            height: 20vh;
            padding: 16px;
            overflow: auto;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        }

        .entry {
            display: grid;
            align-items: start;
            gap: 10px;
            padding: 6px 8px;
            border-radius: 10px;
        }
        .entry + .entry {
            margin-top: 6px;
        }
        .label {
            font-size: 12px;
            color: var(--muted);
            user-select: none;
            padding-top: 4px;
        }
        .payload {
            white-space: pre-wrap;
            word-break: break-word;
            font-size: 14px;
        }
        .payload code {
            font-family: inherit;
        }

        .entry.log .label {
            color: var(--fg);
        }
        .entry.info .label {
            color: var(--accent);
        }
        .entry.warn .label {
            color: var(--warn);
        }
        .entry.error .label {
            color: var(--err);
        }
        .entry.result .label {
            color: var(--ok);
        }
        .timestamp {
            color: var(--muted);
            font-size: 11px;
            margin-left: 8px;
        }

        .editor {
            padding: 12px;
            background: linear-gradient(0deg, rgba(0, 0, 0, 0.05), transparent);
        }
        .controls {
            display: flex;
            gap: 8px;
            align-items: center;
            margin-bottom: 8px;
        }

        .hint {
            color: var(--muted);
            font-size: 12px;
        }
        input {
            color: var(--fg);
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            transition: border-color 0.2s ease, background 0.2s ease;
        }
        textarea {
            color: var(--fg);
            width: 100%;
            height: 200px;
            resize: vertical;
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(0, 0, 0, 0.15);
            padding: 12px 12px 12px 14px;
            outline: none;
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
            transition: border-color 0.2s ease, background 0.2s ease;
        }
        textarea:focus {
            border-color: var(--accent);
            background: rgba(0, 0, 0, 0.22);
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 16px;
            color: var(--muted);
            font-size: 12px;
        }
        .kbd {
            font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Courier New", monospace;
            background: rgba(255, 255, 255, 0.08);
            padding: 2px 6px;
            border-radius: 6px;
            color: var(--fg);
        }

        code.console {
            color: var(--console);
        }

        code.console.error {
            color: var(--console-error);
        }
    </style>
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header_neu.php'; ?>

    <main class="page-wrapper" id="startMainContent">

    <!-- ### BREADCRUMB ### -->  
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

    <!-- ### STAGE ### -->    
    <section class="px-3 px-md-0 py-2 py-md-5">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-4">
                    <h1>
                        JavaScript <span class="font-accent">Console</span>
                    </h1>
                    <p class="fs-20 lh-1-5 my-3">
                        <em>Minimal in-page JS console with history, console.* hook, error handling & shortcuts.</em>
                    </p>
                </div>

                <div class="col-12 col-md-7 offset-md-1">

                    <div class="panel" aria-label="In-Page JavaScript Console">
                        <div class="topbar" aria-hidden="true">
                            <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
                            <span class="title">mini-console</span>
                        </div>
                        <div class="editor">
                            <textarea id="code" spellcheck="false" placeholder="// Paste JavaScript code here..."></textarea>
                            <div class="controls mt-3">
                                <button id="runBtn" class="btn btn-primary" title="Ausführen (Ctrl/⌘+Enter)">Ausführen</button>
                                <button id="clearBtn" class="btn btn-secondary" title="Ausgabe löschen">Löschen</button>

                                <!--button type="submit" class="btn btn-secondary d-inline-flex align-items-center gap-2 mt-2 mb-5 px-4 py-2">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Mitteilung senden
                                    <i class="fa-solid fa-arrow-right"></i>
                                </button-->


                                <span class="hint px-5">Shortcuts: <span class="kbd">Ctrl/⌘+Enter</span> ausführen, <span class="kbd">Shift+Enter</span> neue Zeile, <span class="kbd">↑/↓</span> Verlauf</span>
                            </div>
                        </div>
                    </div>
                    <div class="panel my-3" aria-label="In-Page JavaScript Console">
                        <div class="topbar" aria-hidden="true">
                            <span class="dot red"></span><span class="dot yellow"></span><span class="dot green"></span>
                            <span class="title">output</span>
                        </div>
                        <div id="output" class="output" role="log" aria-live="polite" aria-atomic="false"></div>
                        <div class="footer">
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <script>
        // === Utility formatting ===
        const escapeHTML = (s) => String(s).replace(/[&<>\"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\\':'\\'}[c]));

        function stringifyArg(arg) {
        const type = Object.prototype.toString.call(arg).slice(8, -1);
        if (arg === null) return 'null';
        if (type === 'Undefined') return 'undefined';
        if (['Number','Boolean','BigInt'].includes(type)) return String(arg);
        if (type === 'String') return arg;
        if (type === 'Function') return `[Function ${arg.name || 'anonymous'}]`;
        if (type === 'Symbol') return arg.toString();

        try {
            const seen = new WeakSet();
            return JSON.stringify(arg, (k, v) => {
            if (typeof v === 'object' && v !== null) {
                if (seen.has(v)) return '[Circular]';
                seen.add(v);
            }
            if (typeof v === 'function') return `[Function ${v.name || 'anonymous'}]`;
            if (typeof v === 'undefined') return '[undefined]';
            return v;
            }, 2);
        } catch (e) {
            return String(arg);
        }
        }

        const out = document.getElementById('output');

        function appendEntry(content) {
            const el = document.createElement('div');
            el.className = 'entry log';
            el.innerHTML = `<div class="payload">${content}</div>`;
            out.appendChild(el);
            out.scrollTop = out.scrollHeight;
        }

        function prune(max = 500) { // keep it snappy
        while (out.children.length > max) out.removeChild(out.firstChild);
        }

        // === Evaluation with console capture and top-level await support ===
        const AsyncFunction = Object.getPrototypeOf(async function(){}).constructor;

        async function evaluate(code) {
        const logs = [];
        const original = console;
        const proxyConsole = new Proxy(original, {
            get(target, prop) {
            if (['log','info','warn','error'].includes(prop)) {
                return (...args) => {
                logs.push({ type: prop, args });
                try { target[prop](...args); } catch {}
                };
            }
            return Reflect.get(target, prop);
            }
        });

        // 1) Normaler Programmlauf (Statements erlaubt)
        try {
            const fn = new AsyncFunction('console', 'window', 'document', '"use strict";\n' + code);
            const result = await fn(proxyConsole, window, document);
            if (result !== undefined) return { result, logs };

            // 2) Fallback: als Ausdruck interpretieren (wie DevTools)
            //    Wir wrappen in ein async IIFE und returnen dessen Wert.
            try {
            const exprFn = new AsyncFunction(
                'console', 'window', 'document',
                '"use strict";\nreturn (async () => ( ' + code + ' ))();'
            );
            const exprResult = await exprFn(proxyConsole, window, document);
            return { result: exprResult, logs };
            } catch {
            // Wenn auch das scheitert, behandeln wir es wie „kein Ausdruck“
            return { result: undefined, logs };
            }
        } catch (error) {
            return { error, logs };
        }
        }

        // === History ===
        const HISTORY_KEY = 'mini-console-history-v1';
        let history = JSON.parse(localStorage.getItem(HISTORY_KEY) || '[]');
        let histIndex = history.length; // points one past the end

        function pushHistory(cmd) {
        if (!cmd.trim()) return;
        if (history[history.length - 1] === cmd) return; // avoid dup consecutive
        history.push(cmd);
        if (history.length > 300) history.shift();
        histIndex = history.length;
        localStorage.setItem(HISTORY_KEY, JSON.stringify(history));
        }

        // === UI wiring ===
        const codeEl = document.getElementById('code');
        const runBtn = document.getElementById('runBtn');
        const clearBtn = document.getElementById('clearBtn');
        const dlBtn = document.getElementById('dlBtn');

        function setCode(value) {
        codeEl.value = value;
        // position caret at end
        requestAnimationFrame(() => { codeEl.selectionStart = codeEl.selectionEnd = codeEl.value.length; });
        }

        async function runCurrent() {
            const code = codeEl.value;
            if (!code.trim()) return;

            // Ausgabe vor jedem Run leeren
            out.replaceChildren();

            pushHistory(code);

            const { result, error, logs } = await evaluate(code);

            // Nur console.*-Logs ausgeben
            for (const l of logs) {
                const formatted = l.args
                .map(a => `<code class="console">${escapeHTML(stringifyArg(a))}</code>`)
                .join(' ');
                appendEntry(formatted);
            }

            // Fehler anzeigen
            if (error) {
                appendEntry(`<code class="console error">${escapeHTML(error && (error.stack || error.message || String(error)))}</code>`);
            }
        }

        runBtn.addEventListener('click', runCurrent);
        clearBtn.addEventListener('click', () => { out.innerHTML = ''; codeEl.focus(); });

        // Save-as-HTML (downloads the current page as a single file)
        dlBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const blob = new Blob([document.documentElement.outerHTML], { type: 'text/html' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'mini-js-console.html';
        document.body.appendChild(a);
        a.click();
        a.remove();
        URL.revokeObjectURL(url);
        });

        // Keyboard: Ctrl/Cmd+Enter to run, Shift+Enter newline, Tab to indent, Up/Down to browse history
        codeEl.addEventListener('keydown', (e) => {
        if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
            e.preventDefault();
            runCurrent();
            return;
        }
        if (e.key === 'Tab') {
            e.preventDefault();
            const { selectionStart: s, selectionEnd: epos, value } = codeEl;
            const insert = '  ';
            codeEl.value = value.slice(0, s) + insert + value.slice(epos);
            codeEl.selectionStart = codeEl.selectionEnd = s + insert.length;
            return;
        }
        if (e.key === 'ArrowUp') {
            // Only intercept at line start
            const atStart = codeEl.selectionStart === 0 && codeEl.selectionEnd === 0;
            if (atStart && history.length) {
            e.preventDefault();
            histIndex = Math.max(0, histIndex - 1);
            setCode(history[histIndex] || '');
            }
            return;
        }
        if (e.key === 'ArrowDown') {
            const atEnd = codeEl.selectionStart === codeEl.value.length && codeEl.selectionEnd === codeEl.value.length;
            if (atEnd && history.length) {
            e.preventDefault();
            histIndex = Math.min(history.length, histIndex + 1);
            setCode(history[histIndex] || '');
            }
            return;
        }
        });

        // Autofocus and welcome
        window.addEventListener('load', () => {
        codeEl.focus();
        // appendEntry('info', 'Welcome! Paste JavaScript code in the mini-console above.');
        });
    </script>
    
</main>

<?php
include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" );
?>