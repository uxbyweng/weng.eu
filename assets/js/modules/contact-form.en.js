// Dieses Modul entspricht 1:1 dem deutschen Modul, nur die Texte sind auf Englisch.
// Änderungen bitte in beiden Dateien durchführen!

let initDone = false;

export function initContactForm() {
    if (initDone) return;
    initDone = true;

    const $ = window.jQuery;
    if (!$) return;

    const $form = $("#contact-form");
    if (!$form.length) return;

    $form.attr("novalidate", "novalidate");
    const $messages = $form.find(".messages");
    const $submitBtn = $form.find('[type="submit"]');
    const $name = $form.find('[name="name"]');
    const $email = $form.find('[name="email"]');
    const $privacy = $form.find('[name="privacy"]');
    const $messageFld = $form.find('[name="message"]');

    // --- Helper für Feldfehler ---
    function setErr($field, msg) {
        const id = $field.attr("id") || "f_" + Math.random().toString(36).slice(2);
        $field.attr("id", id).attr("aria-invalid", "true");
        $field.next(".invalid-feedback").remove();
        const $fb = $('<div class="invalid-feedback"></div>')
            .text(msg)
            .attr("id", id + "_err");
        $field.after($fb).addClass("is-invalid");
    }
    function clearErrors() {
        $form.find("[aria-invalid='true']").removeAttr("aria-invalid");
        $form.find(".invalid-feedback").remove();
        $form.find(".is-invalid").removeClass("is-invalid");
    }

    // --- LIVE VALIDATION für message (ohne initiale Warnung)
    const $message = $form.find('[name="message"]');
    const linkRe = /\b(?:https?:\/\/|www\.)\S+/i;
    let messageTouched = false;

    function validateMessageField(evt) {
        const el = $message[0];
        if (!el) return;

        const val = (el.value || "").trim();
        const words = val.length ? val.split(/\s+/).filter(Boolean) : [];

        if (evt && (evt.type === "input" || evt.type === "blur" || evt.type === "change")) {
            messageTouched = true;
        }

        // Nur prüfen, wenn nicht leer – 'required' greift beim Submit
        if (val.length > 0) {
            if (linkRe.test(val)) {
                el.setCustomValidity("Links are not allowed in the message.");
            } else if (words.length < 3) {
                el.setCustomValidity("Please write at least 3 words.");
            } else {
                el.setCustomValidity("");
            }
        } else {
            el.setCustomValidity("");
        }

        const isValid = el.checkValidity();
        const shouldDecorate = messageTouched || val.length > 0;

        if (shouldDecorate) {
            $message.toggleClass("is-invalid", !isValid);
            $message.toggleClass("is-valid", isValid);
        } else {
            $message.removeClass("is-invalid is-valid");
        }
    }

    $message.on("input blur change", validateMessageField);
    validateMessageField(); // initial (zeigt nichts, solange leer & unberührt)

    // --- Submit-Handler
    $form.on("submit", function (e) {
        e.preventDefault();

        $messages.empty();
        clearErrors();

        const $name = $form.find('[name="name"]');
        const $email = $form.find('[name="email"]');
        const $messageField = $form.find('[name="message"]');
        const $privacy = $form.find('[name="privacy"]');

        const nameVal = ($name.val() || "").trim();
        const emailVal = ($email.val() || "").trim();
        const messageVal = ($messageField.val() || "").trim();
        const privacyVal = $privacy.prop("checked");

        let hasErr = false;

        if (!nameVal) {
            setErr($name, "Please enter your name.");
            hasErr = true;
        }

        if (!emailVal) {
            setErr($email, "Please enter your email address.");
            hasErr = true;
        } else {
            const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRe.test(emailVal)) {
                setErr($email, "Please enter a valid email address.");
                hasErr = true;
            }
        }

        if (!messageVal) {
            setErr($messageField, "Please leave a message.");
            hasErr = true;
        } else {
            if (messageVal.split(/\s+/).filter(Boolean).length < 3) {
                setErr($messageField, "Please write at least 3 words.");
                hasErr = true;
            }
            if (/\bhttps?:\/\/\S+/i.test(messageVal)) {
                setErr($messageField, "Links are not allowed in the message.");
                hasErr = true;
            }
        }

        if (!privacyVal) {
            const $grp = $form.find(".form-group.privacy");
            $grp.find(".invalid-feedback").remove();
            $grp.append('<div class="invalid-feedback d-block">Please accept the privacy policy.</div>');
            hasErr = true;
        }

        if (hasErr) {
            $messages.html('<div class="alert alert-danger" role="alert">Please check your input.</div>');
            return;
        }

        $submitBtn.prop("disabled", true);

        $.ajax({
            type: "POST",
            url: $form.attr("action"), // simpel & relativ
            data: $form.serialize(),
            dataType: "json", // wie früher
        })
            .done(function (data) {
                const type = (data && (data.type || (data.ok ? "success" : "danger"))) || "danger";
                const text = (data && (data.message || (data.ok ? "Sent." : "Please check your input."))) || "Please check your input.";
                $messages.html('<div class="alert alert-' + type + '" role="alert">' + text + "</div>");

                if (data && data.fieldErrors) {
                    Object.entries(data.fieldErrors).forEach(function ([name, msg]) {
                        const $field = $form.find('[name="' + name + '"]');
                        if ($field.length) setErr($field, msg);
                    });
                }
                if (data && data.ok) {
                    $form.find(".form-group, button").remove();
                } else {
                    $submitBtn.prop("disabled", false);
                }
            })
            .fail(function (xhr) {
                // kompakt halten, aber nachvollziehbar
                console.error("[contact-form] AJAX", xhr.status, (xhr.responseText || "").slice(0, 200));
                $messages.html('<div class="alert alert-danger" role="alert">Network or server error. Please try again.</div>');
                $submitBtn.prop("disabled", false);
            });
    });
}
