import { initNavToggle } from "./modules/nav-toggle";
import { initThemeToggle } from "./modules/theme-toggle";

const idle = (cb: () => void) => ("requestIdleCallback" in window ? requestIdleCallback(cb, { timeout: 1500 }) : setTimeout(cb, 1));

document.addEventListener("DOMContentLoaded", () => {
    // Kritisch: sichtbar sofort
    initThemeToggle();
    initNavToggle();

    // Rest, wenn der Browser Zeit hat
    idle(async () => {
        if (document.querySelector("[data-lang]")) {
            const { initLangSwitcher } = await import("./modules/lang-switcher");
            initLangSwitcher();
        }

        if (document.querySelector("#contact-form")) {
            const { initContactForm } = await import("./modules/contact-form");
            initContactForm();
        }
    });
});
