<?php
  // Hilfen
  function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

  // Sprache aus deiner Session/Cookie-Logik
  $sprache = $_SESSION['sprache'] ?? $_COOKIE['sprache'] ?? 'de';
  $isEN = ($sprache === 'en');

  // Defaults, falls eine Seite nichts setzt
  $defaults = [
    'title'    => 'WENG.EU | UX/UI Web Design – Built for People.',
    'desc'     => 'Websites, die nicht nur funktionieren, sondern überzeugen. Schnell. Barrierefrei. SEO-optimiert. Responsiv.',
    'og_image' => '/assets/img/logo/logo-light.svg',
    'robots'   => 'index, follow',
  ];

  // gemergte Meta
  $m = array_merge($defaults, $meta ?? []);

  // einsprachige Keys unterstützen (falls du nur 'title'/'desc' setzt)
  $title = $m[$isEN ? 'title_en' : 'title_de'] ?? ($m['title'] ?? $siteDefaults[$isEN?'title_en':'title_de']);
  $desc  = $m[$isEN ? 'desc_en'  : 'desc_de']  ?? ($m['desc']  ?? $siteDefaults[$isEN?'desc_en':'desc_de']);

  // absolute URL für og:url
  $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
  $host   = $_SERVER['HTTP_HOST'] ?? 'www.weng.eu';
  $path   = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
  $pageUrl = $scheme.'://'.$host.$path;

  // og:image absolut machen
  $ogImg = $m['og_image'];
  if (strpos($ogImg, 'http') !== 0) {
    $ogImg = $scheme.'://'.$host.$ogImg;
  }

  // og:locale
  $ogLocale = $isEN ? 'en_US' : 'de_DE';

  // updated_time – aus Dateidatum der laufenden Datei
  $updatedTime = gmdate('c', @filemtime($_SERVER['SCRIPT_FILENAME']) ?: time());

  // robots erlauben pro Seite override
  $robots = $m['robots'] ?? $defaults['robots'];
