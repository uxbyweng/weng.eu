<?php
// Kopfbereich (Skip-Link, Logo, Navigation, Theme-Schalter). Aktiver Punkt: aria-current="page".
$navItems = [
    ['/projekte/',  'nav.projects', true],   // true = auch Unterseiten (Case Studies) markieren
    ['/leistungen/', 'nav.services', true],
    ['/ueber-mich/', 'nav.about', false],
];
$onEasy = str_starts_with(current_path(), '/leichte-sprache');
?>
<a class="skip-link" href="#main"><?= e(t('skip')) ?></a>

<header class="site-header">
    <div class="wrap site-header__inner">
        <a class="site-header__logo" href="<?= url('/') ?>" aria-label="<?= e(t('logo.home_aria')) ?>">
            <img src="/assets/img/logo/logo-weng.svg" alt="" width="104" height="36" fetchpriority="high" decoding="async">
        </a>

        <nav id="site-nav" class="site-nav" aria-label="<?= e(t('nav.label')) ?>">
            <ul class="site-nav__list">
                <?php foreach ($navItems as [$href, $key, $prefix]): ?>
                    <li><a class="site-nav__link" href="<?= url($href) ?>" <?= aria_current($href, $prefix) ?>><?= e(t($key)) ?></a></li>
                <?php endforeach; ?>
                <li>
                    <?php if ($onEasy): ?>
                        <a class="site-nav__link site-nav__link--quiet" href="<?= url('/') ?>"><?= e(t('nav.everyday')) ?></a>
                    <?php else: ?>
                        <a class="site-nav__link site-nav__link--quiet" href="<?= url('/leichte-sprache/') ?>"><?= e(t('nav.easy')) ?></a>
                    <?php endif; ?>
                </li>
                <li><a class="site-nav__link site-nav__link--cta" href="<?= url('/kontakt/') ?>" <?= aria_current('/kontakt/', false) ?>><?= e(t('nav.contact')) ?></a></li>
                <li class="lang-switch" role="group" aria-label="<?= e(t('lang.label')) ?>">
                    <?php foreach (['de' => 'DE', 'en' => 'EN'] as $code => $label): ?>
                        <a class="site-nav__link site-nav__link--quiet" href="<?= e(lang_url($code)) ?>" hreflang="<?= $code ?>" lang="<?= $code ?>"
                            <?= current_lang() === $code ? 'aria-current="true"' : '' ?>><?= $label ?></a>
                    <?php endforeach; ?>
                </li>
            </ul>
        </nav>

        <div class="site-header__tools">
            <button id="toggleTheme" class="icon-button theme-toggle" type="button" aria-pressed="false"
                aria-label="<?= e(t('theme.activate')) ?>"
                data-label-activate="<?= e(t('theme.activate')) ?>"
                data-label-deactivate="<?= e(t('theme.deactivate')) ?>">
                <svg class="theme-toggle__moon" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8z" />
                </svg>
                <svg class="theme-toggle__sun" viewBox="0 0 24 24" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                    <circle cx="12" cy="12" r="4" />
                    <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4" />
                </svg>
            </button>
            <?php /* Menü-Button: nur mobil und nur mit JS (nav-toggle.ts blendet ihn ein). Ohne JS bleibt die Navigation sichtbar. */ ?>
            <button class="icon-button nav-toggle" type="button" hidden aria-controls="site-nav" aria-expanded="false"
                aria-label="<?= e(t('nav.menu_open')) ?>"
                data-label-open="<?= e(t('nav.menu_open')) ?>"
                data-label-close="<?= e(t('nav.menu_close')) ?>">
                <svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true" focusable="false">
                    <path class="nav-toggle__open" d="M4 7h16M4 12h16M4 17h16" />
                    <path class="nav-toggle__close" d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>
        </div>
    </div>
</header>
