# weng.eu — UX/UI Web Design Website

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
