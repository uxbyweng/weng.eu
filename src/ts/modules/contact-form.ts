// Kontaktformular (DE/EN):
// - Live-Validierung des Nachrichtenfeldes (mind. 3 Wörter, keine Links)
// - Eigene Fehlermeldungen pro Feld (unter dem Feld)
// - Absenden per fetch (bleibt auf der Seite, zeigt die Server-Antwort oben im Formular)

interface Texts {
    name: string;
    emailMissing: string;
    emailInvalid: string;
    messageMissing: string;
    messageTooShort: string;
    messageNoLinks: string;
    checkInput: string;
    sent: string;
    networkError: string;
}

const TEXTS: Record<"de" | "en", Texts> = {
    de: {
        name: "Bitte einen Namen eingeben.",
        emailMissing: "Bitte eine E-Mail-Adresse eingeben.",
        emailInvalid: "Bitte eine gültige E-Mail-Adresse eingeben.",
        messageMissing: "Bitte eine Nachricht hinterlassen.",
        messageTooShort: "Bitte mindestens 3 Wörter schreiben.",
        messageNoLinks: "Links sind in der Nachricht nicht erlaubt.",
        checkInput: "Bitte Eingaben überprüfen.",
        sent: "Gesendet.",
        networkError: "Netzwerk- oder Serverfehler. Bitte erneut versuchen.",
    },
    en: {
        name: "Please enter your name.",
        emailMissing: "Please enter your email address.",
        emailInvalid: "Please enter a valid email address.",
        messageMissing: "Please leave a message.",
        messageTooShort: "Please write at least 3 words.",
        messageNoLinks: "Links are not allowed in the message.",
        checkInput: "Please check your input.",
        sent: "Sent.",
        networkError: "Network or server error. Please try again.",
    },
};

/** Antwort von /kontakt/kontakt.{de,en}.php */
interface ContactResponse {
    ok?: boolean;
    type?: string;
    message?: string;
    fieldErrors?: Record<string, string>;
}

const ALERT_TYPES = ["success", "danger", "warning", "info"] as const;
type AlertType = (typeof ALERT_TYPES)[number];

const EMAIL_RE = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const LINK_RE = /\b(?:https?:\/\/|www\.)\S+/i;

let initDone = false;

function countWords(value: string): number {
    return value.split(/\s+/).filter(Boolean).length;
}

function toAlertType(type: string | undefined, ok: boolean | undefined): AlertType {
    return ALERT_TYPES.find(t => t === type) ?? (ok ? "success" : "danger");
}

