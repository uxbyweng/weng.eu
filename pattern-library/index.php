<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/lang.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/case-study.php';

// Pattern Library: zeigt die Bausteine des neuen Designs mit den echten Klassen und Funktionen. Nicht indexieren.
$tr = fn(string $de, string $en): string => is_en() ? $en : $de;

$meta = [
    'title'  => $tr('Pattern Library – Karsten Weng', 'Pattern Library – Karsten Weng'),
    'desc'   => $tr('Farben, Typografie und Bausteine dieser Website.', 'Colours, typography and building blocks of this website.'),
    'robots' => 'noindex, follow',
];
$cspNonce = $_SERVER['CSP_NONCE'] ?? null;
echo render_head($meta, $cspNonce);

// [Token, Name, Verwendung]
$swatches = [
    ['--color-accent', $tr('Akzent', 'Accent'), $tr('Eyebrows, Icons, Hover-Ränder', 'Eyebrows, icons, hover borders')],
    ['--button-bg', $tr('Button', 'Button'), $tr('Primärer Button (weiße Schrift)', 'Primary button (white text)')],
    ['--button-bg-hover', $tr('Button Hover', 'Button hover'), $tr('Primärer Button beim Überfahren', 'Primary button on hover')],
    ['--color-heading', $tr('Überschrift', 'Heading'), $tr('Überschriften, dunkles Band (hell)', 'Headings, dark band (light)')],
    ['--color-text', $tr('Text', 'Text'), $tr('Fließtext', 'Body text')],
    ['--color-muted', $tr('Text gedämpft', 'Muted text'), $tr('Nebentexte, Beschriftungen', 'Secondary text, captions')],
    ['--color-bg', $tr('Hintergrund', 'Background'), $tr('Seitenhintergrund', 'Page background')],
    ['--color-surface', $tr('Fläche', 'Surface'), $tr('Abschnitte mit Flächenton, Karten', 'Tinted sections, cards')],
    ['--color-surface-2', $tr('Fläche 2', 'Surface 2'), $tr('Chips, Eingaben', 'Chips, inputs')],
    ['--color-surface-3', $tr('Fläche 3', 'Surface 3'), $tr('Dunkles Band (dunkel)', 'Dark band (dark)')],
    ['--color-warm', $tr('Warm', 'Warm'), $tr('Kontakt-Band', 'Contact band')],
    ['--color-line', $tr('Linie', 'Line'), $tr('Trennlinien', 'Dividers')],
    ['--color-input-line', $tr('Eingabe-Rand', 'Input border'), $tr('Ränder von Formularfeldern', 'Form field borders')],
];

$icons = ['gauge', 'grid', 'sliders', 'languages', 'monitor', 'smartphone', 'eye', 'search', 'calendar', 'cart', 'map-pin', 'upload', 'lock', 'image', 'database', 'shield', 'pencil', 'pen-tool', 'book-open', 'type', 'zap'];
?>

