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
        <section class="px-3 px-md-0 py-2 py-md-5">
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

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/privacy/undraw_personal-data_a1n8.svg" alt="<?php echo ($sprache === 'en' ? 'Imprint' : 'Impressum'); ?>" width="500" height="500" class="img-fluid">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-5 my-3">
                            <?php if ($sprache === 'en'): ?>
                                <em>Mandatory legal notice pursuant to German law (Sec. 5 TMG / Sec. 18 MStV).</em>
                            <?php else: ?>
                                <em>Gesetzlich erforderliche Anbieterkennzeichnung (gemäß § 5 TMG / § 18 MStV).</em>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ### IMPRESSUM ### -->
        <section class="px-3 px-md-0">
            <div class="container">

                <?php if ($sprache === 'en'): ?>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">1. Service Provider (Sec. 5 TMG)</h2>
                    <p><strong>Karsten Weng</strong></p>
                    <p>10999 Berlin</p>
                    <p>Germany</p>
                    <p><a href="mailto:info@weng.eu" class="text-link">info@weng.eu</a></p>
                    <p>VAT ID : DE418166191</p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">2. Editorially Responsible (Sec. 18 (2) MStV)</h2>
                    <p><strong>Karsten Weng</strong></p>
                    <p>10999 Berlin</p>
                    <p>Germany</p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">3. Dispute Resolution / ODR</h2>
                    <p>
                        The European Commission provides a platform for Online Dispute Resolution (ODR):<br>
                        <a href="https://ec.europa.eu/consumers/odr" class="text-link" target="_blank" rel="noopener noreferrer">ec.europa.eu/consumers/odr</a>.<br>
                        We are neither obliged nor willing to participate in dispute resolution proceedings before a consumer arbitration board.
                    </p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">4. Liability for Contents</h2>
                    <p>
                        As a service provider we are responsible for our own content on these pages in accordance with general laws. We are not obliged to monitor transmitted or stored third-party information or to investigate circumstances indicating illegal activity. Obligations to remove or block the use of information under general laws remain unaffected. Liability in this respect is only possible from the time of knowledge of a specific infringement. Upon becoming aware of such legal violations, we will remove these contents immediately.
                    </p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">5. Liability for Links</h2>
                    <p>
                        Our offer contains links to external third-party websites, on whose contents we have no influence. Therefore, we cannot assume any liability for these external contents. The respective provider or operator of the pages is always responsible for the content of the linked pages. Illegal contents were not recognizable at the time of linking. However, a permanent content control of the linked pages is not reasonable without concrete indications of a violation. If we become aware of any infringements, we will remove such links immediately.
                    </p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">6. Copyright</h2>
                    <p>
                        The contents and works on these pages created by the site operator are subject to German copyright law. Duplication, processing, distribution, or any form of commercialization of such material beyond the scope of copyright law shall require the prior written consent of the respective author or creator. Downloads and copies of this site are permitted for private, non-commercial use only. Insofar as the content on this site was not created by the operator, the copyrights of third parties are respected and such content is marked accordingly.
                    </p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">7. Hosting</h2>
                    <p>
                        This website is hosted by STRATO AG (Germany). A processing agreement pursuant to Art. 28 GDPR is in place.
                    </p>

                    <p class="mb-4"><small>Last updated: <?php echo date('F j, Y'); ?></small></p>

                <?php else: ?>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        1. Anbieter (§ 5 TMG)
                    </h2>
                    <p>
                        <strong>Karsten Weng</strong><br>
                        10999 Berlin<br>
                        Deutschland
                    </p>
                    <p>
                        <a href="mailto:info@weng.eu" class="text-link">info@weng.eu</a><br>
                        USt-IdNr.: DE418166191
                    </p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">2. Verantwortlich i.S.d. § 18 Abs. 2 MStV</h2>
                    <p>
                        <strong>Karsten Weng</strong><br>
                        10999 Berlin<br>
                        Deutschland
                    </p>

                    <hr class="my-4">

                    <h2 class="font-nidorina fs-30 pb-3">
                        3. Streitbeilegung / ODR-Plattform
                    </h2>
                    <p>
                        Die Europäische Kommission stellt eine Plattform zur Online-Streitbeilegung (OS) bereit:<br>
                        <a href="https://ec.europa.eu/consumers/odr" class="text-link" target="_blank" rel="noopener noreferrer">ec.europa.eu/consumers/odr</a>.<br>
                        weng.eu ist nicht verpflichtet und nicht bereit, an Streitbeilegungsverfahren vor einer Verbraucherschlichtungsstelle teilzunehmen.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">4. Haftung für Inhalte</h2>
                    <p>
                        Als Diensteanbieter ist weng.eu gemäß den allgemeinen Gesetzen für eigene Inhalte auf diesen Seiten verantwortlich. weng.eu ist jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen entfernt weng.eu diese Inhalte umgehend.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">5. Haftung für Links</h2>
                    <p>
                        Das Angebot von weng.eu enthält Links zu externen Websites Dritter, auf deren Inhalte weng.eu keinen Einfluss hat. Deshalb kann weng.eu für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber verantwortlich. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen entfernt weng.eu derartige Links umgehend.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">6. Urheberrecht</h2>
                    <p>
                        Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechts bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet und entsprechende Inhalte gekennzeichnet.
                    </p>
                    <p>
                        Das Logo-Design ist mit freundlicher Unterstützung von <a href="https://teenck.design/" class="text-link" rel="noopener" target="_blank">Till Teenck</a> entstanden.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">7. Hosting</h2>
                    <p>
                        Diese Website wird bei der STRATO GmbH (Deutschland) gehostet. Es besteht ein Auftragsverarbeitungsvertrag nach Art. 28 DSGVO.
                    </p>

                    <p class="my-5"><small>Stand: <?php echo date('d.m.Y'); ?></small></p>

                <?php endif; ?>
            </div>
        </section>

    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>