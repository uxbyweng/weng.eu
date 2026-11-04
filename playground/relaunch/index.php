<?php
// Vorschau des neuen Designsystems (nur main.css, ohne Bootstrap). Wird beim Relaunch in die Pattern Library überführt.
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.php';
$dark = ($_GET['theme'] ?? '') === 'dark';
?>
<!doctype html>
<html lang="de" data-bs-theme="<?= $dark ? 'dark' : 'light' ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex">
    <title>Relaunch – Designsystem</title>
    <link rel="stylesheet" href="<?= asset('main.css') ?>">
</head>

<body>
    <a class="skip-link" href="#inhalt">Zum Inhalt springen</a>

    <main id="inhalt">
        <header class="page-head wrap">
            <p class="eyebrow">Designsystem · Vorschau</p>
            <h1>Design und Code. Seit über 20 Jahren.</h1>
            <p class="lead">Dies ist die Vorschau der neuen Basis: Tokens, Typografie, Buttons, Chips und Bänder. <a href="?theme=<?= $dark ? 'light' : 'dark' ?>">Zum <?= $dark ? 'hellen' : 'dunklen' ?> Theme wechseln</a>.</p>
        </header>

        <section class="section">
            <div class="wrap">
                <h2>Buttons</h2>
                <p style="display:flex;flex-wrap:wrap;gap:16px;margin-top:24px">
                    <a class="button" href="#">Projekte ansehen</a>
                    <a class="button button--secondary" href="#">Kontakt aufnehmen</a>
                    <button class="button" type="button" disabled>Deaktiviert</button>
                </p>
            </div>
        </section>

        <section class="section section--surface">
            <div class="wrap">
                <h2>Chips &amp; Badges</h2>
                <ul class="chip-list" style="margin-top:24px">
                    <li class="chip">PHP</li>
                    <li class="chip chip--strong">täglich</li>
                    <li class="chip chip--outline">sicher</li>
                    <li class="chip chip--learning">lerne ich gerade</li>
                </ul>
                <p style="display:flex;flex-wrap:wrap;gap:12px;margin-top:24px">
                    <span class="badge badge--client">Kundenprojekt</span>
                    <span class="badge badge--employed">Festanstellung</span>
                    <span class="badge badge--own">Eigenprojekt</span>
                </p>
            </div>
        </section>

        <section class="section">
            <div class="wrap">
                <h2>Karten &amp; Ergebnis</h2>
                <div class="grid" style="margin-top:24px">
                    <article class="card">
                        <span class="badge badge--client">Kundenprojekt</span>
                        <h3 style="margin-block:12px">Beispielkarte</h3>
                        <p class="result">Ergebniszeile mit Marker</p>
                    </article>
                    <article class="card">
                        <h3 style="margin-bottom:12px">Zweite Karte</h3>
                        <p>Fließtext in Noto Sans, 17&nbsp;px, Zeilenhöhe 1,6.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section section--band">
            <div class="wrap">
                <p class="eyebrow">Erfahrung</p>
                <h2>Erfahrung, die sich nachprüfen lässt</h2>
                <p class="lead" style="margin-top:16px">Dunkles Band mit Petrol-Hintergrund.</p>
            </div>
        </section>
    </main>
</body>

</html>
