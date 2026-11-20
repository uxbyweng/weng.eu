type Theme = "light" | "dark";

const STORAGE_KEY = "theme";

function isTheme(value: string | null): value is Theme {
    return value === "light" || value === "dark";
}

/** Dunkelmodus-Schalter (Buttons mit [data-theme-toggle]: Service-Leiste und mobiles Menü). Das Icon wechselt per CSS anhand von data-theme. */
export function initThemeToggle(): void {
    const html = document.documentElement;
    const buttons = document.querySelectorAll<HTMLButtonElement>("[data-theme-toggle]");
    if (buttons.length === 0) return;

    function applyTheme(theme: Theme): void {
        const isDark = theme === "dark";
        html.setAttribute("data-theme", theme);
        for (const button of buttons) {
            button.setAttribute("aria-pressed", String(isDark));
            button.setAttribute("aria-label", (isDark ? button.dataset.labelDeactivate : button.dataset.labelActivate) ?? "");
        }
    }

    for (const button of buttons) {
        button.addEventListener("click", () => {
            const next: Theme = html.getAttribute("data-theme") === "dark" ? "light" : "dark";
            try {
                localStorage.setItem(STORAGE_KEY, next);
            } catch {
                // Speichern nicht möglich (z. B. privater Modus) – Wechsel gilt trotzdem für diese Seite
            }
            applyTheme(next);
        });
    }

    let stored: string | null = null;
    try {
        stored = localStorage.getItem(STORAGE_KEY);
    } catch {
        // ignorieren
    }
    const prefersDark = window.matchMedia?.("(prefers-color-scheme: dark)").matches;
    applyTheme(isTheme(stored) ? stored : prefersDark ? "dark" : "light");
}
