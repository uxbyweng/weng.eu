<?php
// Kontakt-Band: auf allen Seiten außer /kontakt/ und der Seite in Einfacher Sprache (hat einen eigenen Kontaktabschnitt) vor dem Footer einbinden.
if (is_active('/kontakt/', false) || is_active('/einfache-sprache/', false)) return;
?>
<section class="contact-band" aria-labelledby="contact-band-title">
    <div class="wrap contact-band__inner">
        <h2 id="contact-band-title"><?= e(t('band.title')) ?></h2>
        <p class="contact-band__text"><?= e(t('band.text')) ?></p>
        <a class="button contact-band__button" href="<?= url('/kontakt/') ?>"><?= e(t('band.form')) ?></a>
    </div>
</section>
