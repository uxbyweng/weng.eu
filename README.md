# weng.eu — UX/UI Web Design Portfolio

Schnelles, leichtgewichtiges Portfolio mit Fokus auf **UX**, **Accessibility** und **Performance**.  
Design-first, schlanker Code, mobile-first.

> Live: [weng.eu](https://weng.eu/)  
> Author: Karsten Weng · [LinkedIn](https://www.linkedin.com/in/kweng/)  
> Last Update: 15.09.2025

## Highlights

-   ⚡ **Performance-first**: kritisches CSS, Preload, Lazy-Loading
-   ♿ **Accessibility**: semantisches HTML, Skip-Link, ARIA, Kontrast
-   🌙 **Theme**: Light/Dark via `data-bs-theme`
-   🧩 **Modular**: Bootstrap 5 als Sass-Quellen + Custom-Layer
-   🧪 **Kontakt-Flow**: Client-Validation + Server-Checks (Honeypot, Timing)
-   🚀 **Zero-Framework** Frontend (jQuery nur fürs Formular)

## Tech-Stack

-   **Frontend**: Bootstrap 5 (Sass), PostCSS (Autoprefixer), ES Modules
-   **Tooling**: Node 18+, Dart Sass, PostCSS CLI
-   **Backend**: PHP 8+ (schlanke Includes/Partials)
-   **Deployment**: SFTP (VS Code), SSH-Keys

## Quickstart

```bash
# Abhängigkeiten
npm install

# Dev: Sass Watch + Sourcemaps
npm run dev

# Build: minified CSS + PostCSS
npm run build
```

## Projektstruktur (Auszug)

```text
assets/
├─ css/                       # generiertes CSS (Build-Output aus Sass)
├─ img/                       # optimierte Bilder
│  ├─ contact/
│  ├─ home/
│  ├─ icons/
│  ├─ library/
│  └─ logo/
├─ js/
│  ├─ modules/                # ES-Module (z. B. contact-form.*.js)
│  │  ├─ contact-form.de.js
│  │  └─ contact-form.en.js
│  ├─ site.de.js
│  └─ site.en.js
├─ scss/                      # Bootstrap-Sass + Custom (_custom.scss)
│  ├─ _custom.scss
│  └─ styles.scss
└─ vendor/                    # externe Libraries (lokal gehostet)
   ├─ bootstrap/
   ├─ googlefonts/
   └─ jquery/

includes/
├─ env.php                    # einfacher .env Loader
├─ footer.php                 # JS-Includes, Closing Tags
└─ header.php                 # SEO-Meta, Preloads, Theme-Handling

kontakt/
├─ index.php                  # Formular
├─ kontakt.de.php             # Handler (JSON, mail())
└─ kontakt.en.php             # (analog)

projekte/
index.php

```

## Kontaktformular (Privacy by Design)

-   Client: Live-Validierung, keine Links, min. 3 Wörter, UX-freundliche Fehler
-   Server: JSON only, Validierung gespiegelt, dynamischem Feldnamen, CSRF-Token
-   Konfiguration via .env (nicht im Repo)

```dotenv
MAIL_TO=info@weng.eu
MAIL_FROM=info@weng.eu
```

## Qualität

-   Accessibility: lang-Attribute, Skip-Link, ARIA, Fokus-Handling
-   Performance: Preloads, optimierte Bilder, minimiertes CSS
-   Sicherheit: keine Secrets im Repo, Honeypot, bereinigte Historie

## NPM-Skripte

```json
{
    "scripts": {
        "dev": "sass --load-path=node_modules --embed-source-map assets/scss/styles.scss assets/css/styles.css --watch",
        "build:sass": "sass --load-path=node_modules --style=compressed --quiet-deps assets/scss/styles.scss assets/css/styles.css",
        "build:css": "postcss assets/css/styles.css --replace --map",
        "build": "npm run build:sass && npm run build:css"
    }
}
```

## Lizenz & Rechte

-   Code: MIT
-   Content/Design/Bilder: © Karsten Weng — nicht zur Wiederverwendung

## Kontakt

-   Karsten Weng · Berlin
-   Mail: info@weng.eu
-   LinkedIn: /in/kweng/
