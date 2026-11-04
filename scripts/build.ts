/**
 * Build für weng.eu
 *
 *   bun run build      → Produktions-Build (minifiziert, Hashes im Dateinamen)
 *   bun run dev        → ruft build({ dev: true }) bei jeder Änderung auf (siehe dev.ts)
 *
 * Ausgabe: assets/dist/
 *   site.<hash>.js, <chunk>-<hash>.js   TypeScript-Bundle (ESM, Code-Splitting)
 *   styles.<hash>.css                   Sass → Lightning CSS (Prefixes laut browserslist, Minify)
 *   critical.min.css                    wird von PHP inline ins <head> geschrieben
 *   manifest.json                       Logischer Name → gehashte URL (liest includes/helpers.php)
 */
import { createHash } from "node:crypto";
import { mkdir, readdir, rm } from "node:fs/promises";
import { basename, join } from "node:path";
import browserslist from "browserslist";
import { browserslistToTargets, transform } from "lightningcss";
import * as sass from "sass";
import pkg from "../package.json" with { type: "json" };

const ROOT = join(import.meta.dir, "..");
const DIST = join(ROOT, "assets", "dist");
const DIST_URL = "/assets/dist";

export type Manifest = Record<string, string>;

export interface BuildOptions {
    /** Dev-Modus: keine Minifizierung, Sourcemaps */
    dev?: boolean;
}

const targets = browserslistToTargets(browserslist(pkg.browserslist));

const shortHash = (content: string | Uint8Array) => createHash("sha256").update(content).digest("hex").slice(0, 8);

/** "contact-form-k3j2h1g0.js" → "contact-form.js" */
function logicalName(file: string): string {
    return file.replace(/[.-][a-z0-9]{8}(\.\w+)$/, "$1");
}

export async function buildJs({ dev = false }: BuildOptions = {}): Promise<Manifest> {
    const result = await Bun.build({
        entrypoints: [join(ROOT, "src/ts/site.ts")],
        outdir: DIST,
        target: "browser",
        format: "esm",
        splitting: true,
        minify: !dev,
        sourcemap: dev ? "linked" : "none",
        naming: { entry: "[name].[hash].[ext]", chunk: "[name]-[hash].[ext]", asset: "[name]-[hash].[ext]" },
    });
    if (!result.success) throw new Error(result.logs.map(String).join("\n"));

    const manifest: Manifest = {};
    for (const output of result.outputs) {
        if (output.kind === "sourcemap") continue;
        const file = basename(output.path);
        manifest[logicalName(file)] = `${DIST_URL}/${file}`;
    }
    return manifest;
}

export async function buildCss({ dev = false }: BuildOptions = {}): Promise<Manifest> {
    const compiled = sass.compile(join(ROOT, "src/scss/styles.scss"), {
        loadPaths: [join(ROOT, "node_modules")],
        quietDeps: true,
        sourceMap: dev,
        sourceMapIncludeSources: dev,
    });

    const processed = transform({
        filename: "styles.css",
        code: Buffer.from(compiled.css),
        minify: !dev,
        targets,
        sourceMap: dev,
        inputSourceMap: compiled.sourceMap ? JSON.stringify(compiled.sourceMap) : undefined,
    });

    let css = processed.code.toString();
    if (dev && processed.map) {
        css += `\n/*# sourceMappingURL=data:application/json;base64,${Buffer.from(processed.map).toString("base64")} */`;
    }

    const file = `styles.${shortHash(css)}.css`;
    await Bun.write(join(DIST, file), css);

    // Critical CSS: wird inline ins <head> geschrieben, braucht keinen Hash
    const critical = transform({
        filename: "critical.css",
        code: Buffer.from(await Bun.file(join(ROOT, "src/css/critical.css")).arrayBuffer()),
        minify: true,
        targets,
    });
    await Bun.write(join(DIST, "critical.min.css"), critical.code);

    return { "styles.css": `${DIST_URL}/${file}` };
}

/** Löscht Dateien aus assets/dist, die nicht (mehr) im Manifest stehen. */
async function prune(manifest: Manifest): Promise<void> {
    const keep = new Set(Object.values(manifest).map(url => basename(url)));
    keep.add("manifest.json");
    keep.add("critical.min.css");
    for (const file of await readdir(DIST)) {
        // Sourcemaps gehören zur jeweiligen JS-Datei
        if (!keep.has(file) && !keep.has(file.replace(/\.map$/, ""))) await rm(join(DIST, file), { force: true });
    }
}

export async function writeManifest(manifest: Manifest): Promise<void> {
    await Bun.write(join(DIST, "manifest.json"), `${JSON.stringify(manifest, null, 4)}\n`);
    await prune(manifest);
}

export async function build(options: BuildOptions = {}): Promise<Manifest> {
    await mkdir(DIST, { recursive: true });
    const [js, css] = await Promise.all([buildJs(options), buildCss(options)]);
    const manifest = { ...js, ...css };
    await writeManifest(manifest);
    return manifest;
}

if (import.meta.main) {
    const start = performance.now();
    try {
        const manifest = await build();
        console.log(`Build fertig in ${Math.round(performance.now() - start)} ms`);
        for (const [name, url] of Object.entries(manifest)) console.log(`  ${name.padEnd(24)} ${url}`);
    } catch (err) {
        console.error(err);
        process.exit(1);
    }
}
