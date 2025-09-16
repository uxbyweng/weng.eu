export function initThemeToggle() {
    const html = document.documentElement;
    const desktopBtn = document.getElementById("toggleTheme");
    const mobileBtn = document.getElementById("toggleThemeMobile");
    const icon = document.getElementById("themeIcon");
    const iconMobile = document.getElementById("themeIconMobileIcon");
    const textMobile = document.getElementById("themeTextMobile");
    const logo = document.getElementById("logoImage");

    if (!desktopBtn && !mobileBtn) return; // nichts zu tun

    function updateToggleA11y(theme) {
        const isDark = theme === "dark";
        if (desktopBtn) {
            desktopBtn.setAttribute("aria-pressed", String(isDark));
            desktopBtn.setAttribute("aria-label", isDark ? desktopBtn.dataset.labelDeactivate : desktopBtn.dataset.labelActivate);
        }
        if (mobileBtn) {
            mobileBtn.setAttribute("aria-pressed", String(isDark));
            mobileBtn.setAttribute("aria-label", isDark ? mobileBtn.dataset.labelDeactivate : mobileBtn.dataset.labelActivate);
        }
    }

    function applyTheme(theme) {
        const isDark = theme === "dark";
        html.setAttribute("data-bs-theme", theme);
        if (icon) icon.className = isDark ? "bi bi-sun" : "bi bi-moon";
        if (iconMobile) iconMobile.className = isDark ? "bi bi-sun" : "bi bi-moon";
        if (textMobile) {
            const txt = isDark ? mobileBtn?.dataset.textDark : mobileBtn?.dataset.textLight;
            if (txt) textMobile.textContent = txt;
        }
        if (logo) logo.src = isDark ? "/assets/img/logo/logo-dark.svg" : "/assets/img/logo/logo-light.svg";
        updateToggleA11y(theme);
    }

    function toggleTheme() {
        const currentTheme = html.getAttribute("data-bs-theme");
        const newTheme = currentTheme === "dark" ? "light" : "dark";
        localStorage.setItem("theme", newTheme);
        applyTheme(newTheme);
    }

    if (desktopBtn) desktopBtn.addEventListener("click", toggleTheme);
    if (mobileBtn) mobileBtn.addEventListener("click", toggleTheme);

    const savedTheme = localStorage.getItem("theme") || (window.matchMedia?.("(prefers-color-scheme: dark)").matches ? "dark" : "light");
    applyTheme(savedTheme);
}
