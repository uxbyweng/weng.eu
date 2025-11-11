<a href="#startMainContent" class="visually-hidden-focusable"><?= $isEn ? 'Skip to main content' : 'Zum Hauptinhalt springen' ?></a>
<form id="langForm" method="post" style="display:none;">
    <input name="lang" type="hidden">
</form>
<header class="container-fluid py-4 border-bottom bg-header">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-2">
                <a href="/" class="logo-link" title="<?= $isEn ? 'To the homepage' : 'Zur Startseite' ?>">
                    <img id="logoImage" src="/assets/img/logo/logo-weng.svg" alt="Logo: weng.eu" class="logo-img" fetchpriority="high" decoding="async" width="100" height="41">
                </a>
            </div>
            <div class="d-md-none">
                <button class="navbar-toggler custom-toggler collapsed"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNav"
                    aria-controls="mainNav"
                    aria-expanded="false"
                    aria-label="<?= $isEn ? 'Menu toggle' : 'Menü öffnen' ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="d-none d-md-block">
                <nav style="float:left;" aria-label="<?= $isEn ? 'Main navigation' : 'Hauptnavigation' ?>">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link <?= active_class('/', false) ?>" href="/" title="<?= $isEn ? 'To the homepage' : 'Zur Startseite' ?>" <?= aria_current('/', false) ?>>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= active_class('/projekte/', true) ?>" href="/projekte/" title="<?= $isEn ? 'To the project overview' : 'Zur Projektübersicht' ?>" <?= aria_current('/projekte/', true) ?>>
                                <?= $isEn ? 'Projects' : 'Projekte' ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= active_class('/kontakt/', false) ?>" href="/kontakt/" <?= aria_current('/kontakt/', false) ?>>
                                <?= $isEn ? 'Contact' : 'Kontakt' ?>
                            </a>
                        </li>
                        <li class="nav-item lang-switch d-flex align-items-center gap-1" aria-label="<?= $isEn ? 'Language selection' : 'Sprachauswahl' ?>">
                            <a href="#" data-lang="de"
                                class="nav-link pe-0 <?= $isEn ? '' : 'active' ?>"
                                <?= $isEn ? '' : 'aria-current="page"' ?>>de</a>
                            <span class="text-body-secondary">/</span>
                            <a href="#" data-lang="en"
                                class="nav-link ps-0 <?= $isEn ? 'active' : '' ?>"
                                <?= $isEn ? 'aria-current="page"' : '' ?>>en</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/leichte-sprache/" id="easyLanguageIconLink" title="<?= $isEn ? 'Easy Language' : 'Link zur Website in Leichter Sprache' ?>" <?= aria_current('/leichte-sprache/', false) ?>>
                                <i class="bi bi-translate"></i>
                            </a>
                            <a class="nav-link d-none" href="/" id="alltagsSpracheLink" title="<?= $isEn ? 'To the page in Everyday Language' : 'Link zur Website in Alltags-Sprache' ?>">
                                <?= $isEn ? 'Page in Everyday Language' : 'Seite in Alltags-Sprache' ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <button id="toggleTheme"
                                class="btn ms-2 themetoggle"
                                type="button"
                                aria-pressed="false"
                                aria-label="<?= $isEn ? 'Activate dark mode' : 'Dunkelmodus aktivieren' ?>"
                                data-label-activate="<?= $isEn ? 'Activate dark mode' : 'Dunkelmodus aktivieren' ?>"
                                data-label-deactivate="<?= $isEn ? 'Deactivate dark mode' : 'Dunkelmodus deaktivieren' ?>">
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
                        <?= $isEn ? 'Projects' : 'Projekte' ?>
                    </a>
                </li>
                <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2">
                    <a class="nav-link" href="/kontakt/">
                        <?= $isEn ? 'Contact' : 'Kontakt' ?>
                    </a>
                </li>
                <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2 lang-switch d-flex align-items-center gap-1"
                    aria-label="<?= e($isEn ? 'Language selection' : 'Sprachauswahl') ?>">
                    <a href="#"
                        data-lang="de"
                        class="nav-link pe-0 <?= $isEn ? '' : 'active' ?>"
                        <?= $isEn ? '' : 'aria-current="page"' ?>>
                        <?= $isEn ? 'German' : 'Deutsch' ?>
                    </a>
                    <span class="text-body-secondary">/</span>
                    <a href="#"
                        data-lang="en"
                        class="nav-link ps-0 <?= $isEn ? 'active' : '' ?>"
                        <?= $isEn ? 'aria-current="page"' : '' ?>>
                        <?= $isEn ? 'English' : 'Englisch' ?>
                    </a>
                </li>
                <li class="nav-item fs-22 border-bottom border-1 border-secondary py-2">
                    <a class="nav-link" href="/leichte-sprache/" id="easyLanguageIconLinkMobile" data="[data-no-autoclose]">
                        <i class="bi bi-translate"></i> <?= $isEn ? 'Easy Language' : 'Leichte Sprache' ?>
                    </a>
                    <a class="nav-link d-none" href="/" id="alltagsSpracheLinkMobile" data="[data-no-autoclose]">
                        <i class="bi bi-translate"></i> <?= $isEn ? 'Everyday Language' : 'Alltags-Sprache' ?>
                    </a>
                </li>
                <li class="nav-item fs-22">
                    <button class="btn nav-link" id="toggleThemeMobile"
                        type="button"
                        aria-pressed="false"
                        aria-label="<?= $isEn ? 'Activate dark mode' : 'Dunkelmodus aktivieren' ?>"
                        data-label-activate="<?= $isEn ? 'Activate dark mode' : 'Dunkelmodus aktivieren' ?>"
                        data-label-deactivate="<?= $isEn ? 'Deactivate dark mode' : 'Dunkelmodus deaktivieren' ?>"
                        data-text-dark="<?= $isEn ? 'Light Mode' : 'Heller Modus' ?>"
                        data-text-light="<?= $isEn ? 'Dark Mode' : 'Dunkler Modus' ?>">
                        <i class="bi bi-moon" id="themeIconMobileIcon" aria-hidden="true"></i> <span id="themeTextMobile"><?= $isEn ? 'Dark Mode' : 'Dunkler Modus' ?></span>
                    </button>
                    <a class="nav-link" href="#" id="toggleThemeMobile"></a>
                </li>
            </ul>
        </div>
    </div>
</header>