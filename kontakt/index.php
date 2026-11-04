<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
define('NEED_SESSION', true);
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';

/* Tokens generieren (Form-ID: 'contact') */
$hpName = get_honeypot_name('contact');
$csrf   = get_csrf_token('contact');
session_write_close();

$meta = [
    'title' => t('contact.meta.title'),
    'desc'  => t('contact.meta.desc'),
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

$action = '/kontakt/kontakt.' . (is_en() ? 'en' : 'de') . '.php';
$privacyLink = '<a href="' . e(url('/datenschutz/')) . '" target="_blank" rel="noopener">' . e(t('contact.form.privacy.link')) . '</a>';
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <section class="page-head" aria-labelledby="contact-title">
            <div class="wrap">
                <p class="eyebrow"><?= e(t('contact.eyebrow')) ?></p>
                <h1 id="contact-title"><?= e(t('contact.title')) ?></h1>
                <p class="lead"><?= e(t('contact.lead')) ?></p>
            </div>
        </section>

        <section class="contact">
            <div class="wrap contact__inner">

                <div class="contact__form">
                    <form class="contact-form" id="contact-form" action="<?= e($action) ?>" method="post" novalidate aria-label="<?= e(t('contact.form.label')) ?>">
                        <?php /* Meldungen des Formulars (contact-form.ts schreibt Erfolg als role="status", Fehler als role="alert") */ ?>
                        <div class="messages"></div>

                        <div class="form-field">
                            <label for="cf-name"><?= e(t('contact.form.name')) ?> <span aria-hidden="true">*</span></label>
                            <input id="cf-name" name="name" type="text" required autocomplete="name">
                        </div>

                        <div class="form-field">
                            <label for="cf-email"><?= e(t('contact.form.email')) ?> <span aria-hidden="true">*</span></label>
                            <input id="cf-email" name="email" type="email" required autocomplete="email" inputmode="email">
                            <input type="text" name="<?= e($hpName) ?>" class="visually-hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
                            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                        </div>

                        <div class="form-field">
                            <label for="cf-message"><?= e(t('contact.form.message')) ?> <span aria-hidden="true">*</span></label>
                            <textarea id="cf-message" name="message" rows="7" required spellcheck="true" autocomplete="off"></textarea>
                        </div>

                        <?php /* Bot-Falle (unsichtbar, nicht fokussierbar) */ ?>
                        <div class="form-field form-field--trap">
                            <input type="checkbox" name="terms" tabindex="-1" aria-hidden="true" autocomplete="off">
                        </div>

                        <p class="form-note" id="privacy-note"><?= str_replace('{link}', $privacyLink, e(t('contact.form.privacy'))) ?><?= todo('Antwortzeit, z. B. „Ich antworte in der Regel innerhalb von zwei Werktagen.“', ' ') ?></p>

                        <div class="form-actions">
                            <button class="button" type="submit" aria-describedby="privacy-note"><?= e(t('contact.form.submit')) ?></button>
                        </div>
                    </form>
                </div>

                <aside class="contact-card" aria-label="<?= e(t('contact.aside.label')) ?>">
                    <div class="contact-card__head">
                        <img src="/assets/img/contact/img-contact_xs.jpg" alt="" width="72" height="72" loading="lazy" decoding="async">
                        <div>
                            <p class="contact-card__name">Karsten Weng</p>
                            <p class="contact-card__role"><?= e(t('meta.job_title')) ?></p>
                        </div>
                    </div>
                    <dl class="contact-card__list">
                        <div><dt><?= e(t('contact.aside.email')) ?></dt><dd><a href="mailto:<?= e(SITE_EMAIL) ?>"><?= e(SITE_EMAIL) ?></a></dd></div>
                        <?php if ($phone = todo('Telefonnummer (optional)')): ?>
                            <div><dt><?= e(t('contact.aside.phone')) ?></dt><dd><?= $phone ?></dd></div>
                        <?php endif; ?>
                        <div><dt><?= e(t('contact.aside.place')) ?></dt><dd><?= e(t('band.place')) ?></dd></div>
                        <div>
                            <dt><?= e(t('contact.aside.profiles')) ?></dt>
                            <dd class="contact-card__profiles">
                                <a href="<?= e(SITE_LINKEDIN) ?>" rel="noopener">LinkedIn <span aria-hidden="true">↗</span></a>
                                <a href="<?= e(SITE_GITHUB) ?>" rel="noopener">GitHub <span aria-hidden="true">↗</span></a>
                            </dd>
                        </div>
                    </dl>
                </aside>

            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
