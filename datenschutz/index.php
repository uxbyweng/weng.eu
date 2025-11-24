<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => 'WENG.EU - Privacy Policy / Datenschutzerklärung',
    'desc'  => 'Privacy Policy / Datenschutzerklärung of WENG.EU. We respect your privacy. Here you can find out which personal data we collect, for what purposes we process it, and what rights you have.',
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
                                <span class="font-accent">Privacy Policy</span>
                                <span class="fs-24">(Version 1.0)</span>
                            <?php else: ?>
                                <span class="font-accent">Datenschutzerklärung</span>
                                <span class="fs-24">(Version 1.0)</span>
                            <?php endif; ?>
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-100-md">
                        <img src="/assets/img/privacy/undraw_personal-data_a1n8.svg" alt="Personal Data" width="500" height="500" class="img-fluid">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-18 lh-1-5 my-3">
                            <?php if ($sprache === 'en'): ?>
                                <em>We respect your privacy. Below we inform you about which personal data we collect, for what purposes we process it, and what rights you have.</em>
                            <?php else: ?>
                                <em>Wir respektieren Ihre Privatsphäre. Im Folgenden informieren wir Sie darüber, welche personenbezogenen Daten wir erheben, zu welchen Zwecken wir diese verarbeiten und welche Rechte Ihnen zustehen.</em>
                            <?php endif; ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- ### PRIVACY ### -->
        <section class="px-3 px-md-0 mt-50-md">
            <div class="container">

                <!-- Allgemeine Informationen  -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                General Information
                            <?php else: ?>
                                Allgemeine Informationen
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php if ($sprache === 'en'): ?>
                            <p>
                                The following information provides you with a simple overview of what happens to your personal data when you visit this website. The term "personal data" includes all data that can be used to personally identify you. Detailed information on the subject of data protection can be found in our privacy policy, which you will find following this text.
                            </p>
                        <?php else: ?>
                            <p>
                                Die folgenden Informationen geben Ihnen einen leicht verständlichen Überblick darüber, was mit Ihren personenbezogenen Daten geschieht, wenn Sie diese Website besuchen. Der Begriff "personenbezogene Daten" umfasst alle Daten, die dazu verwendet werden können, Sie persönlich zu identifizieren. Ausführliche Informationen zum Thema Datenschutz finden Sie in unserer Datenschutzerklärung, die Sie im Anschluss an diesen Text finden.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Datenerfassung auf dieser Website -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Data Collection on This Website
                            <?php else: ?>
                                Datenerfassung auf dieser Website
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <?php if ($sprache === 'en'): ?>
                            <p>
                                The data on this website is processed by the operator of the website. You can find their contact details in the section "Information about the Responsible Party (in accordance with GDPR)" of this privacy policy.
                            </p>
                        <?php else: ?>
                            <p>
                                Die Daten auf dieser Website werden vom Betreiber der Website verarbeitet. Dessen Kontaktdaten finden Sie im Abschnitt "Informationen über den Verantwortlichen (im Sinne der DSGVO)" dieser Datenschutzerklärung.
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Externes Hosting -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                External Hosting
                            <?php else: ?>
                                Externes Hosting
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                This website is hosted by STRATO GmbH (Germany). A data processing agreement has been concluded with the provider in accordance with Art. 28 GDPR. The recipients of the data are exclusively hosting providers.
                            <?php else: ?>
                                Diese Website wird bei der STRATO GmbH (Deutschland) gehostet. Mit dem Anbieter besteht ein Vertrag zur Auftragsverarbeitung gemäß Art. 28 DSGVO. Empfänger der Daten sind ausschließlich Hosting-Provider.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Server-Logfiles -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Server Log Files
                            <?php else: ?>
                                Server-Log-Dateien
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                When you visit the website, the following data is automatically processed for technical reasons:
                            <?php else: ?>
                                Beim Aufruf der Website werden technisch bedingt folgende Daten automatisch verarbeitet:
                            <?php endif; ?>
                        </p>
                        <ul class="fs-18">
                            <?php if ($sprache === 'en'): ?>
                                <li>
                                    IP address
                                </li>
                                <li>
                                    Date and time
                                </li>
                                <li>
                                    Requested URL
                                </li>
                                <li>
                                    Referrer URL
                                </li>
                                <li>
                                    User agent
                                </li>
                            <?php else: ?>
                                <li>
                                    IP-Adresse
                                </li>
                                <li>
                                    Datum und Uhrzeit
                                </li>
                                <li>
                                    Angeforderte URL
                                </li>
                                <li>
                                    Referrer-URL
                                </li>
                                <li>
                                    User-Agent
                                </li>
                            <?php endif; ?>
                        </ul>
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                Purpose: Provision, security, and stability of the website.<br>
                                Legal basis: Art. 6 (1) (f) GDPR.
                            <?php else: ?>
                                Zweck: Bereitstellung, Sicherheit und Stabilität der Website.<br>
                                Rechtsgrundlage: Art. 6 (1) (f) DSGVO.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Verantwortliche Stelle (im Sinne der DSGVO)  -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3" id="no-tracking-en">
                            <?php if ($sprache === 'en'): ?>
                                Responsible Party<br>
                                (in accordance with GDPR)
                            <?php else: ?>
                                Verantwortliche Stelle<br>
                                (im Sinne der DSGVO)
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            WENG.EU<br>
                            10999 Berlin<br>
                            Deutschland
                        </p>
                        <p>
                            www.weng.eu
                        </p>
                        <p>
                            Vertreten durch: Karsten Weng
                        </p>
                    </div>
                </div>

                <!-- Cookies (kein Tracking) -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3" id="no-tracking-en">
                            <?php if ($sprache === 'en'): ?>
                                Cookies (no tracking)
                            <?php else: ?>
                                Cookies (kein Tracking)
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <ul class="fs-18">
                            <?php if ($sprache === 'en'): ?>
                                <li>No tracking takes place.</li>
                                <li>No analysis or marketing tools, no social media plugins, no fingerprinting techniques.</li>
                                <li>Only a technically necessary session cookie (PHPSESSID) is used to provide language and page settings during your visit. This cookie does not contain any personal data, is HttpOnly, SameSite=Lax, and is deleted when the browser is closed.</li>
                                <li>All content (including fonts) is provided exclusively from our own server.</li>
                            <?php else: ?>
                                <li>Es findet kein Tracking statt.</li>
                                <li>Keine Analyse- oder Marketing-Tools, keine Social-Media-Plugins, keine Fingerprinting-Techniken.</li>
                                <li>Eingesetzt wird ausschließlich ein technisch notwendiges Session-Cookie (PHPSESSID), um Sprache und Seiteneinstellungen während Ihres Besuchs bereitzustellen. Dieses Cookie enthält keine personenbezogenen Daten, ist HttpOnly, SameSite=Lax und wird beim Schließen des Browsers gelöscht.</li>
                                <li>Sämtliche Inhalte (inkl. Schriften) werden ausschließlich vom eigenen Server bereitgestellt.</li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- CDN (statische Dateien) -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                CDN (static data)
                            <?php else: ?>
                                CDN (statische Dateien)
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                To quickly deliver CSS and JavaScript files, we use a Content Delivery Network (CDN). Your IP address is processed in the process. No tracking or additional cookies are set.
                            <?php else: ?>
                                Zur schnellen Auslieferung von CSS- und JavaScript-Dateien nutzen wir ein Content Delivery Network (CDN). Dabei wird Ihre IP-Adresse verarbeitet. Tracking oder zusätzliche Cookies werden nicht gesetzt.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- SSL/TLS-Verschlüsselung -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                SSL/TLS Encryption
                            <?php else: ?>
                                SSL/TLS-Verschlüsselung
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                This website uses SSL/TLS encryption to ensure that transmitted data cannot be read by third parties. You can recognize an encrypted connection by "https://" in the address bar of your browser.
                            <?php else: ?>
                                Diese Website verwendet SSL/TLS-Verschlüsselung, um sicherzustellen, dass übertragene Daten nicht von Dritten gelesen werden können. Eine verschlüsselte Verbindung erkennen Sie an "https://" in der Adressleiste Ihres Browsers.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Kontaktformular -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Contact Form
                            <?php else: ?>
                                Kontaktformular
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                Data entered via the contact form will be stored for the purpose of processing your request.
                            <?php else: ?>
                                Daten, die Sie über das Kontaktformular eingeben, werden zur Bearbeitung Ihrer Anfrage gespeichert.
                            <?php endif; ?>
                        </p>
                        <ul class="fs-18">
                            <?php if ($sprache === 'en'): ?>
                                <li>
                                    Legal basis: Your consent (Art. 6 (1) (a) GDPR).
                                </li>
                                <li>
                                    Withdrawal: You can withdraw your consent at any time by sending a simple email to info@weng.eu.
                                </li>
                                <li>
                                    Data will be deleted as soon as they are no longer necessary for the purpose or you revoke your consent.
                                </li>
                                <li>
                                    No transfer to third parties will take place.
                                </li>
                                <li>
                                    Legal retention periods remain unaffected.
                                </li>
                            <?php else: ?>
                                <li>
                                    Rechtsgrundlage: Ihre Einwilligung (Art. 6 Abs. 1 lit. a DSGVO).
                                </li>
                                <li>
                                    Widerruf: jederzeit per formlose E-Mail an info@weng.eu möglich.
                                </li>
                                <li>
                                    Daten werden gelöscht, sobald sie für den Zweck nicht mehr erforderlich sind oder Sie Ihre Einwilligung widerrufen.
                                </li>
                                <li>
                                    Keine Weitergabe an Dritte.</li>
                                <li>
                                    Gesetzliche Aufbewahrungsfristen bleiben unberührt.
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <!-- Ihre Rechte -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Your Rights
                            <?php else: ?>
                                Ihre Rechte
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                You have the right at any time to:
                            <?php else: ?>
                                Sie haben jederzeit das Recht auf:
                            <?php endif; ?>
                        </p>
                        <ul class="fs-18">
                            <?php if ($sprache === 'en'): ?>
                                <li>
                                    Access your stored data
                                </li>
                                <li>
                                    Rectification of inaccurate data</li>
                                <li>
                                    Deletion or blocking of your data
                                </li>
                                <li>
                                    Objection to processing</li>
                                <li>
                                    Data portability in accordance with Art. 20 GDPR
                                </li>
                            <?php else: ?>
                                <li>
                                    Auskunft über Ihre gespeicherten Daten
                                </li>
                                <li>
                                    Berichtigung unrichtiger Daten
                                </li>
                                <li>
                                    Löschung oder Sperrung Ihrer Daten</li>
                                <li>
                                    Widerspruch gegen die Verarbeitung
                                </li>
                                <li>
                                    Datenübertragbarkeit gemäß Art. 20 DSGVO
                                </li>
                            <?php endif; ?>
                        </ul>
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                To exercise your rights, please contact the above-mentioned contact details.
                            <?php else: ?>
                                Um Ihre Rechte auszuüben, wenden Sie sich bitte an die oben genannten Kontaktdaten.
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Beschwerderecht -->
                <div class="row mb-4">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Right to Complain
                            <?php else: ?>
                                Beschwerderecht
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                In the event of a data protection violation, you have the right to lodge a complaint with the competent supervisory authority. An overview of the data protection officers can be found here:<br>
                                <a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" class="text-link" target="_blank" rel="noopener noreferrer">https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html</a>
                            <?php else: ?>
                                Im Falle eines Datenschutzverstoßes haben Sie das Recht, sich bei der zuständigen Aufsichtsbehörde zu beschweren. Eine Übersicht der Datenschutzbeauftragten finden Sie hier:<br>
                                <a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" class="text-link" target="_blank" rel="noopener noreferrer">https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html</a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>

                <!-- Automatisierte Entscheidungsfindung -->
                <div class="row mb-5">
                    <div class="col-12 col-md-3">
                        <h2 class="fs-18 pb-3">
                            <?php if ($sprache === 'en'): ?>
                                Automated Decision-making
                            <?php else: ?>
                                Automatisierte Entscheidungsfindung
                            <?php endif; ?>
                        </h2>
                    </div>
                    <div class="col-12 col-md-6">
                        <p>
                            <?php if ($sprache === 'en'): ?>
                                No automated decision-making or profiling takes place.
                            <?php else: ?>
                                Es findet keine automatisierte Entscheidungsfindung oder Profiling statt.
                            <?php endif; ?>
                        </p>
                        <p>
                            <small>
                                <?php if ($sprache === 'en'): ?>
                                    As of: September 1, 2025
                                <?php else: ?>
                                    Stand: 1. September 2025
                                <?php endif; ?>
                            </small>
                        </p>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"); ?>