?>
<!DOCTYPE html>
<html lang="de" data-bs-theme="<?php echo $_COOKIE['theme'] ?? 'light'; ?>">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= e($m['title']) ?></title>
        <meta name="description" content="<?= e($m['desc']) ?>">
        <meta name="robots" content="<?= e($m['robots']) ?>">

        <!-- Open Graph / Facebook / Twitter -->
        <meta property="og:title" content="<?= e($m['title']) ?>">
        <meta property="og:description" content="<?= e($m['desc']) ?>">
        <meta property="og:site_name" content="WENG.EU">
        <meta property="og:type" content="article">
        <meta property="og:image:width" content="0"/>
        <meta property="og:image:height" content="0"/>
        <meta property="og:image" content="<?= e($ogImg) ?>">
        <meta property="og:url" content="<?= e($pageUrl) ?>">
        <meta property="og:updated_time" content="<?= gmdate('c', @filemtime($_SERVER['SCRIPT_FILENAME']) ?: time()) ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?= e($m['title']) ?>">
        <meta name="twitter:description" content="<?= e($m['desc']) ?>">
        <meta name="twitter:image" content="<?= e($ogImg) ?>">

        <!-- Theme Flash Prevention -->
        <script>
            (function () {
                var stored = null; 
                try { stored = localStorage.getItem('theme'); } catch(e){}
                var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                var theme = stored ? stored : (prefersDark ? 'dark' : 'light');
                var de = document.documentElement;
                de.setAttribute('data-bs-theme', theme);
                de.style.backgroundColor = theme === 'dark' ? '#212529' : '#f5f7f1';
            })();
        </script>

        <!-- Canonical URL -->
        <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/canonical.php'; ?>

        <!-- Relational Links -->
        <link rel="license" href="https://weng.eu/impressum/" type="text/html" title="Impressum" />
        <link rel="help" href="https://weng.eu/barrierefreiheit/" type="text/html" title="Hilfe" />
        <link rel="start" href="https://weng.eu/" type="text/html" title="Homepage" />

        <!-- Favicons -->
        <link rel="apple-touch-icon" sizes="180x180" href="/assets/img/icons/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/assets/img/icons/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/assets/img/icons/favicon-16x16.png">
        <link rel="manifest" href="/assets/img/icons/site.webmanifest">
        <meta name="theme-color" content="#ffffff">

        <!-- CSS -->
        <style><?php readfile($_SERVER['DOCUMENT_ROOT'].'/assets/css/critical.css'); ?></style>

        <link rel="preload" href="/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css" as="style" onload="this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="/assets/vendor/bootstrap/bootstrap-icons/bootstrap-icons.min.css"></noscript>
        <link rel="preload" href="/assets/css/styles.css" as="style" onload="this.rel='stylesheet'">
        <noscript><link rel="stylesheet" href="/assets/css/styles.css"></noscript>

        <!-- Fonts -->
        <link rel="preload" as="font" href="/assets/vendor/googlefonts/noto/NotoSans-Medium.woff2" type="font/woff2" crossorigin>
        <link rel="preload" as="font" href="/assets/vendor/googlefonts/quicksand/Quicksand-VariableFont_wght.woff2" type="font/woff2" crossorigin>

        <!-- preload JavaScript -->
        <link rel="modulepreload" href="/assets/js/modules/theme-toggle.js">
        <link rel="modulepreload" href="/assets/js/modules/easy-language.js">
        <link rel="modulepreload" href="/assets/js/modules/lang-switcher.js">
        <link rel="modulepreload" href="/assets/js/modules/mobile-menu-autoclose.js">
        <?php if (preg_match('#^/kontakt/?$#', $_SERVER['REQUEST_URI'])): ?>
            <link rel="modulepreload" href="/assets/js/modules/contact-form.<?= ($sprache==='en'?'en':'de') ?>.js">
        <?php endif; ?>
        <link rel="modulepreload" href="/assets/js/site.<?= ($sprache==='en'?'en':'de') ?>.js">
    </head>
    <body>
        <a href="#startMainContent" class="visually-hidden-focusable">Skip to main content</a>
        <form id="langForm" method="post" style="display:none;">
            <input name="lang" type="hidden">
        </form>
        <header class="container-fluid py-4 border-bottom bg-header">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <a href="/" class="logo-link" title="Zur Startseite">
                            <img id="logoImage" src="/assets/img/logo/logo-light.svg" alt="Logo: weng.eu" class="logo-img" fetchpriority="high" decoding="async" width="100" height="41">
                        </a>
                    </div>
                    <div class="d-md-none">
                        <button class="navbar-toggler custom-toggler collapsed"
                                type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#mainNav"
                                aria-controls="mainNav"
                                aria-expanded="false"
                                aria-label="Menü öffnen">
                        <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="d-none d-md-block">
                        <nav style="float:left;" aria-label="Hauptnavigation">
                            <ul class="nav justify-content-end">
                                <li class="nav-item">
                                    <a class="nav-link" href="/" title="<?php if ($sprache === 'en'): ?>To the homepage<?php else: ?>Zur Startseite<?php endif; ?>">
                                        Home
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/projekte/" title="Zur Projektübersicht">
                                        <?php if ($sprache === 'en'): ?>
                                            Projects
                                        <?php else: ?>
                                            Projekte
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/kontakt/">
                                        <?php if ($sprache === 'en'): ?>
                                            Contact
                                        <?php else: ?>
                                            Kontakt
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item lang-switch d-flex align-items-center gap-1" aria-label="<?php if ($sprache === 'en'): ?>Language Selection<?php else: ?>Sprachauswahl<?php endif; ?>">
                                    <a href="#" data-lang="de" class="nav-link pe-0 <?= ($sprache==='de' ? 'active' : '') ?>" aria-current="<?= ($sprache==='de' ? 'true' : 'false') ?>">de</a>
                                    <span class="text-body-secondary">/</span>
                                    <a href="#" data-lang="en" class="nav-link ps-0 <?= ($sprache==='en' ? 'active' : '') ?>" aria-current="<?= ($sprache==='en' ? 'true' : 'false') ?>">en</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/leichte-sprache/" id="easyLanguageIconLink" title="<?php if ($sprache === 'en'): ?>Easy Language<?php else: ?>Zur Website in Leichter Sprache<?php endif; ?>">
                                        <i class="bi bi-translate"></i> 
                                    </a>
                                    <a class="nav-link d-none" href="/" id="alltagsSpracheLink" title="<?php if ($sprache === 'en'): ?>To the page in Everyday Language<?php else: ?>Zur Website in Alltags-Sprache<?php endif; ?>">
                                        <?php if ($sprache === 'en'): ?>
                                            Page in Everyday Language
                                        <?php else: ?>
                                            Seite in Alltags-Sprache
                                        <?php endif; ?>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <!--button id="toggleTheme" class="btn ms-2 themetoggle">
                                        <i class="bi bi-moon" id="themeIcon"></i>
                                    </button-->
                                    <button id="toggleTheme"
                                            class="btn ms-2 themetoggle"
                                            type="button"
                                            aria-pressed="false"
                                            aria-label="<?php echo ($sprache==='en'?'Activate dark mode':'Dunkelmodus aktivieren'); ?>"
                                            data-label-activate="<?php echo ($sprache==='en'?'Activate dark mode':'Dunkelmodus aktivieren'); ?>"
                                            data-label-deactivate="<?php echo ($sprache==='en'?'Deactivate dark mode':'Dunkelmodus deaktivieren'); ?>">
                                    <i class="bi bi-moon" id="themeIcon" aria-hidden="true"></i>
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="collapse navbar-collapse d-md-none" id="mainNav">
                    <ul class="navbar-nav ms-auto mt-3">
                        <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2">
                            <a class="nav-link" href="/projekte/">
                            <?php if ($sprache === 'en'): ?>
                                Projects
                            <?php else: ?>
                                Projekte
                            <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2">
                            <a class="nav-link" href="/kontakt/">
                                <?php if ($sprache === 'en'): ?>
                                    Contact
                                <?php else: ?>
                                    Kontakt
                                <?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2 lang-switch d-flex align-items-center gap-1" aria-label="<?php if ($sprache === 'en'): ?>Language Selection<?php else: ?>Sprachauswahl<?php endif; ?>">
                            <a href="#" data-lang="de" class="nav-link pe-0 <?= ($sprache==='de' ? 'active' : '') ?>" aria-current="<?= ($sprache==='de' ? 'true' : 'false') ?>">Deutsch</a>
                            <span class="text-body-secondary">/</span>
                            <a href="#" data-lang="en" class="nav-link ps-0 <?= ($sprache==='en' ? 'active' : '') ?>" aria-current="<?= ($sprache==='en' ? 'true' : 'false') ?>">Englisch</a>
                        </li>
                        <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2">
                            <a class="nav-link" href="/leichte-sprache/" id="easyLanguageIconLinkMobile" data="[data-no-autoclose]">
                                <i class="bi bi-translate"></i> <?php if ($sprache === 'en'): ?>Easy Language<?php else: ?>Leichte Sprache<?php endif; ?>
                            </a>
                            <a class="nav-link d-none" href="/" id="alltagsSpracheLinkMobile" data="[data-no-autoclose]">
                                <i class="bi bi-translate"></i> <?php if ($sprache === 'en'): ?>Everyday Language<?php else: ?>Alltags-Sprache<?php endif; ?>
                            </a>
                        </li>
                        <li class="nav-item fs-22">
                            <button class="btn nav-link" id="toggleThemeMobile"
                                type="button"
                                aria-pressed="false"
                                aria-label="<?php echo ($sprache==='en'?'Activate dark mode':'Dunkelmodus aktivieren'); ?>"
                                data-label-activate="<?php echo ($sprache==='en'?'Activate dark mode':'Dunkelmodus aktivieren'); ?>"
                                data-label-deactivate="<?php echo ($sprache==='en'?'Deactivate dark mode':'Dunkelmodus deaktivieren'); ?>"
                                data-text-dark="<?php echo ($sprache==='en'?'Light Mode':'Heller Modus'); ?>"
                                data-text-light="<?php echo ($sprache==='en'?'Dark Mode':'Dunkler Modus'); ?>">
                                <i class="bi bi-moon" id="themeIconMobileIcon" aria-hidden="true"></i> <span id="themeTextMobile"><?php echo ($sprache==='en'?'Dark Mode':'Dunkler Modus'); ?></span>
                            </button>
                            <a class="nav-link" href="#" id="toggleThemeMobile"></a>
                        </li>
                    </ul>
                </div>
            </div>  
        </header>
