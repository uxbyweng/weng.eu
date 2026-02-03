<?php
function render_head(array $meta = [], ?string $cspNonce = null): string
{
    $lang = current_lang();
    $theme = $_COOKIE['theme'] ?? 'light';

    ob_start(); ?>
    <!DOCTYPE html>
    <html lang="<?= $lang === 'en' ? 'en' : 'de' ?>" data-bs-theme="<?= e($theme) ?>">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?= meta_tags($meta) ?>
        <script<?= $cspNonce ? ' nonce="' . e($cspNonce) . '"' : '' ?>>
            (function () {
            var stored=null; try{stored=localStorage.getItem('theme')}catch(e){}
            var prefersDark=window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            var theme=stored?stored:(prefersDark?'dark':'light');
            var de=document.documentElement;
            de.setAttribute('data-bs-theme', theme);
            de.style.backgroundColor = theme==='dark' ? '#212529' : '#f5f7f1';
            })();
            </script>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/canonical.php'; ?>
            <link rel="license" href="https://weng.eu/impressum/" type="text/html" title="Impressum" />
            <link rel="help" href="https://weng.eu/barrierefreiheit/" type="text/html" title="Hilfe" />
            <link rel="start" href="https://weng.eu/" type="text/html" title="Homepage" />
            <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icons/apple-touch-icon.png">
            <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icons/favicon-32x32.png">
            <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icons/favicon-16x16.png">
            <link rel="manifest" href="/assets/img/icons/site.webmanifest">
            <meta name="theme-color" content="#ffffff">
            <?= critical_css_inline($cspNonce) ?>
            <?php // Versions-Hash für Cache-Busting
            // (Datei-Änderungszeit oder Zeitstempel jetzt, falls Datei nicht
            $cssV   = @filemtime($_SERVER['DOCUMENT_ROOT'] . '/assets/css/styles.css') ?: time();
            $iconsV = @filemtime($_SERVER['DOCUMENT_ROOT'] . '/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css') ?: time();
            echo $iconSV;
            $siteJsName = '/assets/js/site.' . (is_en() ? 'en' : 'de') . '.js';
            $siteV  = @filemtime($_SERVER['DOCUMENT_ROOT'] . $siteJsName) ?: time();
            $cfJsName = '/assets/js/modules/contact-form.' . (is_en() ? 'en' : 'de') . '.js';
            $cfV   = @filemtime($_SERVER['DOCUMENT_ROOT'] . $cfJsName) ?: time();
            ?>
            <link rel="preload" href="/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css?v=<?= $iconsV ?>" as="style" onload="this.rel='stylesheet'">
            <noscript>
                <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css?v=<?= $iconsV ?>">
            </noscript>
            <link rel="stylesheet" href="/assets/css/styles.css?v=<?= $cssV ?>">
            <noscript>
                <link rel="stylesheet" href="/assets/css/styles.css?v=<?= $cssV ?>">
            </noscript>
            <link rel="preload" as="font" href="/assets/vendor/googlefonts/noto/NotoSans-Medium.woff2" type="font/woff2" crossorigin>
            <link rel="preload" as="font" href="/assets/vendor/googlefonts/quicksand/Quicksand-VariableFont_wght.woff2" type="font/woff2" crossorigin>
            <link rel="modulepreload" href="/assets/js/modules/theme-toggle.js">
            <link rel="modulepreload" href="/assets/js/modules/easy-language.js">
            <link rel="modulepreload" href="/assets/js/modules/lang-switcher.js">
            <link rel="modulepreload" href="/assets/js/modules/mobile-menu-autoclose.js">
            <?php if (preg_match('#^/kontakt/?$#', $_SERVER['REQUEST_URI'] ?? '')): ?>
                <link rel="modulepreload" href="<?= $cfJsName ?>?v=<?= $cfV ?>">
            <?php endif; ?>
            <link rel="modulepreload" href="<?= $siteJsName ?>?v=<?= $siteV ?>">
    </head>
<?php
    return (string)ob_get_clean();
}
