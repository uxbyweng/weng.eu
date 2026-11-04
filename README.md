# weng.eu

A clean, fast, and accessible website designed to highlight my work, present selected projects, and providing a simple way to get in touch.

Live: [weng.eu](https://weng.eu/)  
Author: Karsten Weng · [LinkedIn](https://www.linkedin.com/in/kweng/)  
Last update: 04.11.2026

## Stack

-   Frontend: TypeScript (strict, ES modules, code splitting), Bootstrap 5 (Sass), no jQuery
-   Tooling: [Bun](https://bun.sh) (runtime, package manager, JS bundler), Dart Sass, Lightning CSS (prefixes + minify), Biome (lint/format), `tsc` (typecheck)
-   Backend: PHP 8+ (router-based includes/partials)
-   Deployment: GitHub Actions → SFTP (on every push to `main`)

## Quick start

```bash
bun install      # on Windows x64, if native tools fail to start: bun install --cpu=x64
bun run dev      # → http://localhost:3000
```

`bun run dev` (VS Code: `Shift + W`) is a single process that

1. starts the PHP dev server on `127.0.0.1:8000` (`router.php`, `WENG_DEV=1`),
2. watches `src/` and rebuilds TypeScript and Sass on every change,
3. runs a small proxy on `localhost:3000` that injects live reload:
    - `.scss` → stylesheet is swapped without a page reload
    - `.ts` / `.php` → full reload

## Scripts

| Command             | What it does                                                  |
| ------------------- | ------------------------------------------------------------- |
| `bun run dev`       | PHP server + watcher + live reload (http://localhost:3000)    |
| `bun run build`     | Production build into `assets/dist/` (minified, hashed)       |
| `bun run typecheck` | `tsc --noEmit` (strict)                                       |
| `bun run lint`      | Biome lint + format check                                     |
| `bun run format`    | Biome formatter                                               |
| `bun run check`     | typecheck + lint (what CI runs)                               |

## How assets reach the page

`bun run build` writes hashed files and a `manifest.json` to `assets/dist/` (git-ignored, built in CI).
PHP resolves the hashed URL through the `asset()` helper in `includes/helpers.php`:

```php
<link rel="stylesheet" href="<?= asset('styles.css') ?>">
<script type="module" src="<?= asset('site.js') ?>"></script>
```

The critical CSS (`src/css/critical.css`) is minified into `assets/dist/critical.min.css` and inlined in the `<head>`.

## Deployment

`.github/workflows/deploy.yml`:

-   every push / pull request: `bun install --frozen-lockfile` → `bun run check` → `bun run build`
-   push to `main`: the built site (see `.deployignore`) is uploaded via SFTP with `lftp`. Nothing is deleted on the server except stale files in `assets/dist/`, so server-only files like `.env` stay untouched.

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
├─ ts/              # TypeScript (site.ts = entry, modules/ = lazy-loaded features)
├─ scss/            # Bootstrap Sass + custom styles
└─ css/             # critical.css (inlined in <head>)
scripts/
├─ build.ts         # production/dev build (Bun.build, Sass, Lightning CSS, manifest)
└─ dev.ts           # PHP server + watcher + live-reload proxy
assets/
├─ dist/            # build output (git-ignored)
├─ img/             # optimized images
├─ vendor/          # local libraries (fonts, Bootstrap CSS/icons)
└─ video/           # mp4 videos
includes/           # PHP partials
kontakt/            # contact form
projekte/           # projects
router.php          # routing for the PHP dev server
```

## Status

-   Nov 2026: tooling migrated to Bun + TypeScript (strict), jQuery removed, automatic deployment via GitHub Actions.
-   Next: relaunch (design handoff in `docs/`), then trimming the Bootstrap CSS to what is actually used.

## License

-   Code: MIT
-   Content/Design/Images: © Karsten Weng

## Contact

-   Karsten Weng · Berlin
-   karsten@weng.eu
-   LinkedIn: /in/kweng/
