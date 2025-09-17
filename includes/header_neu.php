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
                                    <?php if ($sprache === 'en'): ?>Projects<?php else: ?>Projekte<?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/kontakt/">
                                    <?php if ($sprache === 'en'): ?>Contact<?php else: ?>Kontakt<?php endif; ?>
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
                                    <?php if ($sprache === 'en'): ?>Page in Everyday Language<?php else: ?>Seite in Alltags-Sprache<?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
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