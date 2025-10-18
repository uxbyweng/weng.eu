# weng.eu

Lightweight website with focus on UX, accessibility, and performance.  
Design-first, mobile-first, clean code.

Live: [weng.eu](https://weng.eu/)  
Author: Karsten Weng · [LinkedIn](https://www.linkedin.com/in/kweng/)  
Last update: 17.09.2025

## Stack

-   Frontend: Bootstrap 5 (Sass), PostCSS, ES Modules
-   Tooling: Node 18+, Dart Sass, PostCSS CLI
-   Backend: PHP 8+ (includes/partials)
-   Deployment: SFTP, SSH keys

## Setup

```bash
# Dependencies
npm install

# Dev: Sass Watch + Sourcemaps
npm run dev

# Build: minified CSS + PostCSS
npm run build
```

## Lokaler PHP-Server (ohne BrowserSync)

Zum lokalen Entwickeln kann der eingebaute PHP-Server genutzt werden. Voraussetzung: PHP 8+ ist installiert.

```bash
# Im Projektstamm ausführen
php -S 127.0.0.1:8000 -t . router.php
```

-   Aufruf im Browser: http://127.0.0.1:8000
-   router.php sorgt dafür, dass „schöne“ URLs korrekt auf PHP-Dateien gemappt werden und statische Assets direkt ausgeliefert werden.
-   Optionaler DEV-Schalter: Einige Teile der Seite reagieren auf WENG_DEV=1 (z. B. Debug/kein Caching).

### Beispiel router.php

```php
<?php
// Statische Dateien direkt ausliefern
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

if ($path !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // von PHP-Server direkt liefern lassen
}

// Fallback: index.php oder angeforderte PHP-Seite
require __DIR__ . '/index.php';
```

### Optional: VS Code Task

Automatischer Start des PHP-Servers beim Öffnen des Ordners.

.vscode/settings.json

```json
{
    "task.allowAutomaticTasks": "on"
}
```

```json
{
    "version": "2.0.0",
    "tasks": [
        {
            "label": "php-dev-server",
            "type": "shell",
            "command": "php -S 127.0.0.1:8000 -t . router.php",
            "options": {
                "env": { "WENG_DEV": "1" }
            },
            "isBackground": true,
            "problemMatcher": {
                "background": {
                    "activeOnStart": true,
                    "beginsPattern": "^PHP \\d+\\.\\d+\\.\\d+ Development Server \\(.*\\) started",
                    "endsPattern": "^$never_matches_anything$"
                },
                "pattern": [{ "regexp": "^\\[(.*)\\] (.*):(\\d+): (.*)$", "file": 2, "line": 3, "message": 4 }]
            },
            "runOptions": { "runOn": "folderOpen" }
        }
    ]
}
```

## Structure (excerpt)

```text
assets/
├─ css/             # build output
├─ img/             # optimized images
├─ js/
│  └─ modules/      # ES modules
├─ scss/            # Bootstrap Sass + custom
└─ vendor/          # local libraries

includes/           # PHP partials

kontakt/            # contact form

projekte/           # projects

```

## License

-   Code: MIT
-   Content/Design/Images: © Karsten Weng

## Contact

-   Karsten Weng · Berlin
-   info@weng.eu
-   LinkedIn: /in/kweng/
