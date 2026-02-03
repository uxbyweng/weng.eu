<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
$meta = [
  'title' => 'Circus Schatzinsel — Campzeitung 2018',
  'desc'  => is_en()
    ? 'Editorial design: Camp newspaper for the International Circus Camp (July 2018).'
    : 'Editorial Design: Campzeitung für das Internationale Circuscamp (Juli 2018).',
  'og_image' => '/assets/img/projects/circus-schatzinsel/og-campzeitung-2018.jpg', // anpassen
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

                    <div class="col-12 col-md-7 order-1">
                        <h1>
                            <?php if (is_en()): ?>
                           <span class="font-accent">Camp Newspaper</span> — <br>
                            International Circus Camp 2018
                            <?php else: ?>
                            <span class="font-accent">Campzeitung</span> — <br>
                             Internationales Circuscamp 2018
                            <?php endif; ?>
                        </h1>
                    </div>

                    <div class="col-12 col-md-5 order-2 order-md-3 pt-4 mt-150-md">
                        <img
                        src="/assets/img/projects/circus-schatzinsel/teaser-campzeitung-2018.jpg"
                        alt="<?php echo is_en() ? 'Teaser: Camp newspaper for the International Circus Camp 2018' : 'Teaser: Campzeitung für das Internationale Circuscamp 2018'; ?>"
                        width="500"
                        height="500"
                        class="img-fluid box-shadow"
                        loading="lazy">
                    </div>

                    <div class="col-12 col-md-7 order-3 order-md-2">
                        <p class="fs-20 lh-1-3 my-3">
                            <?php if (is_en()): ?>
                            <em>Editorial design and layout for a 16-page camp newspaper documenting an international circus camp.</em>
                            <?php else: ?>
                            <em>Editorial Design und Layout für eine 16-seitige Campzeitung zum Internationalen Circuscamp.</em>
                            <?php endif; ?>
                        </p>
                        <p>
                            <?php if (is_en()): ?>
                            The “Camp Newspaper” was created for the International Circus Camp (07–28 July 2018). The goal was to translate the camp’s spirit—community, exchange, and circus arts—into a vivid print piece with strong visual rhythm, clear typography, and photo-driven storytelling.
                            <?php else: ?>
                            Die „Campzeitung“ wurde im Anschluß an das Internationale Circuscamp (07.–28. Juli 2018) erstellt. Ziel war es, den Charakter des Camps — Gemeinschaft, Austausch und Zirkusarbeit — in ein lebendiges Printprodukt zu übersetzen: mit klarer Typografie, starkem Raster und bildgetriebenem Storytelling.
                            <?php endif; ?>
                        </p>
                        <p class="mb-0">
                            <?php if (is_en()): ?>
                            Content-wise, the newspaper highlights the camp’s vision of a shared world and documents activities and moments from the program. The result is a print-ready editorial layout designed for easy reading and a high-energy visual look.
                            <?php else: ?>
                            Inhaltlich greift die Zeitung die Vision einer gemeinsamen Welt auf und dokumentiert Programmpunkte sowie Eindrücke aus dem Camp. Ergebnis ist ein druckfertiges Editorial-Layout mit gut lesbarer Struktur und einem energiegeladenen Look.
                            <?php endif; ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>

          <!-- ### PREVIEW / PDF ### -->
  <section class="px-3 px-md-0 py-3">
    <div class="container">
      <div class="row">

        <div class="col-12 col-md-7 order-1 pe-5">

          <article>
            <div>
              <img
                src="/assets/img/projects/circus-schatzinsel/cover-campzeitung-2018.jpg"
                class="img-fluid box-shadow" width="500" height="710"
                title="<?php echo is_en() ? 'Camp Newspaper Cover— International Circus Camp 2018' : 'Campzeitung Cover — Internationales Circuscamp 2018'; ?>"
                loading="lazy">
              </img>
            </div>

            <div class="mt-3 text-center">
              <a class="wng-btn" href="/assets/pdf/20181204_campzeitung_circus_schatzinsel_dina4.pdf" target="_blank" rel="noopener">
                <?php echo is_en() ? 'Open / Download PDF' : 'PDF öffnen / herunterladen'; ?>
              </a>
            </div>
          </article>

        </div>

        <aside class="col-12 col-md-5 order-2 pt-5 pt-md-0 pe-5">

          <section class="pb-3 border-bottom">
            <h2 class="font-primary fs-20 text-uppercase"><strong><?php echo is_en() ? 'Project Info' : 'Projekt Info'; ?></strong></h2>
            <p>
              <?php if (is_en()): ?>
                Editorial design for a camp newspaper documenting an international circus camp. Focus: bold graphic language, clear reading flow, and consistent page rhythm across an A4 multi-page format.
              <?php else: ?>
                Editorial Design für eine Campzeitung, die ein internationales Zirkuscamp dokumentiert. Fokus: starke grafische Sprache, klarer Lesefluss und ein konsistenter Seitenrhythmus im mehrseitigen A4-Format.
              <?php endif; ?>
            </p>
          </section>

          <section class="py-3 border-bottom">
            <h2 class="font-primary fs-20 text-uppercase"><strong><?php echo is_en() ? 'My Contribution' : 'Mein Beitrag'; ?></strong></h2>
            <ul>
              <li><?php echo is_en() ? 'Editorial layout & typography' : 'Editorial-Layout & Typografie'; ?></li>
              <li><?php echo is_en() ? 'Grid system & consistent components' : 'Rastersystem & konsistente Komponenten'; ?></li>
              <li><?php echo is_en() ? 'Image selection, placement & visual pacing' : 'Bildauswahl, Platzierung & visuelles Tempo'; ?></li>
              <li><?php echo is_en() ? 'Print-ready PDF output (A4, multi-page)' : 'Druckfähiges PDF (A4, mehrseitig)'; ?></li>
            </ul>
          </section>

          <section class="py-3 border-bottom">
            <h2 class="font-primary fs-20 text-uppercase"><strong><?php echo is_en() ? 'Highlights' : 'Highlights'; ?></strong></h2>
            <ul>
              <li><?php echo is_en() ? 'Strong cover + modular editorial look' : 'Starkes Cover + modularer Editorial-Look'; ?></li>
              <li><?php echo is_en() ? 'Photo-driven storytelling' : 'Bildgetriebenes Storytelling'; ?></li>
              <li><?php echo is_en() ? 'Clear hierarchy for quotes, headlines, and captions' : 'Klare Hierarchie für Zitate, Headlines und Captions'; ?></li>
              <li><?php echo is_en() ? 'Consistent graphic accents across the full issue' : 'Konsistente grafische Akzente über die gesamte Ausgabe'; ?></li>
            </ul>
          </section>

          <section class="py-3 border-bottom">
            <h2 class="font-primary fs-20 text-uppercase"><strong><?php echo is_en() ? 'Tools' : 'Tools'; ?></strong></h2>
            <ul>
              <li><?php echo is_en() ? 'Layout & print production (e.g., InDesign or equivalent)' : 'Layout & Druckaufbereitung'; ?></li>
              <li><?php echo is_en() ? 'Image editing (e.g., Photoshop or equivalent)' : 'Bildbearbeitung'; ?></li>
            </ul>
            <p class="mb-0 small">
              Photoshop, Acrobat, InDesign
            </p>
          </section>

          <section class="py-3">
            <h2 class="font-primary fs-20 text-uppercase"><strong><?php echo is_en() ? 'Status & Details' : 'Status & Details'; ?></strong></h2>
            <ul>
              <li><?php echo is_en() ? 'Status: Completed' : 'Status: Abgeschlossen'; ?></li>
              <li><?php echo is_en() ? 'Format: A4, 16 pages (PDF)' : 'Format: A4, 16 Seiten (PDF)'; ?></li>
              <li><?php echo is_en() ? 'Date: 07/2018' : 'Zeitraum: 07/2018'; ?></li>
            </ul>
          </section>

        </aside>

      </div>
    </div>
  </section>


    </main>

    <?php
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
    ?>