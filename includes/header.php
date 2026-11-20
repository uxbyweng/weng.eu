<?php
// Kopfbereich (Skip-Link, Logo, Navigation, Theme-Schalter). Aktiver Punkt: aria-current="page".
$navItems = [
    ['/projekte/',  'nav.projects', true],   // true = auch Unterseiten (Case Studies) markieren
    ['/leistungen/', 'nav.services', true],
    ['/ueber-mich/', 'nav.about', false],
];
$onEasy = str_starts_with(current_path(), '/einfache-sprache');

// Service-Elemente (Einfache Sprache, Sprache, Darstellung): einmal in der Service-Leiste (Desktop) und einmal im Menü (mobil).
// Die jeweils nicht sichtbare Fassung ist per CSS display:none und damit auch für Screenreader und Tastatur aus dem Weg. $themeId: id nur einmal vergeben.
$serviceItems = function (string $themeId) use ($onEasy): void { ?>
                <li>
                    <?php if ($onEasy): ?>
                        <a class="service-bar__link" href="<?= url('/') ?>"><?= e(t('nav.everyday')) ?></a>
                    <?php else: ?>
                        <a class="service-bar__link" href="<?= url('/einfache-sprache/') ?>">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                                <path d="M4 5h7M9 3v2c0 4.4-2.2 8-5 8M5 9c0 2.1 3 3.9 6.7 4M12 20l4-9 4 9M19.1 18h-6.2" />
                            </svg>
                            <?= e(t('nav.easy')) ?>
                        </a>
                    <?php endif; ?>
                </li>
                <?php /* role="group" gehört auf ein inneres Element: ein <li> mit eigener Rolle ist kein Listenelement mehr (Lighthouse: "Listen enthalten nicht nur <li>") */ ?>
                <li>
                    <div class="lang-switch" role="group" aria-label="<?= e(t('lang.label')) ?>">
                        <?php foreach (['de' => 'DE', 'en' => 'EN'] as $code => $label): ?>
                            <a class="service-bar__link" href="<?= e(lang_url($code)) ?>" hreflang="<?= $code ?>" lang="<?= $code ?>"
                                <?= current_lang() === $code ? 'aria-current="true"' : '' ?>><?= $label ?></a>
                        <?php endforeach; ?>
                    </div>
                </li>
                <li>
                    <button <?= $themeId ?> class="icon-button theme-toggle" data-theme-toggle type="button" aria-pressed="false"
                        aria-label="<?= e(t('theme.activate')) ?>"
                        data-label-activate="<?= e(t('theme.activate')) ?>"
                        data-label-deactivate="<?= e(t('theme.deactivate')) ?>">
                        <svg class="theme-toggle__moon" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <path d="M21 12.8A9 9 0 1 1 11.2 3 7 7 0 0 0 21 12.8z" />
                        </svg>
                        <svg class="theme-toggle__sun" viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
                            <circle cx="12" cy="12" r="4" />
                            <path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4" />
                        </svg>
                    </button>
                </li>
<?php };
?>
<a class="skip-link" href="#main"><?= e(t('skip')) ?></a>

<header class="site-header">
    <?php /* Service-Leiste (nur Desktop): Varianten der ganzen Seite. Auf jeder Seite an derselben Stelle. */ ?>
    <div class="service-bar">
        <div class="wrap service-bar__inner">
            <ul class="service-bar__list">
                <?php $serviceItems('id="toggleTheme"'); ?>
            </ul>
        </div>
    </div>

    <div class="wrap site-header__inner">
        <a class="site-header__logo" href="<?= url('/') ?>" aria-label="<?= e(t('logo.home_aria')) ?>">
            <img src="/assets/img/logo/logo-weng.svg" alt="" width="104" height="36" fetchpriority="high" decoding="async">
        </a>

        <nav id="site-nav" class="site-nav" aria-label="<?= e(t('nav.label')) ?>">
            <ul class="site-nav__list">
                <?php foreach ($navItems as [$href, $key, $prefix]): ?>
                    <li><a class="site-nav__link" href="<?= url($href) ?>" <?= aria_current($href, $prefix) ?>><?= e(t($key)) ?></a></li>
                <?php endforeach; ?>
                <li><a class="site-nav__link site-nav__link--cta" href="<?= url('/kontakt/') ?>" <?= aria_current('/kontakt/', false) ?>><?= e(t('nav.contact')) ?></a></li>
            </ul>
            <?php /* Mobil, nur im Vollbild-Menü: externe Profile (öffnen in neuem Fenster) */ ?>
            <ul class="site-nav__external">
                <li><a href="<?= e(SITE_LINKEDIN) ?>" target="_blank" rel="noopener noreferrer">LinkedIn <?= ext_icon() ?><?= new_window_hint() ?></a></li>
                <li><a href="<?= e(SITE_GITHUB) ?>" target="_blank" rel="noopener noreferrer">GitHub <?= ext_icon() ?><?= new_window_hint() ?></a></li>
            </ul>
            <?php /* Mobil: Service-Elemente im ausgeklappten Menü statt in der Leiste */ ?>
            <ul class="site-nav__service service-bar__list">
                <?php $serviceItems(''); ?>
            </ul>
        </nav>

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
</header>
