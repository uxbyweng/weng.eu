import { getCollapse } from "./modules/collapse";
import { initThemeToggle } from "./modules/theme-toggle";

/** Bootstrap-Collapse erst beim ersten Klick auf den Menü-Button laden. */
function setupLazyNavToggle(): void {
    const toggler = document.querySelector(".navbar-toggler");
    const mainNav = document.getElementById("mainNav");
    if (!toggler || !mainNav) return;

    toggler.addEventListener(
        "click",
        async () => {
            const collapse = await getCollapse(mainNav);
            if (mainNav.classList.contains("show")) {
                collapse.hide();
            } else {
                collapse.show();
            }
        },
        { passive: true },
    );
}

const idle = (cb: () => void) => ("requestIdleCallback" in window ? requestIdleCallback(cb, { timeout: 1500 }) : setTimeout(cb, 1));

document.addEventListener("DOMContentLoaded", () => {
    // Kritisch
    initThemeToggle();
    setupLazyNavToggle();

    // Rest, wenn der Browser Zeit hat
    idle(async () => {
        const [{ initLangSwitcher }, { initEasyLanguage }, { initMobileMenuAutoClose }] = await Promise.all([
            import("./modules/lang-switcher"),
            import("./modules/easy-language"),
            import("./modules/mobile-menu-autoclose"),
        ]);
        initLangSwitcher();
        initEasyLanguage();
        initMobileMenuAutoClose();

        if (document.querySelector("#contact-form")) {
            const { initContactForm } = await import("./modules/contact-form");
            initContactForm();
        }
    });
});
