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

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <img src="/assets/img/privacy/undraw_personal-data_a1n8.svg" alt="Personal Data" width="500" height="500" class="img-fluid">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-5 my-3">
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
        <section class="px-3 px-md-0">
            <div class="container">
                <?php if ($sprache === 'en'): ?>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        1. Responsible Party
                    </h2>
                    <p>The person responsible for data processing on this website is:</p>
                    <br>
                    <p id="nameSlotPrivacy"><strong>Name is loading ...</strong></p>
                    <p id="addressSlotPrivacy">Address is loading ...</p>
                    <p id="telSlotPrivacy">Phone is loading ...</p>
                    <p id="mailSlotPrivacy">Email is loading ...</p>
                    <br>
                    <p>
                        Further information can be found in the <a href="/impressum/" class="text-link"><u>Imprint</u></a>.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        2. Hosting
                    </h2>
                    <p>
                        This website is hosted by STRATO GmbH (Germany). A data processing agreement has been concluded with the provider in accordance with Art. 28 GDPR. The recipients of the data are exclusively hosting providers.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        3. Server log files
                    </h2>
                    <p>
                        When you visit the website, the following data is automatically processed for technical reasons:
                    </p>
                    <ul>
                        <li>IP address</li>
                        <li>Date and time</li>
                        <li>Requested URL</li>
                        <li>Referrer URL</li>
                        <li>User agent</li>
                    </ul>
                    <p>
                        Purpose: Provision, security, and stability of the website.<br>
                        Legal basis: Art. 6 (1) (f) GDPR.<br>
                        Storage period: max. 7 days, followed by deletion or anonymization.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3" id="no-tracking-en">
                        4. Cookies (no tracking)
                    </h2>
                    <ul>
                        <li>
                            No tracking takes place.
                        </li>
                        <li>
                            No analysis or marketing tools, no social media plugins, no fingerprinting techniques.
                        </li>
                        <li>
                            Only a technically necessary session cookie (PHPSESSID) is used to provide language and page settings during your visit. This cookie does not contain any personal data, is HttpOnly, SameSite=Lax, and is deleted when the browser is closed.
                        </li>
                        <li>
                            All content (including fonts) is provided exclusively from our own server.
                        </li>
                    </ul>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        5. CDN (static data)
                    </h2>
                    <p>
                        To quickly deliver CSS and JavaScript files, we use a Content Delivery Network (CDN). Your IP address is processed in the process. No tracking or additional cookies are set.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        6. SSL/TLS encryption
                    </h2>
                    <p>
                        This website uses SSL/TLS encryption to ensure that transmitted data cannot be read by third parties. You can recognize an encrypted connection by "https://" in the address bar of your browser.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        7. Contact form
                    </h2>
                    <p>
                        Data entered via the contact form will be stored for the purpose of processing your request.
                    </p>
                    <ul>
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
                    </ul>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        8. Ihre Rechte
                    </h2>
                    <p>
                        You have the right at any time to:
                    </p>
                    <ul>
                        <li>
                            Access your stored data</li>
                        <li>
                            Rectification of inaccurate data</li>
                        <li>
                            Deletion or blocking of your data</li>
                        <li>
                            Objection to processing</li>
                        <li>
                            Data portability in accordance with Art. 20 GDPR
                        </li>
                    </ul>
                    <p>
                        To exercise your rights, please contact the above-mentioned contact details.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        9. Right to complain
                    </h2>
                    <p>
                        In the event of a data protection violation, you have the right to lodge a complaint with the competent supervisory authority. An overview of the data protection officers can be found here:<br>
                        <a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" class="text-link" target="_blank" rel="noopener noreferrer">https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html</a>
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        10. Automated decision-making
                    </h2>
                    <p>
                        No automated decision-making or profiling takes place.
                    </p>
                    <hr class="my-4">
                    <p class="mb-4">
                        <small>As of: September 1, 2025</small>
                    </p>
                <?php else: ?>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        1. Verantwortliche Stelle
                    </h2>
                    <p>
                        Verantwortlich für die Datenverarbeitung auf dieser Website ist:
                    </p>
                    <br>
                    <p id="nameSlotPrivacy"><strong>Name wird geladen ...</strong></p>
                    <p id="addressSlotPrivacy">Adresse wird geladen ...</p>
                    <p id="telSlotPrivacy">Telefon wird geladen ...</p>
                    <p id="mailSlotPrivacy">E-Mail wird geladen ...</p>
                    <br>
                    <p>
                        Weitere Angaben finden Sie im <a href="/impressum/" class="text-link"><u>Impressum</u></a>.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        2. Hosting
                    </h2>
                    <p>
                        Diese Website wird bei der STRATO GmbH (Deutschland) gehostet. Mit dem Anbieter besteht ein Vertrag zur Auftragsverarbeitung gemäß Art. 28 DSGVO. Empfänger der Daten sind ausschließlich Hosting-Provider.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        3. Server-Logfiles
                    </h2>
                    <p>
                        Beim Aufruf der Website werden technisch bedingt folgende Daten automatisch verarbeitet:
                    </p>
                    <ul>
                        <li>IP-Adresse</li>
                        <li>Datum und Uhrzeit</li>
                        <li>angeforderte URL</li>
                        <li>Referrer-URL</li>
                        <li>User-Agent</li>
                    </ul>
                    <p>
                        Zweck: Bereitstellung, Sicherheit und Stabilität der Website.<br>
                        Rechtsgrundlage: Art. 6 Abs. 1 lit. f DSGVO.<br>
                        Speicherdauer: max. 7 Tage, anschließend Löschung oder Anonymisierung.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3" id="no-tracking-de">
                        4. Cookies (ohne Tracking)
                    </h2>
                    <ul>
                        <li>
                            Es findet kein Tracking statt.
                        </li>
                        <li>
                            Keine Analyse- oder Marketing-Tools, keine Social-Media-Plugins, keine Fingerprinting-Techniken.
                        </li>
                        <li>
                            Eingesetzt wird ausschließlich ein technisch notwendiges Session-Cookie (PHPSESSID), um Sprache und Seiteneinstellungen während Ihres Besuchs bereitzustellen. Dieses Cookie enthält keine personenbezogenen Daten, ist HttpOnly, SameSite=Lax und wird beim Schließen des Browsers gelöscht.
                        </li>
                        <li>
                            Sämtliche Inhalte (inkl. Schriften) werden ausschließlich vom eigenen Server bereitgestellt.
                        </li>
                    </ul>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        5. CDN (statische Dateien)
                    </h2>
                    <p>
                        Zur schnellen Auslieferung von CSS- und JavaScript-Dateien nutzen wir ein Content Delivery Network (CDN). Dabei wird Ihre IP-Adresse verarbeitet. Tracking oder zusätzliche Cookies werden nicht gesetzt.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        6. SSL-/TLS-Verschlüsselung
                    </h2>
                    <p>
                        Diese Website nutzt SSL-/TLS-Verschlüsselung, damit übermittelte Daten nicht von Dritten mitgelesen werden können. Eine verschlüsselte Verbindung erkennen Sie an „https://“ in der Adresszeile Ihres Browsers.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        7. Kontaktformular
                    </h2>
                    <p>
                        Daten, die Sie über das Kontaktformular eingeben, werden zur Bearbeitung Ihrer Anfrage gespeichert.
                    </p>
                    <ul>
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
                            Eine Weitergabe an Dritte erfolgt nicht.
                        </li>
                        <li>
                            Gesetzliche Aufbewahrungsfristen bleiben unberührt.
                        </li>
                    </ul>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        8. Ihre Rechte
                    </h2>
                    <p>
                        Sie haben jederzeit das Recht auf:
                    </p>
                    <ul>
                        <li>
                            Auskunft über Ihre gespeicherten Daten</li>
                        <li>
                            Berichtigung unrichtiger Daten</li>
                        <li>
                            Löschung oder Sperrung Ihrer Daten</li>
                        <li>
                            Widerspruch gegen die Verarbeitung</li>
                        <li>
                            Datenübertragbarkeit gemäß Art. 20 DSGVO
                        </li>
                    </ul>
                    <p>
                        Zur Ausübung Ihrer Rechte wenden Sie sich bitte an die oben genannten Kontaktdaten.
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        9. Beschwerderecht
                    </h2>
                    <p>
                        Im Falle eines datenschutzrechtlichen Verstoßes steht Ihnen ein Beschwerderecht bei der zuständigen Aufsichtsbehörde zu. Eine Übersicht der Datenschutzbeauftragten finden Sie hier:<br>
                        <a href="https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html" class="text-link" target="_blank" rel="noopener noreferrer">https://www.bfdi.bund.de/DE/Infothek/Anschriften_Links/anschriften_links-node.html</a>
                    </p>
                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">
                        10. Automatisierte Entscheidungsfindung
                    </h2>
                    <p>
                        Eine automatisierte Entscheidungsfindung oder ein Profiling findet nicht statt.
                    </p>
                    <hr class="my-4">
                    <p class="mb-4">
                        <small>Stand: 01.09.2025</small>
                    </p>
                <?php endif; ?>
            </div>
        </section>

    </main>

    <?php include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"); ?>