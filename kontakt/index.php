<?php
header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
header('Pragma: no-cache');
define('NEED_SESSION', true);
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/session.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/head.php';

// vorübergehend, bis alle sprachswitcher auf die neue schreibweise umgestellt sind
$sprache = current_lang();   // aus helpers.php

/* Tokens generieren (Form-ID: 'contact') */
$hpName = get_honeypot_name('contact');
$csrf   = get_csrf_token('contact');
session_write_close();
$meta = [
  'title' => 'WENG.EU - Kontakt / Contact',
  'desc'  => 'Get in touch.',
  'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
$isEn = is_en();
?>

<body> 
    <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>

    <main class="page-wrapper" id="startMainContent">

    <!-- ### BREADCRUMB ### -->  
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

    <!-- ### STAGE ### -->    
    <section class="px-3 px-md-0 pt-3">
        <div class="container">
            <div class="row">
                <div class="col-md-7 order-2 mt-3">
                    <h1>
                        Just say <span class="font-accent">hello</span> and drop me a line.
                    </h1>
                </div>
                <div class="offset-md-1 col-md-4 text-center order-1 order-md-3">
                    <picture>
                        <!-- Desktop (≥ 56.25em ≈ 900px): 200×200 -->
                        <source media="(min-width:56.25em)" srcset="/assets/img/contact/img-contact.webp" type="image/webp">
                        <source media="(min-width:56.25em)" srcset="/assets/img/contact/img-contact.jpg"  type="image/jpeg">
                        <!-- Mobile (< 56.25em): 100×100 -->
                        <source srcset="/assets/img/contact/img-contact_xs.webp" type="image/webp">
                        <!-- Fallback (Browser ohne <picture> oder ohne WebP): mobile-Datei -->
                        <img src="/assets/img/contact/img-contact_xs.jpg" alt="Karsten Weng" class="contact-photo" width="200" height="200" loading="lazy" decoding="async">
                    </picture>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACT FORM -->
    <section class="px-3 px-md-0 py-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 order-1 pb-5">
                    <?php if (is_en()): ?>
                    <form action="/kontakt/kontakt.en.php" method="post" id="contact-form" novalidate>
                    <?php else: ?>
                    <form action="/kontakt/kontakt.de.php" method="post" id="contact-form" novalidate>
                    <?php endif; ?>
                        <div class="messages"></div>
                        <div class="form-group">
                            <label for="cf-name" class="form-label">Name*</label>
                            <input
                            id="cf-name"
                            name="name"
                            type="text"
                            class="form-control"
                            placeholder="<?php if (is_en()): ?>Name<?php else: ?>Name<?php endif; ?>"
                            required
                            pattern="^[A-Za-zÀ-ÖØ-öø-ÿ](?:[A-Za-zÀ-ÖØ-öø-ÿ'’\- ]*[A-Za-zÀ-ÖØ-öø-ÿ])$"
                            autocomplete="name"
                            inputmode="text"
                            autocapitalize="words">
                        </div>
                        <div class="form-group">
                            <label for="cf-email" class="form-label">
                            <?php if (is_en()): ?>Email Address*<?php else: ?>E-Mail-Adresse*<?php endif; ?>
                            </label>
                            <input
                            id="cf-email"
                            name="email"
                            type="email"
                            class="form-control"
                            placeholder="<?php if (is_en()): ?>Email Address<?php else: ?>E-Mail-Adresse<?php endif; ?>"
                            required
                            pattern="^[^\s@]+@[^\s@]+\.[^\s@]{2,}$"
                            autocomplete="email"
                            inputmode="email">
                            <input type="text" name="<?= e($hpName) ?>" class="visually-hidden" tabindex="-1" autocomplete="off" aria-hidden="true">
                            <input type="hidden" name="csrf" value="<?= e($csrf) ?>">
                        </div>
                        <div class="form-group">
                            <label for="cf-message" class="form-label">
                            <?php if (is_en()): ?>Message*<?php else: ?>Nachricht*<?php endif; ?>
                            </label>
                            <style>
                            ::spelling-error {
                                color: red;
                                text-decoration: 2px underline solid crimson;
                            }
                            </style>
                            <textarea
                            id="cf-message"
                            name="message"
                            spellcheck="true"
                            class="form-control"
                            rows="3"
                            placeholder="<?php if (is_en()): ?>Message<?php else: ?>Nachricht<?php endif; ?>"
                            required
                            autocomplete="off"></textarea>
                        </div>
                        <div class="form-group terms" style="position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;">
                            <input type="checkbox" name="terms" tabindex="-1" aria-hidden="true" autocomplete="off">
                        </div>
                        <div class="form-group privacy">
                            <label>
                            <input
                                type="checkbox"
                                name="privacy"
                                required
                                value="checked"
                                autocomplete="off">
                            <?php if (is_en()): ?>
                                I have read the <a href="/datenschutz/"><u>Privacy Policy</u></a> and I agree to be contacted by email.
                            <?php else: ?>
                                Ich habe die <a href="/datenschutz/"><u>Datenschutzerklärung</u></a> gelesen und bin damit einverstanden, dass ich per E-Mail kontaktiert werde.
                            <?php endif; ?>
                            </label>
                        </div>
                        <button class="btn btn-primary pull-right-sm">
                            <?php if (is_en()): ?>Send Message<?php else: ?>Nachricht senden<?php endif; ?>
                        </button>
                    </form>
                </div>
                <aside class="col-12 offset-md-2 col-md-3 order-2 pe-5">
                    <section class="py-3 border-bottom">
                        <h2 class="fs-20 font-gray8 text-uppercase">
                            <?php if (is_en()): ?>
                                <strong>Contact</strong>
                            <?php else: ?>
                                <strong>Kontakt</strong>
                            <?php endif; ?>
                        </h2>
                        <p>
                            Karsten Weng<br>
                            Berlin, Germany<br>
                            <a href="mailto:info@weng.eu"><u>info@weng.eu</u></a>
                        </p>
                    </section>
                    <section class="py-3 border-bottom mb-5">
                        <h2 class="fs-20 font-gray8 text-uppercase">
                            <strong>Networks</strong>
                        </h2>
                        <ul class="style-none">
                            <li>
                                <a href="https://www.linkedin.com/in/kweng/" target="_blank" rel="noopener noreferrer" title="LinkedIn">
                                    <i class="fa-brands fa-linkedin fa-lg" aria-hidden="true"></i> LinkedIn
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank" rel="noopener noreferrer" title="Instagram">
                                    <i class="fa-brands fa-instagram fa-lg" aria-hidden="true"></i> Instagram
                                </a>
                            </li>
                        </ul>
                    </section>
                </aside>
            </div>
        </div>
    </section>


<?php include( $_SERVER[ "DOCUMENT_ROOT" ] . "/includes/footer.php" ); ?>
