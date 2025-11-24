<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Impressum / Imprint',
    'desc'  => 'Mandatory legal notice pursuant to German law (Sec. 5 TMG / Sec. 18 MStV).',
    'og_image' => '',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);
$isEn = is_en();
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main class="page-wrapper" id="startMainContent">

        <!-- ### BREADCRUMB ### -->
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <!-- ### STAGE ### -->
        <section class="px-3 px-md-0 py-2 pt-md-5 pb-md-0">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h1>
                            <?php if ($sprache === 'en'): ?>
                                <span class="font-accent">Imprint</span>
                            <?php else: ?>
                                <span class="font-accent">Impressum</span>
                            <?php endif; ?>
                        </h1>
                    </div>
                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-50-md">
                        <img src="/assets/img/privacy/undraw_personal-data_a1n8.svg" alt="<?php echo ($sprache === 'en' ? 'Imprint' : 'Impressum'); ?>" width="500" height="500" class="img-fluid">
                    </div>
                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-18 lh-1-5 my-3"><em>
                                <?php if ($sprache === 'en'): ?>
                                    Mandatory legal notice pursuant to German law<br>
                                    (Sec. 5 TMG / Sec. 18 MStV).
                                <?php else: ?>
                                    Gesetzlich erforderliche Anbieterkennzeichnung<br>
                                    (gemäß § 5 TMG / § 18 MStV).
                                <?php endif; ?>
                            </em></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ### IMPRESSUM ### -->
        <section class="px-3 px-md-0 mt-100-md">
            <div class="container">

                <!-- Adresse -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Address
                            <?php else: ?>
                                Adresse
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            WENG.EU<br>
                            10999 Berlin<br>
                            <?php if ($sprache === 'en'): ?>
                                Germany
                            <?php else: ?>
                                Deutschland
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                Represented by:<br>
                            <?php else: ?>
                                Vertreten durch:<br>
                            <?php endif; ?>
                            Karsten Weng
                        </p>
                    </div>
                </div>

                <!-- Kontakt -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Contact
                            <?php else: ?>
                                Kontakt
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            +49 176 48580058<br>
                            info@weng.eu<br>
                        </p>
                    </div>
                </div>

                <!-- USt-IdNr. -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                VAT ID
                            <?php else: ?>
                                USt-IdNr.
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                VAT ID: DE418166191
                            <?php else: ?>
                                USt-IdNr.: DE418166191
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- EU-Streitbeilegung -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                EU Dispute Resolution
                            <?php else: ?>
                                Streitbeilegung der EU
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                The European Commission provides a platform for Online Dispute Resolution (ODR platform): <a href="https://ec.europa.eu/consumers/odr" class="text-link" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a>. You can find WENG.EU's email address above in the imprint.
                            <?php else: ?>
                                Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS-Plattform) bereit: <a href="https://ec.europa.eu/consumers/odr" class="text-link" target="_blank" rel="noopener noreferrer">https://ec.europa.eu/consumers/odr</a>. Die E-Mail-Adresse von WENG.EU finden Sie oben im Impressum.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Verbraucherschlichtung -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Consumer Arbitration
                            <?php else: ?>
                                Verbraucherschlichtung
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                Dispute resolution proceedings before a consumer arbitration board: WENG.EU is neither willing nor obliged to participate in dispute resolution proceedings before a consumer arbitration board.
                            <?php else: ?>
                                Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle: WENG.EU ist weder bereit noch verpflichtet, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Haftungsausschluss -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Liability for Content
                            <?php else: ?>
                                Haftung für Inhalte
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                As a service provider, WENG.EU is responsible for our own content on these pages in accordance with general laws. WENG.EU is not obliged to monitor transmitted or stored third-party information or to investigate circumstances indicating illegal activity. Obligations to remove or block the use of information under general laws remain unaffected. Liability in this respect is only possible from the time of knowledge of a specific infringement. Upon becoming aware of such legal violations, WENG.EU will remove these contents immediately.
                            <?php else: ?>
                                Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Haftung für Links -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Liability for Links
                            <?php else: ?>
                                Haftung für Links
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                WENG.EU's website contains links to external third-party websites, on whose contents WENG.EU has no influence. Therefore, WENG.EU cannot assume any liability for these external contents. The respective provider or operator of the pages is always responsible for the content of the linked pages. Illegal contents were not recognizable at the time of linking. However, a permanent content control of the linked pages is not reasonable without concrete indications of a violation. If WENG.EU becomes aware of any infringements, such links will be removed immediately.
                            <?php else: ?>
                                Die Website von WENG.EU enthält Links zu externen Websites Dritter, auf deren Inhalte WENG.EU keinen Einfluss hat. Deshalb kann WENG.EU für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden derartige Links umgehend entfernt.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Urheberrecht -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Copyright
                            <?php else: ?>
                                Urheberrecht
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                The contents and works on these pages created by the site operator are subject to German copyright law. Duplication, processing, distribution, or any form of commercialization of such material beyond the scope of copyright law shall require the prior written consent of the respective author or creator. Downloads and copies of this site are permitted for private, non-commercial use only. Insofar as the content on this site was not created by the operator, the copyrights of third parties are respected and such content is marked accordingly.
                            <?php else: ?>
                                Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechts bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet und entsprechende Inhalte gekennzeichnet.
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                The logo design was created with the kind support of Till Teenck.
                            <?php else: ?>
                                Das Logo-Design wurde mit freundlicher Unterstützung von Till Teenck erstellt.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Hosting -->
                <div class="row mb-5">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">Hosting</h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                This website is hosted by STRATO GmbH (Germany). A processing agreement pursuant to Art. 28 GDPR is in place.
                            <?php else: ?>
                                Diese Website wird von der STRATO GmbH (Deutschland) gehostet. Ein Auftragsverarbeitungsvertrag gemäß Art. 28 DSGVO ist abgeschlossen.
                            <?php endif; ?>
                        </p>
                        <p><small>
                                <?php if ($sprache === 'en'): ?>
                                    Last updated: <?php echo date('F j, Y'); ?>
                                <?php else: ?>
                                    Stand: <?php echo date('d.m.Y'); ?>
                                <?php endif; ?>
                            </small></p>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>