/**
 * Bild-Pipeline für weng.eu
 *
 *   Quellen:  src/img/**           Originale (PNG, JPG oder WebP), genau eine Datei pro Bild
 *   Ausgabe:  assets/dist/img/**   WebP in mehreren Breiten + Fallback (JPG oder PNG), dazu manifest.json
 *
 * Für ein Bild `projects/lisa/screen-start.jpg` entstehen (je nach Regel unten):
 *   screen-start.webp          volle Breite (höchstens `max`)
 *   screen-start_600.webp      kleinere Breiten aus `widths` (nur solche, die kleiner als die volle Breite sind)
 *   screen-start.jpg           Fallback für Browser ohne WebP (aus JPG: neu kodiert, aus PNG: unverändert kopiert)
 *
 * PHP liest dazu `manifest.json` (Breite, Höhe, Breiten, Fallback) und baut daraus <picture> (siehe includes/helpers.php: img_picture()).
 * Bereits erzeugte Bilder werden übersprungen, solange Quelle und Regel gleich geblieben sind (.cache.json).
 * Die Kodierung übernimmt Bun.Image, es ist keine zusätzliche Abhängigkeit nötig.
 */
import { createHash } from "node:crypto";
import { mkdir, readdir, rm } from "node:fs/promises";
import { dirname, extname, join, relative, sep } from "node:path";

const ROOT = join(import.meta.dir, "..");
const SRC = join(ROOT, "src", "img");
const OUT = join(ROOT, "assets", "dist", "img");

/** Ändert sich die Pipeline (Qualität, Namensschema), wird alles neu erzeugt. */
const PIPELINE_VERSION = 1;
const WEBP_QUALITY = 76;
const JPEG_QUALITY = 82;

interface Options {
    /** Zusätzliche Breiten in px (nur solche unter der vollen Breite werden erzeugt) */
    widths?: number[];
    /** Höchstbreite der WebP-Hauptdatei, z. B. doppelte Anzeigegröße bei Logos */
    max?: number;
    /** false = nur WebP (kein JPG/PNG-Fallback) */
    fallback?: boolean;
    /** true = Fallback immer als JPG (auch aus PNG-Quelle, z. B. große Screenshots ohne Transparenz) */
    jpg?: boolean;
}
interface Rule extends Options {
    /** Bildschlüssel = Pfad relativ zu src/img ohne Endung, z. B. "projects/lisa/screen-start" */
    match: RegExp;
}

