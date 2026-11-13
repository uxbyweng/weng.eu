<?php
// Kontakt-Band: auf allen Seiten außer /kontakt/ und der Seite in Einfacher Sprache (hat einen eigenen Kontaktabschnitt) vor dem Footer einbinden.
if (is_active('/kontakt/', false) || is_active('/einfache-sprache/', false)) return;
?>
<section class="contact-band" aria-labelledby="contact-band-title">
    <div class="wrap contact-band__inner">
        <div class="contact-band__intro">
            <p class="eyebrow"><?= e(t('band.eyebrow')) ?></p>
            <h2 id="contact-band-title"><?= e(t('band.title')) ?></h2>
            <p class="contact-band__text"><?= e(t('band.text')) ?></p>
        </div>
        <div class="contact-band__actions">
            <p><a class="contact-band__mail" href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></p>
            <ul class="contact-band__links">
                <li><a class="button button--outline button--small" href="<?= url('/kontakt/') ?>"><?= e(t('band.form')) ?></a></li>
                <?php // Marken-Icons (Simple Icons, 24er Raster, gefüllt): LinkedIn und GitHub ?>
                <li><a href="<?= e(SITE_LINKEDIN) ?>" target="_blank" rel="noopener noreferrer"><svg class="contact-band__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>LinkedIn&nbsp;<?= ext_icon() ?><?= new_window_hint() ?></a></li>
                <li><a href="<?= e(SITE_GITHUB) ?>" target="_blank" rel="noopener noreferrer"><svg class="contact-band__icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M12 .297c-6.63 0-12 5.373-12 12 0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577 0-.285-.01-1.04-.015-2.04-3.338.724-4.042-1.61-4.042-1.61C4.422 18.07 3.633 17.7 3.633 17.7c-1.087-.744.084-.729.084-.729 1.205.084 1.838 1.236 1.838 1.236 1.07 1.835 2.809 1.305 3.495.998.108-.776.417-1.305.76-1.605-2.665-.3-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.135-.303-.54-1.523.105-3.176 0 0 1.005-.322 3.3 1.23.96-.267 1.98-.399 3-.405 1.02.006 2.04.138 3 .405 2.28-1.552 3.285-1.23 3.285-1.23.645 1.653.24 2.873.12 3.176.765.84 1.23 1.91 1.23 3.22 0 4.61-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.285 0 .315.21.69.825.57C20.565 22.092 24 17.592 24 12.297c0-6.627-5.373-12-12-12"/></svg>GitHub&nbsp;<?= ext_icon() ?><?= new_window_hint() ?></a></li>
            </ul>
        </div>
    </div>
</section>
