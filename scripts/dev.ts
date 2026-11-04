/**
 * Dev-Umgebung für weng.eu – ersetzt PHP-Task + Sass-Watcher + BrowserSync durch einen Prozess.
 *
 *   bun run dev   →   http://localhost:3000
 *
 * Was passiert:
 *   1. PHP-Entwicklungsserver auf 127.0.0.1:8000 (router.php, WENG_DEV=1)
 *   2. Watcher baut bei Änderungen in src/ neu (TS → JS, SCSS → CSS)
 *   3. Proxy auf :3000 leitet an PHP weiter, fügt in HTML-Seiten das Live-Reload-Skript ein
 *      und schickt per Server-Sent-Events "reload" (JS/PHP) oder "css" (Stylesheet tauschen ohne Reload)
 */
import { type FSWatcher, watch } from "node:fs";
import { join, relative, sep } from "node:path";
import { buildCss, buildJs, type Manifest, writeManifest } from "./build";

const ROOT = join(import.meta.dir, "..");
const PHP_PORT = 8000;
const PROXY_PORT = 3000;
const PHP_ORIGIN = `http://127.0.0.1:${PHP_PORT}`;

// ---------------------------------------------------------------- Build
let manifest: Manifest = {};

async function rebuild(what: "js" | "css" | "all"): Promise<void> {
    const start = performance.now();
    try {
        if (what !== "css") manifest = { ...manifest, ...(await buildJs({ dev: true })) };
        if (what !== "js") manifest = { ...manifest, ...(await buildCss({ dev: true })) };
        await writeManifest(manifest);
        console.log(`[build] ${what} in ${Math.round(performance.now() - start)} ms`);
    } catch (err) {
        console.error(`[build] ${what} fehlgeschlagen:\n`, err);
        throw err;
    }
}

// ---------------------------------------------------------------- Live-Reload (SSE)
const clients = new Set<ReadableStreamDefaultController<string>>();

function broadcast(event: string, data = ""): void {
    for (const c of clients) c.enqueue(`event: ${event}\ndata: ${data}\n\n`);
}

// Die Live-Reload-Verbindung muss beim Verlassen der Seite geschlossen werden: Sonst bleiben nach einigen Seitenwechseln
// alle 6 Browser-Verbindungen zum Host belegt, und neue Seiten laden ~60 s nicht fertig (Schriften/Bilder warten).
const CLIENT_JS = `
const es = new EventSource("/__dev/events");
addEventListener("pagehide", () => es.close());
es.addEventListener("reload", () => location.reload());
es.addEventListener("css", e => {
    const urls = JSON.parse(e.data);
    for (const link of document.querySelectorAll('link[rel="stylesheet"]')) {
        const name = ["styles", "main"].find(n => link.href.includes("/assets/dist/" + n + "."));
        if (!name || !urls[name + ".css"]) continue;
        const next = link.cloneNode();
        next.href = urls[name + ".css"];
        next.onload = () => link.remove();
        link.after(next);
    }
});
`;

// ---------------------------------------------------------------- Proxy
const server = Bun.serve({
    port: PROXY_PORT,
    idleTimeout: 0,
    async fetch(req) {
        const url = new URL(req.url);

        if (url.pathname === "/__dev/client.js") {
            return new Response(CLIENT_JS, { headers: { "content-type": "text/javascript" } });
        }

        if (url.pathname === "/__dev/events") {
            let ctrl: ReadableStreamDefaultController<string>;
            const stream = new ReadableStream<string>({
                start(c) {
                    ctrl = c;
                    clients.add(c);
                    c.enqueue(": connected\n\n");
                },
                cancel() {
                    clients.delete(ctrl);
                },
            });
            return new Response(stream, {
                headers: { "content-type": "text/event-stream", "cache-control": "no-cache", connection: "keep-alive" },
            });
        }

        // Alles andere an PHP weiterreichen
        const headers = new Headers(req.headers);
        headers.delete("host");
        headers.set("accept-encoding", "identity");
        const upstream = await fetch(`${PHP_ORIGIN}${url.pathname}${url.search}`, {
            method: req.method,
            headers,
            body: req.method === "GET" || req.method === "HEAD" ? undefined : await req.arrayBuffer(),
            redirect: "manual",
        }).catch(() => null);

        if (!upstream) return new Response("PHP-Server nicht erreichbar (127.0.0.1:8000)", { status: 502 });

        const out = new Headers(upstream.headers);
        out.delete("content-length");
        out.delete("content-encoding");
        const location = out.get("location");
        if (location) out.set("location", location.replace(PHP_ORIGIN, url.origin));

        if (out.get("content-type")?.includes("text/html")) {
            const html = (await upstream.text()).replace("</body>", '<script src="/__dev/client.js"></script></body>');
            return new Response(html, { status: upstream.status, headers: out });
        }
        return new Response(upstream.body, { status: upstream.status, headers: out });
    },
});

// ---------------------------------------------------------------- PHP
// Erst nach erfolgreichem Start des Proxys, damit bei belegtem Port kein PHP-Prozess verwaist
const php = Bun.spawn(["php", "-S", `127.0.0.1:${PHP_PORT}`, "-t", ".", "router.php"], {
    cwd: ROOT,
    env: { ...process.env, WENG_DEV: "1" },
    stdout: "inherit",
    stderr: "inherit",
});

// ---------------------------------------------------------------- Watcher
const IGNORED = ["node_modules", ".git", `assets${sep}dist`, "docs", "test", "_psd", ".vscode"];

function debounce<A extends unknown[]>(fn: (...args: A) => void, ms: number) {
    let timer: ReturnType<typeof setTimeout> | undefined;
    return (...args: A) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), ms);
    };
}

const onChange = debounce(async (file: string) => {
    try {
        if (file.endsWith(".ts")) {
            await rebuild("js");
            broadcast("reload");
        } else if (file.endsWith(".scss") || (file.endsWith(".css") && file.startsWith(`src${sep}css${sep}`))) {
            await rebuild("css");
            // critical.css ist inline im HTML → braucht einen echten Reload, Stylesheets nicht
            if (file.endsWith("critical.css")) broadcast("reload");
            else broadcast("css", JSON.stringify(manifest));
        } else if (file.endsWith(".php")) {
            broadcast("reload");
        }
    } catch {
        // Fehler wurde in rebuild() geloggt; Dev-Server läuft weiter
    }
}, 80);

const watcher: FSWatcher = watch(ROOT, { recursive: true }, (_event, filename) => {
    if (!filename) return;
    const file = relative(ROOT, join(ROOT, filename));
    if (IGNORED.some(dir => file === dir || file.startsWith(dir + sep))) return;
    onChange(file);
});

// ---------------------------------------------------------------- Start / Stop
await rebuild("all").catch(() => {
    console.error("Erster Build fehlgeschlagen – Dev-Server läuft trotzdem, Datei speichern startet einen neuen Versuch.");
});
console.log(`\n  weng.eu dev  →  http://localhost:${server.port}   (PHP: ${PHP_ORIGIN})\n`);

function shutdown(): void {
    watcher.close();
    server.stop(true);
    php.kill();
    process.exit(0);
}
process.on("SIGINT", shutdown);
process.on("SIGTERM", shutdown);
