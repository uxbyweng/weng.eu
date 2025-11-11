<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
    'title' => '',
    'desc'  => '',
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
                                <span class="font-accent">Accessibility Statement</span>
                            <?php else: ?>
                                <span class="font-accent">Erklärung zur Barrierefreiheit</span>
                            <?php endif; ?>
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 text-center order-2 order-md-3 p-4 mt-150-md">
                        <!--img src="/assets/img/accessibility/undraw_accessibility.svg"
               alt="<?php echo ($sprache === 'en' ? 'Accessibility visual' : 'Illustration Barrierefreiheit'); ?>"
               width="500" height="500" class="img-fluid"-->
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-5 my-3">
                            <?php if ($sprache === 'en'): ?>
                                <em>This statement explains the current level of accessibility of weng.eu, the standards we aim to meet, known issues, and how you can provide feedback.</em>
                            <?php else: ?>
                                <em>Diese Erklärung beschreibt den aktuellen Stand der Barrierefreiheit von weng.eu, die angestrebten Standards, bekannte Einschränkungen sowie Ihre Kontakt- und Rückmeldemöglichkeiten.</em>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ### ACCESSIBILITY CONTENT ### -->
        <section class="px-3 px-md-0">
            <div class="container">
                <?php if ($sprache === 'en'): ?>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Basis of this statement</h2>
                    <p>
                        The assessment is based on a self-evaluation conducted in <?php echo date('F Y', strtotime($lastUpdate)); ?> against
                        <strong>WCAG 2.2 Level AA</strong> and <strong>EN 301 549</strong>. The statement was last updated on
                        <strong><?php echo date('F j, Y', strtotime($lastUpdate)); ?></strong>.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Compliance status</h2>
                    <p>
                        The website <strong>is partially compliant</strong> with the above standards. Some content and components may not yet fully meet accessibility requirements.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Non-accessible content</h2>
                    <p>The following issues are known and scheduled for improvement:</p>
                    <ul>
                        <li>Isolated headings or lists may be visually styled but lack proper semantic markup.</li>
                        <li>Keyboard focus indication may be insufficient on some interactive elements.</li>
                        <li>Contrast of certain icons or subtle UI elements may be below WCAG thresholds.</li>
                        <li>Embedded videos (if any) may lack captions or full text alternatives.</li>
                        <li>Some PDF downloads (if present) may not be fully accessible.</li>
                    </ul>
                    <p>
                        Rationale: weng.eu is maintained as a small, continuously evolving project. We are working to address the above items in upcoming iterations.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Planned improvements</h2>
                    <ul>
                        <li>Audit and fix semantic structure (headings, lists, landmarks).</li>
                        <li>Ensure visible keyboard focus across all interactive controls.</li>
                        <li>Raise icon/graphic contrast to meet WCAG 2.2 contrast requirements.</li>
                        <li>Provide captions or transcripts for embedded media.</li>
                        <li>Offer accessible alternatives for PDFs where feasible.</li>
                    </ul>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Feedback and contact</h2>
                    <p>If you encounter accessibility barriers on this website, please contact:</p>
                    <p>
                        <strong>Karsten Weng</strong><br>
                        10999 Berlin, Germany<br>
                        E-mail: <a href="mailto:info@weng.eu" class="text-link">info@weng.eu</a>
                    </p>

                    <?php if ($isPublicBody): ?>
                        <hr class="my-4">
                        <h2 class="font-nidorina fs-30 pb-3">Enforcement procedure</h2>
                        <p>
                            If you do not receive a satisfactory response within a reasonable time, you may contact the
                            conciliation body under the German Act on Equal Opportunities for Persons with Disabilities (BGG):
                            <br>
                            Schlichtungsstelle BGG, Mauerstraße&nbsp;53, 10117 Berlin — <a href="https://www.schlichtungsstelle-bgg.de" class="text-link" target="_blank" rel="noopener">www.schlichtungsstelle-bgg.de</a>
                        </p>
                    <?php endif; ?>

                    <hr class="my-4">
                    <p class="mb-4"><small>Last updated: 09/2025</small></p>

                <?php else: ?>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Grundlage dieser Erklärung</h2>
                    <p>
                        Die Bewertung beruht auf einer Selbstprüfung aus 09/2025 anhand der <strong>WCAG&nbsp;2.2 AA</strong> sowie der <strong>EN&nbsp;301&nbsp;549</strong>. Diese Erklärung wurde zuletzt am
                        <strong>09/2025</strong> aktualisiert.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Stand der Vereinbarkeit</h2>
                    <p>
                        Die Website ist <strong>teilweise konform</strong> mit den oben genannten Anforderungen. Einzelne Inhalte und Komponenten erfüllen die Vorgaben noch nicht vollständig.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Nicht barrierefreie Inhalte</h2>
                    <p>Folgende Punkte sind bekannt und in Bearbeitung:</p>
                    <ul>
                        <li>Vereinzelt sind Überschriften/Listen visuell gestaltet, aber nicht durchgängig semantisch ausgezeichnet.</li>
                        <li>Die Tastaturfokus-Kennzeichnung ist an manchen Steuerelementen nicht deutlich genug sichtbar.</li>
                        <li>Kontraste einzelner Icons/grafischer Bedienelemente unterschreiten teils die WCAG-Grenzwerte.</li>
                        <li>Eingebettete Videos (falls vorhanden) verfügen nicht durchgängig über Untertitel bzw. Textalternativen.</li>
                        <li>Einige PDF-Dokumente (falls vorhanden) sind nicht vollständig barrierefrei.</li>
                    </ul>
                    <p>
                        Begründung: weng.eu wird als kleines, fortlaufend weiterentwickeltes Projekt gepflegt. Die genannten Punkte werden sukzessive behoben.
                    </p>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Geplante Verbesserungen</h2>
                    <ul>
                        <li>Prüfung und Korrektur der Semantik (Überschriften, Listen, Landmarks).</li>
                        <li>Sichtbarer Tastaturfokus für alle interaktiven Elemente.</li>
                        <li>Erhöhung der Kontraste von Icons/grafischen Elementen gemäß WCAG&nbsp;2.2.</li>
                        <li>Untertitel/Transkripte für eingebettete Medien bereitstellen.</li>
                        <li>Barrierefreie Alternativen zu PDFs anbieten, soweit umsetzbar.</li>
                    </ul>

                    <hr class="my-4">
                    <h2 class="font-nidorina fs-30 pb-3">Kontakt und Feedback</h2>
                    <p>Wenn Ihnen Barrieren auf dieser Website auffallen, kontaktieren Sie uns bitte:</p>
                    <p>
                        <strong>Karsten Weng</strong><br>
                        10999 Berlin, Germany<br>
                        E-Mail: <a href="mailto:info@weng.eu" class="text-link">info@weng.eu</a>
                    </p>

                    <hr class="my-4">
                    <p class="mb-4"><small>Stand: 09/2025</small></p>

                <?php endif; ?>
            </div>
        </section>

    </main>

    <?php include $_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php"; ?>