import { initThemeToggle } from "./modules/theme-toggle.js";

function loadScriptOnce(src) {
    let p = loadScriptOnce._map?.get(src);
    if (p) return p;
    p = new Promise((resolve, reject) => {
        const s = document.createElement("script");
        s.src = src;
        s.async = true;
        s.onload = () => resolve();
        s.onerror = reject;
        document.head.appendChild(s);
    });
    (loadScriptOnce._map ??= new Map()).set(src, p);
    return p;
}

function setupLazyBootstrapCollapse() {
    const toggler = document.querySelector(".navbar-toggler");
    const mainNav = document.getElementById("mainNav");
    if (!toggler || !mainNav) return;

    let loaded = false;

    toggler.addEventListener(
        "click",
        async e => {
            // Bootstrap erst beim ersten Klick laden
            if (!loaded) {
                await loadScriptOnce("/assets/vendor/bootstrap/bootstrap.min.js");
                loaded = true;
            }

            const Collapse = window.bootstrap?.Collapse;
            if (!Collapse) return; // Failsafe, falls Datei nicht geladen werden konnte

            // Instanz holen/erzeugen
            const instance = Collapse.getOrCreateInstance ? Collapse.getOrCreateInstance(mainNav, { toggle: false }) : new Collapse(mainNav, { toggle: false });

            // explizit toggeln (unabhängig vom data-api)
            if (mainNav.classList.contains("show")) {
                instance.hide();
            } else {
                instance.show();
            }
        },
        { passive: true }
    );
}

const idle = cb => ("requestIdleCallback" in window ? requestIdleCallback(cb, { timeout: 1500 }) : setTimeout(cb, 1));

document.addEventListener("DOMContentLoaded", () => {
    // Kritisch
    initThemeToggle();

    // Günstig & früh initialisieren
    setupLazyBootstrapCollapse();

    // Rest in Idle
    idle(async () => {
        const [{ initLangSwitcher }] = await Promise.all([import("./modules/lang-switcher.js")]);
        initLangSwitcher();

        const [{ initEasyLanguage }, { initMobileMenuAutoClose }] = await Promise.all([
            import("./modules/easy-language.js"),
            import("./modules/mobile-menu-autoclose.js"),
        ]);
        initEasyLanguage();
        initMobileMenuAutoClose();

        const form = document.querySelector("#contact-form");
        if (form) {
            const { initContactForm } = await import("./modules/contact-form.de.js");
            initContactForm();
        }
    });
});
