// Dieses Modul kümmert sich um das Kontaktformular:
// - Live-Validierung des Message-Feldes (mind. 3 Wörter, keine Links)
// - Eigene Fehlermeldungen pro Feld (unter dem Feld)
// - AJAX-Submit (bleibt auf der Seite, zeigt Server-Antwort oben im Formular)

let initDone = false;

export function initContactForm() {
    // Schutz vor doppelter Initialisierung:
    // Falls das Modul versehentlich mehrfach aufgerufen wird, macht es nach dem ersten Mal nichts mehr.
    if (initDone) return;
    initDone = true;

    // jQuery muss vorhanden sein, sonst brechen wir leise ab.
    const $ = window.jQuery;
    if (!$) return;

    // Das Formular-Element mit id="contact-form" holen.
    const $form = $("#contact-form");
    if (!$form.length) return; // wenn die Seite gar kein Formular hat: einfach beenden.

    // Native Browser-Validierung (Tooltips) ausschalten,
    // damit wir die Fehlermeldungen selbst steuern.
    $form.attr("novalidate", "novalidate");

    // Praktische Referenzen auf oft genutzte Elemente/Felder.
    const $messages = $form.find(".messages"); // Box für Status-/Fehlermeldungen oben
    const $submitBtn = $form.find('[type="submit"]'); // Senden-Button
    const $name = $form.find('[name="name"]'); // Name-Feld
    const $email = $form.find('[name="email"]'); // Email-Feld
    const $privacy = $form.find('[name="privacy"]'); // Checkbox "Datenschutz"
    const $messageFld = $form.find('[name="message"]'); // Textarea "Nachricht"

    // --------------------------------------------
    // Helfer, um eine FELD-Fehlermeldung zu setzen
    // --------------------------------------------
    function setErr($field, msg) {
        // Jedes Feld braucht eine ID, damit wir die Fehlermeldung mit aria-describedby verbinden können.
        const id = $field.attr("id") || "f_" + Math.random().toString(36).slice(2);
        $field.attr("id", id).attr("aria-invalid", "true");

        // Alte Fehlermeldungen hinter dem Feld entfernen, damit es keine Duplikate gibt.
        $field.next(".invalid-feedback").remove();

        // Neue Fehlermeldung (Bootstrap-Style) erzeugen und direkt nach dem Feld einfügen.
        const $fb = $('<div class="invalid-feedback"></div>')
            .text(msg)
            .attr("id", id + "_err");
        $field.after($fb).addClass("is-invalid");
    }

    // --------------------------------------------
    // Helfer, um ALLE Feld-Fehler vor neuem Check zu löschen
    // --------------------------------------------
    function clearErrors() {
        $form.find("[aria-invalid='true']").removeAttr("aria-invalid");
        $form.find(".invalid-feedback").remove();
        $form.find(".is-invalid").removeClass("is-invalid");
    }

    // ------------------------------------------------------------
    // LIVE-VALIDIERUNG nur für das Message-Feld (sofortiges Feedback)
    // - zeigt NICHT sofort eine Warnung, sondern erst nach Interaktion
    // - Bedingungen: mindestens 3 Wörter, KEINE Links
    // ------------------------------------------------------------
    const $message = $form.find('[name="message"]');
    const linkRe = /\b(?:https?:\/\/|www\.)\S+/i; // erkennt http(s)://... oder www...

    // Merker, ob der Nutzer das Feld schon angefasst hat (getippt / verlassen).
    let messageTouched = false;

    function validateMessageField(evt) {
        const el = $message[0];
        if (!el) return;

        // Aktuellen Wert saubermachen
        const val = (el.value || "").trim();
        const words = val.length ? val.split(/\s+/).filter(Boolean) : [];

        // Sobald der Nutzer irgendwas macht (input/blur/change), gilt das Feld als "berührt".
        if (evt && (evt.type === "input" || evt.type === "blur" || evt.type === "change")) {
            messageTouched = true;
        }

        // Eigene Fehlermeldungen nur setzen, wenn überhaupt etwas im Feld steht.
        // (Sonst soll erst beim Absenden der required-Fehler greifen.)
        if (val.length > 0) {
            if (linkRe.test(val)) {
                el.setCustomValidity("Links sind in der Nachricht nicht erlaubt.");
            } else if (words.length < 3) {
                el.setCustomValidity("Bitte mindestens 3 Wörter schreiben.");
            } else {
                el.setCustomValidity(""); // alles ok
            }
        } else {
            el.setCustomValidity(""); // leer → kein Custom-Fehler hier
        }

        // Browser-Validität prüfen (beachtet auch required usw.).
        const isValid = el.checkValidity();

        // Styling (grün/rot) nur anzeigen, wenn Feld bereits "berührt" ODER schon Inhalt hat (z. B. Autofill).
        const shouldDecorate = messageTouched || val.length > 0;

        if (shouldDecorate) {
            $message.toggleClass("is-invalid", !isValid);
            $message.toggleClass("is-valid", isValid);
        } else {
            // ganz am Anfang: keinerlei Styling anzeigen
            $message.removeClass("is-invalid is-valid");
        }
    }

    // Live-Events anbinden (tippen / verlassen / ändern)
    $message.on("input blur change", validateMessageField);
    // Initial einmal prüfen: zeigt nichts, solange leer & unberührt (gut für UX).
    validateMessageField();

    // ------------------------------------------------------------
    // SUBMIT-HANDLER: wird beim Klick auf "Senden" ausgeführt
    // - Verhindert Seitenwechsel
    // - Führt Client-Validierung durch
    // - Sendet bei Erfolg via AJAX und zeigt Server-Antwort im Formular
    // ------------------------------------------------------------
    $form.on("submit", function (e) {
        e.preventDefault(); // Browser daran hindern, die Seite zu verlassen

        // Meldungsbereich leeren + alte Feldfehler entfernen
        $messages.empty();
        clearErrors();

        // Werte holen (nochmal, damit wir den aktuellen Stand haben)
        const $name = $form.find('[name="name"]');
        const $email = $form.find('[name="email"]');
        const $messageField = $form.find('[name="message"]');
        const $privacy = $form.find('[name="privacy"]');
        const nameVal = ($name.val() || "").trim();
        const emailVal = ($email.val() || "").trim();
        const messageVal = ($messageField.val() || "").trim();
        const privacyVal = $privacy.prop("checked");

        // Flag, ob Fehler gefunden wurden
        let hasErr = false;

        // --- Einfache Client-Checks (spiegeln grob die Server-Checks) ---
        if (!nameVal) {
            setErr($name, "Bitte einen Namen eingeben.");
            hasErr = true;
        }

        if (!emailVal) {
            setErr($email, "Bitte eine E-Mail-Adresse eingeben.");
            hasErr = true;
        } else {
            const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // simple Mail-Prüfung
            if (!emailRe.test(emailVal)) {
                setErr($email, "Bitte eine gültige E-Mail-Adresse eingeben.");
                hasErr = true;
            }
        }

        if (!messageVal) {
            setErr($messageField, "Bitte eine Nachricht hinterlassen.");
            hasErr = true;
        } else {
            // Mindestens 3 Wörter
            if (messageVal.split(/\s+/).filter(Boolean).length < 3) {
                setErr($messageField, "Bitte mindestens 3 Wörter schreiben.");
                hasErr = true;
            }
            // Keine Links
            if (/\bhttps?:\/\/\S+/i.test(messageVal)) {
                setErr($messageField, "Links sind in der Nachricht nicht erlaubt.");
                hasErr = true;
            }
        }

        // Datenschutz-Checkbox muss angehakt sein
        if (!privacyVal) {
            // Fehlermeldung bei der Gruppe (nicht direkt am Input)
            const $grp = $form.find(".form-group.privacy");
            $grp.find(".invalid-feedback").remove();
            $grp.append('<div class="invalid-feedback d-block">Bitte die Datenschutzerklärung akzeptieren.</div>');
            hasErr = true;
        }

        // Wenn es Client-Fehler gibt: oben eine Sammelmeldung, aber NICHT absenden.
        if (hasErr) {
            $messages.html('<div class="alert alert-danger" role="alert">Bitte Eingaben überprüfen.</div>');
            return;
        }

        // Ab hier: alles ok → Formular per AJAX abschicken
        $submitBtn.prop("disabled", true); // Button deaktivieren, damit nicht mehrfach geklickt wird

        $.ajax({
            type: "POST",
            url: $form.attr("action"), // relativer Pfad wie im HTML, simpel gehalten
            data: $form.serialize(), // alle Formulardaten als Querystring
            dataType: "json", // wir erwarten JSON vom Server
        })
            .done(function (data) {
                // Server hat geantwortet. Wir nehmen 'ok' oder 'type'/'message' aus dem JSON entgegen.
                const type = (data && (data.type || (data.ok ? "success" : "danger"))) || "danger";
                const text = (data && (data.message || (data.ok ? "Gesendet." : "Bitte Eingaben prüfen."))) || "Bitte Eingaben prüfen.";

                // Meldung oben im Formular ausgeben
                $messages.html('<div class="alert alert-' + type + '" role="alert">' + text + "</div>");

                // Falls der Server Feld-Fehler mitliefert (z. B. 'fieldErrors': { email: "...", ... })
                if (data && data.fieldErrors) {
                    Object.entries(data.fieldErrors).forEach(function ([name, msg]) {
                        const $field = $form.find('[name="' + name + '"]');
                        if ($field.length) setErr($field, msg);
                    });
                }

                // Bei Erfolg: Felder/Buttons entfernen → nur noch Erfolgsmeldung sichtbar
                if (data && data.ok) {
                    $form.find(".form-group, button").remove();
                } else {
                    // Sonst: Button wieder aktivieren, damit man korrigieren und erneut senden kann.
                    $submitBtn.prop("disabled", false);
                }
            })
            .fail(function (xhr) {
                // Serverseitiger Fehler oder Netzwerkproblem (z. B. 500, 503, CORS, Timeout)
                console.error("[contact-form] AJAX", xhr.status, (xhr.responseText || "").slice(0, 200));
                $messages.html('<div class="alert alert-danger" role="alert">Netzwerk- oder Serverfehler. Bitte erneut versuchen.</div>');
                $submitBtn.prop("disabled", false);
            });
    });
}
