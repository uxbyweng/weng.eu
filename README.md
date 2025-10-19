# weng.eu

My personal portfolio website — created to present my work, showcase selected projects, and offer an easy way to get in touch. The site is lightweight, accessible, and highly performant — built with a design-first, mobile-first, and clean-code philosophy.

Live: [weng.eu](https://weng.eu/)  
Author: Karsten Weng · [LinkedIn](https://www.linkedin.com/in/kweng/)  
Last update: 18.10.2025

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

## Local PHP server

Built-in PHP server that can be used for local development. Requires PHP 8+ installation.

```bash
# Im Projektstamm ausführen
php -S 127.0.0.1:8000 -t . router.php
```

-   Call in browser: http://127.0.0.1:8000
-   router.php ensures that “pretty” URLs are correctly mapped to PHP files and that static assets are delivered directly.

### Example router.php

```php
<?php
// Deliver static files directly
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$file = __DIR__ . $path;

if ($path !== '/' && file_exists($file) && !is_dir($file)) {
    return false; // deliver directly from PHP server
}

// Fallback: index.php or requested PHP page
require __DIR__ . '/index.php';
```

### Optional: VS Code Task

Automatically start the PHP server when the folder is opened.

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
├─ vendor/          # local libraries
└─ video/           # mp4 videos

includes/           # PHP partials

kontakt/            # contact form

projekte/           # projects

```

## License

-   Code: MIT
-   Content/Design/Images: © Karsten Weng

## Contact

-   Karsten Weng · Berlin
-   karsten@weng.eu
-   LinkedIn: /in/kweng/
