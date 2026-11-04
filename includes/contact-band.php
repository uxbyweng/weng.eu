<?php
// Kontakt-Band: auf allen Seiten außer /kontakt/ vor dem Footer einbinden.
if (is_active('/kontakt/', false)) return;
?>
<section class="contact-band" aria-labelledby="contact-band-title">
    <div class="wrap">
        <p class="eyebrow"><?= e(t('band.eyebrow')) ?></p>
        <h2 id="contact-band-title"><?= e(t('band.title')) ?></h2>
        <p class="contact-band__text"><?= e(t('band.text')) ?></p>
        <p><a class="contact-band__mail" href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></p>
        <ul class="contact-band__links">
            <li><a href="<?= e(SITE_LINKEDIN) ?>">LinkedIn&nbsp;<span aria-hidden="true">↗</span></a></li>
            <li><a href="<?= e(SITE_GITHUB) ?>">GitHub&nbsp;<span aria-hidden="true">↗</span></a></li>
            <li><a href="/kontakt/"><?= e(t('band.form')) ?>&nbsp;<span aria-hidden="true">→</span></a></li>
            <li><?= e(t('band.place')) ?></li>
        </ul>
    </div>
</section>
