type Theme = "light" | "dark";

const STORAGE_KEY = "theme";

function isTheme(value: string | null): value is Theme {
    return value === "light" || value === "dark";
}

export function initThemeToggle(): void {
    const html = document.documentElement;
    const desktopBtn = document.getElementById("toggleTheme");
    const mobileBtn = document.getElementById("toggleThemeMobile");
    const icon = document.getElementById("themeIcon");
    const iconMobile = document.getElementById("themeIconMobileIcon");
    const textMobile = document.getElementById("themeTextMobile");

    if (!desktopBtn && !mobileBtn) return; // nichts zu tun

    function updateToggleA11y(theme: Theme): void {
        const isDark = theme === "dark";
        for (const btn of [desktopBtn, mobileBtn]) {
            if (!btn) continue;
            btn.setAttribute("aria-pressed", String(isDark));
            btn.setAttribute("aria-label", (isDark ? btn.dataset.labelDeactivate : btn.dataset.labelActivate) ?? "");
        }
    }

    function applyTheme(theme: Theme): void {
        const isDark = theme === "dark";
        html.setAttribute("data-bs-theme", theme);
        const iconClass = isDark ? "bi bi-sun" : "bi bi-moon";
        if (icon) icon.className = iconClass;
        if (iconMobile) iconMobile.className = iconClass;
        if (textMobile) {
            const txt = isDark ? mobileBtn?.dataset.textDark : mobileBtn?.dataset.textLight;
            if (txt) textMobile.textContent = txt;
        }
        updateToggleA11y(theme);
    }

    function toggleTheme(): void {
        const newTheme: Theme = html.getAttribute("data-bs-theme") === "dark" ? "light" : "dark";
        localStorage.setItem(STORAGE_KEY, newTheme);
        applyTheme(newTheme);
    }

    desktopBtn?.addEventListener("click", toggleTheme);
    mobileBtn?.addEventListener("click", toggleTheme);

    const stored = localStorage.getItem(STORAGE_KEY);
    const prefersDark = window.matchMedia?.("(prefers-color-scheme: dark)").matches;
    applyTheme(isTheme(stored) ? stored : prefersDark ? "dark" : "light");
}
