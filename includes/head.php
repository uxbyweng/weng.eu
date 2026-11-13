<?php
/**
 * render_head($meta, $cspNonce)
 * Gibt <!DOCTYPE html>, <html> und <head> zurück. Die Seite schreibt danach <body> selbst.
 *
 * $meta (alles optional): title, desc, og_image, og_type, robots,
 *   trail  (Brotkrumenpfad, sonst aus der URL abgeleitet),
 *   jsonld (weitere schema.org-Blöcke als Arrays)
 */
function render_head(array $meta = [], ?string $cspNonce = null): string
{
    $lang = current_lang();
    $theme = 'light'; // Das Inline-Skript unten setzt den Modus aus localStorage bzw. der Systemeinstellung (es gibt kein Theme-Cookie)
    $nonce = $cspNonce ? ' nonce="' . e($cspNonce) . '"' : '';

    // schema.org: Startseite = Person, Unterseiten = BreadcrumbList
    $jsonld = $meta['jsonld'] ?? [];
    if (current_path() === '/') {
        $jsonld[] = person_json_ld();
    } else {
        if (isset($meta['trail'])) breadcrumb_trail($meta['trail']);
        $jsonld[] = breadcrumb_json_ld(breadcrumb_trail());
    }

    // Icon-Schrift der Altseiten: Versions-Hash für Cache-Busting (Vendor-Datei, nicht vom Build gehasht)
    $iconsV = @filemtime($_SERVER['DOCUMENT_ROOT'] . '/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css') ?: time();

    ob_start(); ?>
<!DOCTYPE html>
<html lang="<?= $lang === 'en' ? 'en' : 'de' ?>" data-bs-theme="<?= e($theme) ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= meta_tags($meta) ?>

    <script<?= $nonce ?>>
        // Theme vor dem ersten Rendern setzen (verhindert Aufblitzen)
        (function () {
            var stored = null;
            try { stored = localStorage.getItem('theme'); } catch (e) {}
            var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            var theme = stored ? stored : (prefersDark ? 'dark' : 'light');
            var de = document.documentElement;
            de.setAttribute('data-bs-theme', theme);
            de.style.backgroundColor = theme === 'dark' ? '#212529' : '#ffffff';
        })();
    </script>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/canonical.php'; ?>
    <link rel="alternate" hreflang="de" href="<?= e(abs_url(lang_url('de'))) ?>">
    <link rel="alternate" hreflang="en" href="<?= e(abs_url(lang_url('en'))) ?>">
    <link rel="alternate" hreflang="x-default" href="<?= e(abs_url(lang_url('de'))) ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icons/favicon-16x16.png">
    <link rel="manifest" href="/assets/img/icons/site.webmanifest">
    <meta name="theme-color" content="#ffffff">
    <?= critical_css_inline($cspNonce) ?>

    <?php /* Altseiten (Bootstrap): styles.css + Icon-Schrift. Entfällt, sobald alle Seiten im neuen Design sind. */ ?>
    <link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css?v=<?= $iconsV ?>">
    <link rel="stylesheet" href="<?= asset('styles.css') ?>">
    <?php /* Neues Design */ ?>
    <link rel="stylesheet" href="<?= asset('main.css') ?>">

    <link rel="preload" as="font" href="/assets/vendor/googlefonts/noto/NotoSans-Regular.woff2" type="font/woff2" crossorigin>
    <link rel="preload" as="font" href="/assets/vendor/googlefonts/quicksand/Quicksand-VariableFont_wght.woff2" type="font/woff2" crossorigin>
    <?php if (preg_match('#^(/en)?/kontakt/?$#', parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?: '')): ?>
    <link rel="modulepreload" href="<?= asset('contact-form.js') ?>">
    <?php endif; ?>
    <link rel="modulepreload" href="<?= asset('site.js') ?>">
    <?= json_ld_tags($jsonld, $cspNonce) ?>
</head>
<?php
    return (string)ob_get_clean();
}