/** Die erste passende Regel gilt. */
const RULES: Rule[] = [
    { match: /^home\/weng_at_work$/, widths: [480, 700], fallback: false },
    { match: /^home\/weng_profile_square$/, widths: [320, 480, 640], fallback: false },
    { match: /^home\/weng_profile$/, widths: [520], fallback: false },
    { match: /^contact\//, widths: [250] },
    // Kundenlogos: Anzeigegröße × 2, damit sie nicht größer geladen werden als nötig
    { match: /^clients\/pitayo$/, max: 160 },
    { match: /^clients\/hausarztpraxis-mengel$/, max: 308, fallback: false },
    { match: /^clients\/park-klinik$/, max: 330, fallback: false },
    { match: /^clients\//, fallback: true },
    { match: /^projects\/holzblaeser\/screen_holzblaeser_fassade_/, widths: [600, 700, 900, 1400], max: 2400, jpg: true },
    { match: /^projects\/holzblaeser\/screen_/, widths: [600, 700, 900], jpg: true },
    { match: /^projects\/effectiveinenglish\/screen_/, widths: [600, 700, 900], jpg: true },
    { match: /^projects\/mimivenezia\/screen_/, widths: [600, 700, 900], jpg: true },
    { match: /^projects\/pangolin-doxx\//, widths: [600, 700, 900], jpg: true },
    { match: /^projects\/berlin-street-view\/berlin-street-view-mobile/, max: 600 },
    { match: /^projects\//, widths: [600, 700, 900] },
];

export interface ImageEntry {
    /** Breite und Höhe der WebP-Hauptdatei */
    w: number;
    h: number;
    /** Breiten der zusätzlichen Varianten (<name>_<breite>.webp), aufsteigend */
    widths: number[];
    /** Endung des Fallbacks (jpg oder png), null = nur WebP */
    fallback: "jpg" | "png" | null;
}
export type ImageManifest = Record<string, ImageEntry>;

interface CacheEntry {
    hash: string;
    entry: ImageEntry;
    files: string[];
}
type Cache = Record<string, CacheEntry>;

const posix = (p: string) => p.split(sep).join("/");

async function listSources(dir = SRC): Promise<string[]> {
    const found: string[] = [];
    let names: import("node:fs").Dirent[] = [];
    try {
        names = await readdir(dir, { withFileTypes: true });
    } catch {
        return found; // src/img existiert noch nicht
    }
    for (const d of names) {
        const full = join(dir, d.name);
        if (d.isDirectory()) found.push(...(await listSources(full)));
        else if ([".png", ".jpg", ".jpeg", ".webp"].includes(extname(d.name).toLowerCase())) found.push(full);
    }
    return found;
}

async function listOutput(dir = OUT): Promise<string[]> {
    const found: string[] = [];
    let names: import("node:fs").Dirent[] = [];
    try {
        names = await readdir(dir, { withFileTypes: true });
    } catch {
        return found;
    }
    for (const d of names) {
        const full = join(dir, d.name);
        if (d.isDirectory()) found.push(...(await listOutput(full)));
        else found.push(posix(relative(OUT, full)));
    }
    return found;
}

async function processImage(file: string, key: string, rule: Options, hash: string): Promise<CacheEntry> {
    const bytes = await Bun.file(file).bytes();
    const meta = await new Bun.Image(bytes).metadata();
    const srcW = meta.width;
    const srcH = meta.height;
    const ext = extname(file).toLowerCase();

    const fullW = Math.min(srcW, rule.max ?? srcW);
    const fullH = Math.round((srcH * fullW) / srcW);
    const widths = [...new Set(rule.widths ?? [])].filter(w => w < fullW).sort((a, b) => a - b);

    const outBase = join(OUT, key);
    await mkdir(dirname(outBase), { recursive: true });
    const files: string[] = [];

    const writeWebp = async (w: number): Promise<void> => {
        const h = Math.round((srcH * w) / srcW);
        const img = new Bun.Image(bytes);
        const out = await (w === srcW ? img : img.resize(w, h)).webp({ quality: WEBP_QUALITY }).bytes();
        const name = w === fullW ? `${key}.webp` : `${key}_${w}.webp`;
        await Bun.write(join(OUT, name), out);
        files.push(name);
    };
    await Promise.all([fullW, ...widths].map(writeWebp));

    // Fallback: JPG neu kodiert (bei Bedarf verkleinert), PNG unverändert (z. B. Logos mit Transparenz)
    let fallback: ImageEntry["fallback"] = null;
    if (rule.fallback !== false && ext !== ".webp") {
        if (ext === ".png" && !rule.jpg) {
            await Bun.write(`${outBase}.png`, bytes);
            fallback = "png";
        } else {
            const img = new Bun.Image(bytes);
            const out = await (fullW === srcW ? img : img.resize(fullW, fullH)).jpeg({ quality: JPEG_QUALITY, progressive: true }).bytes();
            await Bun.write(`${outBase}.jpg`, out);
            fallback = "jpg";
        }
        files.push(`${key}.${fallback}`);
    }

    return { hash, entry: { w: fullW, h: fullH, widths, fallback }, files };
}

/** Erzeugt alle Bildvarianten (siehe Kopfkommentar) und schreibt assets/dist/img/manifest.json. */
export async function buildImages(): Promise<ImageManifest> {
    await mkdir(OUT, { recursive: true });

    let cache: Cache = {};
    try {
        cache = (await Bun.file(join(OUT, ".cache.json")).json()) as Cache;
    } catch {
        // erster Lauf
    }

    const sources = await listSources();
    const next: Cache = {};
    let done = 0;
    let skipped = 0;

    // Dateien nacheinander in kleinen Gruppen: Bun.Image nutzt ohnehin mehrere Kerne
    const queue = [...sources];
    const worker = async () => {
        for (let file = queue.shift(); file; file = queue.shift()) {
            const key = posix(relative(SRC, file)).replace(/\.[^.]+$/, "");
            const found = RULES.find(r => r.match.test(key));
            const rule: Options = { widths: found?.widths, max: found?.max, fallback: found?.fallback, jpg: found?.jpg };
            const bytes = await Bun.file(file).bytes();
            const hash = createHash("sha1")
                .update(bytes)
                .update(JSON.stringify({ v: PIPELINE_VERSION, rule }))
                .digest("hex");

            const cached = cache[key];
            if (
                cached &&
                cached.hash === hash &&
                (await Promise.all(cached.files.map(f => Bun.file(join(OUT, f)).exists()))).every(Boolean)
            ) {
                next[key] = cached;
                skipped++;
                continue;
            }
            next[key] = await processImage(file, key, rule, hash);
            done++;
        }
    };
    await Promise.all(Array.from({ length: 4 }, worker));

    // Doppelte Schlüssel (z. B. a.png und a.jpg) wären ein Fehler in der Quelle
    if (new Set(sources.map(f => posix(relative(SRC, f)).replace(/\.[^.]+$/, ""))).size !== sources.length) {
        throw new Error("src/img: Mehrere Dateien mit gleichem Namen (ohne Endung)");
    }

    // Verwaiste Ausgabedateien löschen
    const keep = new Set<string>(["manifest.json", ".cache.json"]);
    for (const c of Object.values(next)) for (const f of c.files) keep.add(f);
    for (const f of await listOutput()) if (!keep.has(f)) await rm(join(OUT, f), { force: true });

    const manifest: ImageManifest = {};
    for (const key of Object.keys(next).sort()) {
        const c = next[key];
        if (c) manifest[key] = c.entry;
    }
    await Bun.write(join(OUT, "manifest.json"), `${JSON.stringify(manifest, null, 1)}\n`);
    await Bun.write(join(OUT, ".cache.json"), JSON.stringify(next));
    console.log(`[images] ${done} neu, ${skipped} übersprungen, ${Object.keys(manifest).length} Bilder`);
    return manifest;
}

if (import.meta.main) {
    const start = performance.now();
    await buildImages();
    console.log(`Bilder fertig in ${Math.round(performance.now() - start)} ms`);
}
