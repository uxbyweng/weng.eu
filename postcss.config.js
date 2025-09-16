/**
 * PostCSS-Konfiguration
 *
 * PostCSS ist ein „Nachbearbeiter“ für CSS, das das Plugin **Autoprefixer** nutzt.
 * Es fügt automatisch Vendor-Prefixes (z. B. -webkit-, -ms-) für ältere Browser hinzu.
 *
 * Ablauf:
 *   1) Sass kompiliert SCSS → CSS (npm run build:sass / npm run dev)
 *   2) PostCSS läuft über erzeugte CSS (npm run build:css) und fügt Prefixes hinzu
 *
 * Unterstützte Browser: siehe „browserslist“ in der package.json (siehe unten).
 */

module.exports = {
    // Liste der PostCSS-Plugins, die auf CSS angewendet werden
    plugins: [
        require("autoprefixer"), // fügt fehlende Vendor-Prefixes automatisch ein
    ],
};
