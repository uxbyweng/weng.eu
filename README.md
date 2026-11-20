# weng.eu

A clean, fast, and accessible website designed to highlight my work, present selected projects, and providing a simple way to get in touch.

Live: [weng.eu](https://weng.eu/)  
Author: Karsten Weng · [LinkedIn](https://www.linkedin.com/in/kweng/)  
Last update: 20.11.2026

## Stack

-   Frontend: TypeScript (strict, ES modules, code splitting), plain CSS (no framework), no jQuery
-   Tooling: [Bun](https://bun.sh) (runtime, package manager, JS bundler), Lightning CSS (prefixes + minify), Biome (lint/format), `tsc` (typecheck)
-   Backend: PHP 8+ (router-based includes/partials), one PHP file per page, German at `/` and English at `/en/`
-   Quality: Lighthouse 100 in all categories (mobile LCP ≈ 1.4 s), WCAG 2.2 AA as target, strict CSP with nonce + Trusted Types
-   Deployment: GitHub Actions → SFTP (on every push to `main`)

## Quick start

```bash
bun install      # on Windows x64, if native tools fail to start: bun install --cpu=x64
bun run dev      # → http://localhost:3000
```

`bun run dev` (VS Code: `Shift + W`) is a single process that

1. starts the PHP dev server on `127.0.0.1:8000` (`router.php`, `WENG_DEV=1`),
2. watches `src/` and rebuilds TypeScript, CSS and images on every change,
3. runs a small proxy on `localhost:3000` that injects live reload:
    - `.css` → stylesheet is swapped without a page reload
    - `.ts` / `.php` / `src/img/**` → full reload

## Scripts

| Command             | What it does                                                  |
| ------------------- | ------------------------------------------------------------- |
| `bun run dev`       | PHP server + watcher + live reload (http://localhost:3000)    |
| `bun run build`     | Production build into `assets/dist/` (JS, CSS, images)        |
| `bun run images`    | Only the image pipeline (`src/img` → `assets/dist/img`)       |
| `bun run typecheck` | `tsc --noEmit` (strict)                                       |
| `bun run lint`      | Biome lint + format check                                     |
| `bun run format`    | Biome formatter                                               |
| `bun run check`     | typecheck + lint (what CI runs)                               |

## How assets reach the page

`bun run build` writes hashed files and a `manifest.json` to `assets/dist/` (git-ignored, built in CI).
PHP resolves the hashed URL through the `asset()` helper in `includes/helpers.php`:

```php
<link rel="stylesheet" href="<?= asset('main.css') ?>">
<script type="module" src="<?= asset('site.js') ?>"></script>
```

The critical CSS (`src/css/critical.css`) is minified into `assets/dist/critical.min.css` and inlined in the `<head>`.

### Images

Put **one original** (PNG, JPG or WebP) per image into `src/img/` (same subfolders as the page, e.g. `src/img/projects/lisa/screen-start.jpg`).
`bun run build` (`scripts/images.ts`, uses `Bun.Image`, no extra dependency) writes to `assets/dist/img/`:
`<name>.webp`, smaller widths as `<name>_<width>.webp`, a JPG/PNG fallback and `manifest.json`. Widths, maximum size and fallback are set per image
in the `RULES` list of `scripts/images.ts`. PHP builds the `<picture>` from the manifest with `img_picture('projects/lisa/screen-start', $alt, [...])`
(`includes/helpers.php`); the key is the path below `src/img/` without extension. Existing outputs are skipped unless the source or rule changed.
SVGs, favicons, logos, the video poster and other static files stay in `assets/img/` and are referenced directly.

Adding a new project page:

1. Save the screenshots as full-quality PNG/JPG in `src/img/projects/<project>/` (one file per image, no pre-scaling). Variants (600/700/900 px WebP + fallback) are generated automatically.
2. Copy an existing case study (e.g. `projekte/lisa/index.php`) to `projekte/<project>/index.php`; use `case_head()`, `case_slider()` and `img_picture('projects/<project>/<name>', $alt)` from `includes/case-study.php` / `includes/helpers.php`.
3. Add the teaser to `projekte/index.php` and `index.php` (`project_picture('<project>/<name>', $alt)`, key without `projects/`) and the texts to `includes/i18n/de/` and `en/`.
4. Run `bun run check`. A key missing in the manifest shows up as an HTML comment `Bild fehlt im Manifest: …`.

## Security and performance

-   `send_csp_header()` (`includes/helpers.php`, called by `render_head()`) sends a CSP with a per-request nonce, `require-trusted-types-for 'script'` and the policy `weng-html` (used in `contact-form.ts`). Don't add inline scripts without the nonce or `innerHTML` outside that policy.
-   `.htaccess`: HSTS (30 days, to be raised later), COOP `same-origin`, gzip/deflate.
-   Dark mode is controlled by `data-theme` on `<html>` (set by a tiny inline script, follows `prefers-color-scheme`).
-   Fonts are self-hosted (`assets/vendor/googlefonts/`), only the used weights are preloaded; the main stylesheet is deliberately **not** inlined (see `docs/20261120_PageSpeed-Insights_Startseite.md` for measurements and decisions).
-   Mobile menu: header is static on very low viewports (`max-height: 520px`) so it cannot cover the page at 400 % zoom.

## Deployment

`.github/workflows/deploy.yml`:

-   every push / pull request: `bun install --frozen-lockfile` → `bun run check` → `bun run build`
-   push to `main`: the built site (see `.deployignore`) is uploaded via SFTP with `lftp`. Nothing is deleted on the server except stale files in `assets/dist/`, so server-only files like `.env` stay untouched.
-   `assets/dist/img` is mirrored first and compared by file size only (otherwise every build would re-upload all images); its `manifest.json` is always uploaded.

Required in GitHub → Settings → Secrets and variables → Actions (repository secrets):

| Name                           | Type     | Example / note                                      |
| ------------------------------ | -------- | --------------------------------------------------- |
| `FTP_SERVER`                   | secret   | SFTP server host name                               |
| `FTP_USERNAME`                 | secret   | SFTP account name                                   |
| `FTP_PASSWORD`                 | secret   | SFTP password                                       |
| `SFTP_REMOTE_PATH` (optional)  | variable | target dir relative to the account root, default `/` |

## Project structure

```text
src/
├─ img/             # original images (PNG/JPG/WebP); variants are generated into assets/dist/img
├─ ts/              # TypeScript (site.ts = entry, modules/ = lazy-loaded features)
└─ css/             # plain CSS (main.css bundles the partials; critical.css is inlined in <head>)
scripts/
├─ build.ts         # production/dev build (Bun.build, Lightning CSS, manifest)
├─ images.ts        # image pipeline (src/img → assets/dist/img)
└─ dev.ts           # PHP server + watcher + live-reload proxy
assets/
├─ dist/            # build output (git-ignored)
├─ img/             # static images (SVG, icons, logos, video poster)
├─ vendor/          # local libraries (fonts)
└─ video/           # mp4 videos
includes/           # PHP partials
kontakt/            # contact form
projekte/           # projects
router.php          # routing for the PHP dev server
```

## Status

-   Nov 2026: tooling migrated to Bun + TypeScript (strict), jQuery removed, automatic deployment via GitHub Actions.
-   Nov 2026: relaunch live on plain CSS (Bootstrap/Sass removed), DE/EN by URL, case studies, structured data.
-   Nov 2026: build-time image pipeline (`src/img` → WebP variants + fallback), PageSpeed/a11y/security hardening (CSP, Trusted Types, HSTS).

## License

-   Code: MIT
-   Content/Design/Images: © Karsten Weng

## Contact

-   Karsten Weng · Berlin
-   karsten@weng.eu
-   LinkedIn: /in/kweng/
