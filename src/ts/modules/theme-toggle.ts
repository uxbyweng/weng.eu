type Theme = "light" | "dark";

const STORAGE_KEY = "theme";

function isTheme(value: string | null): value is Theme {
    return value === "light" || value === "dark";
}

/** Dunkelmodus-Schalter (Button#toggleTheme). Das Icon wechselt per CSS anhand von data-bs-theme. */
export function initThemeToggle(): void {
    const html = document.documentElement;
    const button = document.getElementById("toggleTheme");
    if (!button) return;

    function applyTheme(theme: Theme): void {
        const isDark = theme === "dark";
        html.setAttribute("data-bs-theme", theme);
        button?.setAttribute("aria-pressed", String(isDark));
        button?.setAttribute("aria-label", (isDark ? button.dataset.labelDeactivate : button.dataset.labelActivate) ?? "");
    }

    button.addEventListener("click", () => {
        const next: Theme = html.getAttribute("data-bs-theme") === "dark" ? "light" : "dark";
        try {
            localStorage.setItem(STORAGE_KEY, next);
        } catch {
            // Speichern nicht möglich (z. B. privater Modus) – Wechsel gilt trotzdem für diese Seite
        }
        applyTheme(next);
    });

    let stored: string | null = null;
    try {
        stored = localStorage.getItem(STORAGE_KEY);
    } catch {
        // ignorieren
    }
    const prefersDark = window.matchMedia?.("(prefers-color-scheme: dark)").matches;
    applyTheme(isTheme(stored) ? stored : prefersDark ? "dark" : "light");
}