<body>
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/header.php'; ?>

    <main id="main">
        <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/breadcrumb.php'; ?>

        <header class="page-head">
            <div class="wrap">
                <p class="eyebrow">Pattern Library</p>
                <h1 id="pl-title"><?= e($tr('Bausteine dieser Website', 'Building blocks of this website')) ?></h1>
                <p class="lead"><?= e($tr('Farben, Schrift und Komponenten des Designs, gezeigt mit den echten Klassen. Umschalten auf den dunklen Modus (Symbol oben rechts) zeigt, wie sich die Farben ändern.', 'Colours, type and components of the design, shown with the real classes. Switching to dark mode (icon at the top right) shows how the colours change.')) ?></p>
            </div>
        </header>

        <!-- Farben -->
        <section class="section pl-section" aria-labelledby="pl-colors">
            <div class="wrap">
                <h2 id="pl-colors"><?= e($tr('Farben', 'Colours')) ?></h2>
                <p class="pl-intro"><?= e($tr('Alle Farben sind CSS-Variablen (Tokens). Die Werte wechseln mit dem Modus, die Namen bleiben.', 'All colours are CSS variables (tokens). The values change with the mode, the names stay.')) ?></p>
                <div class="pl-swatches">
                    <?php foreach ($swatches as [$token, $name, $use]): ?>
                        <div class="pl-swatch">
                            <div class="pl-swatch__color" style="background: var(<?= e($token) ?>)"></div>
                            <div class="pl-swatch__meta"><strong><?= e($name) ?></strong><span class="pl-tag"><?= e($token) ?></span><?= e($use) ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Typografie -->
        <section class="section section--surface pl-section" aria-labelledby="pl-type">
            <div class="wrap">
                <h2 id="pl-type"><?= e($tr('Typografie', 'Typography')) ?></h2>
                <p class="pl-intro"><?= e($tr('Überschriften in Quicksand, Text in Noto Sans, beide lokal ausgeliefert (keine Google-Fonts-Abfrage).', 'Headings in Quicksand, text in Noto Sans, both served locally (no Google Fonts request).')) ?></p>
                <div class="pl-demo pl-demo--block">
                    <div class="pl-type">
                        <p class="eyebrow"><?= e($tr('Eyebrow, Überzeile', 'Eyebrow')) ?></p>
                        <p class="pl-h2"><?= e($tr('Überschrift 2 für Abschnitte', 'Heading 2 for sections')) ?></p>
                        <p class="pl-h3"><?= e($tr('Überschrift 3 für Karten und Schritte', 'Heading 3 for cards and steps')) ?></p>
                        <p class="lead"><?= e($tr('Lead-Text: etwas größer, für die Einleitung einer Seite.', 'Lead text: slightly larger, for the introduction of a page.')) ?></p>
                        <p><?= e($tr('Fließtext in Noto Sans, 17 Pixel, mit viel Zeilenabstand für gute Lesbarkeit.', 'Body text in Noto Sans, 17 pixels, with generous line height for readability.')) ?> <a href="#"><?= e($tr('So sieht ein Link im Text aus.', 'This is what a link in the text looks like.')) ?></a></p>
                        <p style="color: var(--color-muted); font-size: 14px"><?= e($tr('Gedämpfter Text, 14 Pixel, für Bildunterschriften und Hinweise.', 'Muted text, 14 pixels, for captions and notes.')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Buttons -->
        <section class="section pl-section" aria-labelledby="pl-buttons">
            <div class="wrap">
                <h2 id="pl-buttons">Buttons</h2>
                <p class="pl-label"><?= e($tr('Varianten', 'Variants')) ?></p>
                <div class="pl-demo">
                    <a class="button" href="#">Primary</a>
                    <a class="button button--secondary" href="#">Secondary</a>
                    <a class="button button--outline" href="#">Outline</a>
                    <a class="button button--outline button--small" href="#"><?= e($tr('Klein', 'Small')) ?></a>
                </div>
                <p class="pl-code"><span class="pl-tag">.button</span> <span class="pl-tag">.button--secondary</span> <span class="pl-tag">.button--outline</span> <span class="pl-tag">.button--small</span></p>

                <p class="pl-label"><?= e($tr('Links mit Pfeil', 'Links with arrows')) ?></p>
                <div class="pl-demo">
                    <a class="project-link" href="#"><?= e($tr('Projekt ansehen', 'View the project')) ?> <?= chevron_icon() ?></a>
                    <a class="more-link" href="#"><?= e($tr('Alle Projekte ansehen', 'View all projects')) ?> <?= chevron_icon() ?></a>
                    <a href="#"><?= e($tr('Externer Link', 'External link')) ?> <?= ext_icon() ?></a>
                </div>
                <p class="pl-code"><span class="pl-tag">.project-link</span> <span class="pl-tag">.more-link</span> <span class="pl-tag">chevron_icon()</span> <span class="pl-tag">ext_icon()</span></p>
            </div>
        </section>

        <!-- Chips und Badges -->
        <section class="section section--surface pl-section" aria-labelledby="pl-chips">
            <div class="wrap">
                <h2 id="pl-chips"><?= e($tr('Chips und Badges', 'Chips and badges')) ?></h2>
                <div class="pl-demo">
                    <ul class="chip-list">
                        <li class="chip">PHP</li>
                        <li class="chip chip--strong"><?= e($tr('Täglich', 'Daily')) ?></li>
                        <li class="chip chip--outline"><?= e($tr('Je nach Projekt', 'Depending on the project')) ?></li>
                    </ul>
                    <span class="badge badge--client"><?= e($tr('Kundenprojekt', 'Client project')) ?></span>
                    <span class="badge badge--own"><?= e($tr('Eigenes Projekt', 'Personal project')) ?></span>
                </div>
                <p class="pl-code"><span class="pl-tag">.chip</span> <span class="pl-tag">.chip--strong</span> <span class="pl-tag">.chip--outline</span> <span class="pl-tag">.badge--client</span> <span class="pl-tag">.badge--own</span></p>
            </div>
        </section>

        <!-- Karten -->
        <section class="section pl-section" aria-labelledby="pl-cards">
            <div class="wrap">
                <h2 id="pl-cards"><?= e($tr('Karten', 'Cards')) ?></h2>
                <div class="pl-grid">
                    <article class="card">
                        <h3><?= e($tr('Karte', 'Card')) ?></h3>
                        <p><?= e($tr('Rahmen, Radius und Innenabstand kommen aus den Tokens.', 'Border, radius and padding come from the tokens.')) ?></p>
                    </article>
                    <article class="card service-card">
                        <span class="service-card__num" aria-hidden="true">01</span>
                        <h3><?= e($tr('Leistungskarte', 'Service card')) ?></h3>
                        <p><?= e($tr('Mit Nummer und optionaler Werkzeugzeile.', 'With a number and an optional tools line.')) ?></p>
                        <p class="service-card__tools">Figma · HTML · CSS</p>
                    </article>
                </div>
                <p class="pl-code"><span class="pl-tag">.card</span> <span class="pl-tag">.service-card</span></p>
            </div>
        </section>

        <!-- Formularfelder -->
        <section class="section section--surface pl-section" aria-labelledby="pl-forms">
            <div class="wrap">
                <h2 id="pl-forms"><?= e($tr('Formularfelder', 'Form fields')) ?></h2>
                <div class="pl-demo pl-demo--block">
                    <div class="contact-form" style="max-width: 36em">
                        <div class="form-field">
                            <label for="pl-name"><?= e($tr('Name', 'Name')) ?> <span aria-hidden="true">*</span></label>
                            <input id="pl-name" type="text" autocomplete="off">
                        </div>
                        <div class="form-field">
                            <label for="pl-msg"><?= e($tr('Nachricht', 'Message')) ?> <span aria-hidden="true">*</span></label>
                            <textarea id="pl-msg" rows="4" autocomplete="off" aria-describedby="pl-hint"></textarea>
                            <p class="form-hint" id="pl-hint"><?= e($tr('Hilfetext direkt unter dem Feld.', 'Help text directly under the field.')) ?></p>
                        </div>
                        <p class="form-note"><?= e($tr('Hinweis unter dem Formular, z. B. zur Antwortzeit.', 'Note under the form, e.g. about the reply time.')) ?></p>
                    </div>
                </div>
                <p class="pl-code"><span class="pl-tag">.form-field</span> <span class="pl-tag">.form-hint</span> <span class="pl-tag">.form-note</span></p>
            </div>
        </section>

        <!-- Projekt-Bausteine -->
        <section class="section pl-section" aria-labelledby="pl-blocks">
            <div class="wrap">
                <h2 id="pl-blocks"><?= e($tr('Bausteine der Projektseiten', 'Building blocks of the project pages')) ?></h2>
                <p class="pl-intro"><?= e($tr('Alle Projektseiten bauen aus denselben PHP-Funktionen (includes/case-study.php). Darunter zwei davon als Vorschau.', 'All project pages are built from the same PHP functions (includes/case-study.php). Two of them below as a preview.')) ?></p>
            </div>
        </section>
        <?php
        case_glance($tr('Auf einen Blick', 'At a glance'), [
            ['icon' => 'gauge', 'value' => $tr('Schnell', 'Fast'), 'text' => $tr('Eckdaten stehen mit Icon im dunklen Band.', 'Key facts sit in the dark band with an icon.')],
            ['icon' => 'grid', 'value' => '30', 'text' => $tr('Ein Wert, ein kurzer Text.', 'One value, one short text.')],
            ['icon' => 'sliders', 'value' => $tr('Pflegbar', 'Maintainable'), 'text' => $tr('Bis zu vier Einträge nebeneinander.', 'Up to four entries side by side.')],
        ], ['PHP', 'SQLite', 'CSS'], $tr('Tech-Stack', 'Tech stack'));

        case_steps($tr('Vorgehen', 'Approach'), [
            ['t' => $tr('Erster Schritt', 'First step'), 'x' => $tr('Nummerierte Schritte auf hellgrauer Fläche, mit Überschrift und kurzem Text.', 'Numbered steps on a light grey surface, with a heading and a short text.')],
            ['t' => $tr('Zweiter Schritt', 'Second step'), 'x' => $tr('Die Nummer entsteht automatisch aus der Reihenfolge.', 'The number comes automatically from the order.')],
        ]);
        ?>

        <!-- Zitat -->
        <section class="quote" style="padding-top: var(--section-space)" aria-label="<?= e($tr('Zitat', 'Quote')) ?>">
            <figure class="wrap">
                <blockquote><p>„<?= e($tr('So sieht eine Kundenstimme aus.', 'This is what a client quote looks like.')) ?>“</p></blockquote>
                <figcaption><?= e($tr('Name, Funktion · Datum', 'Name, role · date')) ?></figcaption>
            </figure>
        </section>

        <!-- Icons -->
        <section class="section section--surface pl-section" aria-labelledby="pl-icons">
            <div class="wrap">
                <h2 id="pl-icons">Icons</h2>
                <p class="pl-intro"><?= e($tr('Linien-Icons im 24er Raster, eingebettet als SVG (case_icon()). Dazu die Pfeile chevron_icon() und ext_icon().', 'Line icons on a 24 px grid, embedded as SVG (case_icon()). Plus the arrows chevron_icon() and ext_icon().')) ?></p>
                <div class="pl-icons">
                    <?php foreach ($icons as $name): ?>
                        <div class="pl-icon"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><?= case_icon($name) ?></svg><?= e($name) ?></div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Abstände und Radien -->
        <section class="section pl-section" aria-labelledby="pl-radius">
            <div class="wrap">
                <h2 id="pl-radius"><?= e($tr('Radien', 'Radii')) ?></h2>
                <div class="pl-spacing">
                    <div><span style="border-radius: var(--radius-control)"></span>control 10</div>
                    <div><span style="border-radius: var(--radius-badge)"></span>badge 12</div>
                    <div><span style="border-radius: var(--radius-image)"></span>image 14</div>
                    <div><span style="border-radius: var(--radius-card)"></span>card 16</div>
                    <div><span style="border-radius: var(--radius-portrait)"></span>portrait 20</div>
                    <div><span style="border-radius: var(--radius-pill)"></span>pill</div>
                </div>
            </div>
        </section>
    </main>

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>
