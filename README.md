# weng.eu

A clean, fast, and accessible website designed to highlight my work, present selected projects, and providing a simple way to get in touch.

Live: [weng.eu](https://weng.eu/)  
Author: Karsten Weng · [LinkedIn](https://www.linkedin.com/in/kweng/)  
Last update: 19.11.2025

## Stack

-   Frontend: Bootstrap 5 (Sass), PostCSS, ES Modules
-   Tooling: Node 22 (via NVM), Dart Sass, PostCSS CLI, BrowserSync
-   Backend: PHP 8+ (router-based includes/partials)
-   Deployment: SFTP, SSH keys

## Development Workflow

The project uses 3 parallel processes:

1. **PHP Development Server**  
   Used for page rendering and routing.
2. **Sass-Watcher (`npm run dev`)**  
   Automatically rebuilds CSS with every change.
3. **BrowserSync (`npm run serve`)**  
   Proxy for 127.0.0.1:8000 + automatic reload on changes to
    - `.scss` → generates new CSS
    - `.php` → Template changes
    - `.js` → Module changes

These three tasks are automatically started in parallel via VS Code.

## Keyboard shortcut: `Shift + W`

`Shift + W` launches the entire development environment at once:

-   PHP development server
-   Sass watcher
-   BrowserSync with automatic reload

## What happens behind the scenes

The shortcut runs the VS Code task `full-dev`, which starts the following processes in parallel:

-   `php-dev-server` – serves the site locally
-   `npm run dev` – compiles Sass and watches for changes
-   `npm run serve` – starts BrowserSync and reloads the browser when files change

BrowserSync automatically opens:

```cpp
http://localhost:3000
```

This proxys requests to:

```cpp
http://127.0.0.1:8000
```

Any change to PHP, SCSS, or JavaScript triggers an instant browser reload, so page updates appear immediately.

## Setup

```bash
# Install dependencies
npm install

# Dev: Sass Watch (normal, ohne BrowserSync)
npm run dev

# Build: minified CSS + PostCSS
npm run build

# BrowserSync für Auto-Reload
npm run serve
```

## BrowserSync proxy

```cpp
http://127.0.0.1:8000
```

under

```arduino
http://localhost:3000
```

→ This URL is crucial during the development process.

## Local PHP server

In case it's supposed to start without VS Code

```bash
# Execute in project master
php -S 127.0.0.1:8000 -t . router.php
```

→ router.php ensures that assets are delivered directly and all other requests are returned to index.php.

## VS Code Tasks

-   .vscode/tasks.json contains:
-   php-dev-server
-   npm-dev (Sass-Watcher)
-   npm-serve (BrowserSync)
-   full-dev (Starts everything simultaneously)

### Example (abbreviated):

```json
{
    "label": "full-dev",
    "dependsOn": ["php-dev-server", "npm-dev", "npm-serve"],
    "dependsOrder": "parallel"
}
```

### Keyboard shortcut

```json
[
    {
        "key": "shift+w",
        "command": "workbench.action.tasks.runTask",
        "args": "full-dev"
    }
]
```

## Project structure

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
router.php          # routing for PHP dev server
```

## Notes

-   Node is managed via nvm-windows
    Current version in the project: Node 22.21.1
-   Dev environment uses:
    -   sass --watch
    -   browser-sync --proxy
    -   PHP built-in server
-   Auto-reload works for:
    -   PHP
    -   SCSS → CSS
    -   JavaScript

## License

-   Code: MIT
-   Content/Design/Images: © Karsten Weng

## Contact

-   Karsten Weng · Berlin
-   karsten@weng.eu
-   LinkedIn: /in/kweng/
