<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/contact-band.php'; ?>

<footer class="site-footer">
    <div class="wrap">
        <div class="site-footer__cols">
            <div class="site-footer__brand">
                <a href="<?= url('/') ?>" aria-label="<?= e(t('logo.home_aria')) ?>"><img src="/assets/img/logo/logo-weng.svg" alt="" width="93" height="32" loading="lazy" decoding="async"></a>
                <p class="site-footer__claim"><?= e(t('footer.claim')) ?></p>
                <p class="site-footer__sub"><?= e(t('footer.sub')) ?></p>
            </div>

            <nav aria-labelledby="footer-pages">
                <p class="site-footer__label" id="footer-pages"><?= e(t('footer.pages')) ?></p>
                <ul>
                    <li><a href="<?= url('/projekte/') ?>"><?= e(t('nav.projects')) ?></a></li>
                    <li><a href="<?= url('/leistungen/') ?>"><?= e(t('nav.services')) ?></a></li>
                    <li><a href="<?= url('/ueber-mich/') ?>"><?= e(t('nav.about')) ?></a></li>
                    <li><a href="<?= url('/kontakt/') ?>"><?= e(t('nav.contact')) ?></a></li>
                </ul>
            </nav>

            <nav aria-labelledby="footer-legal">
                <p class="site-footer__label" id="footer-legal"><?= e(t('footer.legal')) ?></p>
                <ul>
                    <li><a href="<?= url('/impressum/') ?>"><?= e(t('footer.imprint')) ?></a></li>
                    <li><a href="<?= url('/datenschutz/') ?>"><?= e(t('footer.privacy')) ?></a></li>
                    <li><a href="<?= url('/barrierefreiheit/') ?>"><?= e(t('footer.a11y')) ?></a></li>
                </ul>
            </nav>

            <nav aria-labelledby="footer-more">
                <p class="site-footer__label" id="footer-more"><?= e(t('footer.more')) ?></p>
                <ul>
                    <li><a href="<?= url('/leichte-sprache/') ?>"><?= e(t('nav.easy')) ?></a></li>
                    <li><a href="/playground/library/"><?= e(t('footer.library')) ?></a></li>
                    <li><a href="<?= e(SITE_LINKEDIN) ?>">LinkedIn</a></li>
                    <li><a href="<?= e(SITE_GITHUB) ?>">GitHub</a></li>
                </ul>
            </nav>
        </div>

        <div class="site-footer__bottom">
            <p><?= e(t('footer.copy', ['year' => date('Y')])) ?></p>
            <p><?= e(t('footer.built')) ?><?= todo('Lighthouse-Werte', ' · ') ?><?= todo('WCAG-2.2-AA-Prüfung bestätigt', ' · ') ?></p>
        </div>
    </div>
</footer>

<script type="module" src="<?= asset('site.js') ?>"></script>
</body>

</html>