export function initContactForm(): void {
    // Schutz vor doppelter Initialisierung
    if (initDone) return;
    initDone = true;

    const form = document.querySelector<HTMLFormElement>("#contact-form");
    if (!form) return;

    const t = TEXTS[document.documentElement.lang.toLowerCase().startsWith("en") ? "en" : "de"];

    // Native Browser-Validierung (Tooltips) ausschalten, damit wir die Fehlermeldungen selbst steuern.
    form.noValidate = true;

    const messages = form.querySelector<HTMLElement>(".messages");
    const submitBtn = form.querySelector<HTMLButtonElement>('[type="submit"]');
    const nameField = form.querySelector<HTMLInputElement>('[name="name"]');
    const emailField = form.querySelector<HTMLInputElement>('[name="email"]');
    const messageField = form.querySelector<HTMLTextAreaElement>('[name="message"]');

    /** Erfolg als role="status" (höflich), Fehler als role="alert" (sofort vorgelesen). */
    function showAlert(type: AlertType, html: string): void {
        if (!messages) return;
        const role = type === "success" || type === "info" ? "status" : "alert";
        messages.innerHTML = `<div class="form-status form-status--${type}" role="${role}">${html}</div>`;
    }

    function setError(field: HTMLElement, msg: string): void {
        // Jedes Feld braucht eine ID, damit die Fehlermeldung per aria-describedby verbunden werden kann.
        if (!field.id) field.id = `f_${Math.random().toString(36).slice(2)}`;
        field.setAttribute("aria-invalid", "true");

        // Alte Fehlermeldung entfernen, damit es keine Duplikate gibt.
        if (field.nextElementSibling?.classList.contains("field-error")) field.nextElementSibling.remove();

        const feedback = document.createElement("div");
        feedback.className = "field-error";
        feedback.id = `${field.id}_err`;
        feedback.textContent = msg;
        field.setAttribute("aria-describedby", feedback.id);
        field.after(feedback);
    }

    function clearErrors(): void {
        for (const el of form?.querySelectorAll("[aria-invalid='true']") ?? []) {
            el.removeAttribute("aria-invalid");
            el.removeAttribute("aria-describedby");
        }
        for (const el of form?.querySelectorAll(".field-error") ?? []) el.remove();
    }

    // --- Live-Validierung für das Nachrichtenfeld (zeigt erst nach Interaktion etwas an) ---
    let messageTouched = false;

    function validateMessageField(evt?: Event): void {
        if (!messageField) return;
        const val = messageField.value.trim();

        if (evt && ["input", "blur", "change"].includes(evt.type)) messageTouched = true;

        // Eigene Fehler nur, wenn etwas im Feld steht (sonst greift beim Absenden "required").
        if (val && LINK_RE.test(val)) {
            messageField.setCustomValidity(t.messageNoLinks);
        } else if (val && countWords(val) < 3) {
            messageField.setCustomValidity(t.messageTooShort);
        } else {
            messageField.setCustomValidity("");
        }

        const isValid = messageField.checkValidity();
        // Zustand nur anzeigen, wenn das Feld berührt wurde oder schon Inhalt hat (z. B. Autofill).
        if ((messageTouched || val) && !isValid) {
            messageField.setAttribute("aria-invalid", "true");
        } else if (!messageField.nextElementSibling?.classList.contains("field-error")) {
            // Eine vom Absenden gesetzte Fehlermeldung bleibt bis zum nächsten Versuch stehen.
            messageField.removeAttribute("aria-invalid");
        }
    }

    for (const type of ["input", "blur", "change"]) messageField?.addEventListener(type, validateMessageField);
    validateMessageField();

    // --- Absenden ---
    form.addEventListener("submit", async e => {
        e.preventDefault();
        if (messages) messages.textContent = "";
        clearErrors();

        const nameVal = nameField?.value.trim() ?? "";
        const emailVal = emailField?.value.trim() ?? "";
        const messageVal = messageField?.value.trim() ?? "";
        let hasError = false;

        // Einfache Client-Checks (spiegeln grob die Server-Checks)
        if (nameField && !nameVal) {
            setError(nameField, t.name);
            hasError = true;
        }

        if (emailField) {
            if (!emailVal) {
                setError(emailField, t.emailMissing);
                hasError = true;
            } else if (!EMAIL_RE.test(emailVal)) {
                setError(emailField, t.emailInvalid);
                hasError = true;
            }
        }

        if (messageField) {
            if (!messageVal) {
                setError(messageField, t.messageMissing);
                hasError = true;
            } else {
                if (countWords(messageVal) < 3) {
                    setError(messageField, t.messageTooShort);
                    hasError = true;
                }
                if (/\bhttps?:\/\/\S+/i.test(messageVal)) {
                    setError(messageField, t.messageNoLinks);
                    hasError = true;
                }
            }
        }

        if (hasError) {
            showAlert("danger", t.checkInput);
            return;
        }

        if (submitBtn) submitBtn.disabled = true; // Mehrfachklicks verhindern

        try {
            const body = new URLSearchParams();
            for (const [key, value] of new FormData(form)) {
                if (typeof value === "string") body.append(key, value);
            }

            const res = await fetch(form.action, {
                method: "POST",
                headers: { Accept: "application/json" },
                body,
            });
            if (!res.ok) throw new Error(`HTTP ${res.status}`);
            const data = (await res.json()) as ContactResponse;

            // Der Server liefert die Meldung als (eigenes) HTML, z. B. für die Erfolgsmeldung.
            showAlert(toAlertType(data.type, data.ok), data.message ?? (data.ok ? t.sent : t.checkInput));

            for (const [name, msg] of Object.entries(data.fieldErrors ?? {})) {
                const field = form.querySelector<HTMLElement>(`[name="${CSS.escape(name)}"]`);
                if (field) setError(field, msg);
            }

            if (data.ok) {
                // Bei Erfolg Felder und Button entfernen, nur die Erfolgsmeldung bleibt sichtbar.
                for (const el of form.querySelectorAll(".form-field, .form-note, .form-actions")) el.remove();
            } else if (submitBtn) {
                submitBtn.disabled = false;
            }
        } catch (err) {
            console.error("[contact-form]", err);
            showAlert("danger", t.networkError);
            if (submitBtn) submitBtn.disabled = false;
        }
    });
}
