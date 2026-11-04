import { getCollapse } from "./collapse";

export interface MobileMenuAutoCloseOptions {
    navSelector?: string;
    maxMobileWidth?: number;
    scrollDelta?: number;
    closeOnLinkClick?: boolean;
    closeOnResizeUp?: boolean;
}

/**
 * Schließt das mobile Bootstrap-Menü beim Runterscrollen, bei Klick auf einen Link
 * und beim Wechsel zurück auf Desktop-Breite. Bootstrap-Collapse wird erst bei Bedarf geladen.
 */
export function initMobileMenuAutoClose(options: MobileMenuAutoCloseOptions = {}): { destroy: () => void } {
    const {
        navSelector = "#mainNav",
        maxMobileWidth = 767.98,
        scrollDelta = 10,
        closeOnLinkClick = true,
        closeOnResizeUp = true,
    } = options;

    const nav = document.querySelector<HTMLElement>(navSelector);
    if (!nav) return { destroy: () => {} };

    const isMobile = () => window.matchMedia(`(max-width: ${maxMobileWidth}px)`).matches;
    const isOpen = () => nav.classList.contains("show");
    const close = async () => (await getCollapse(nav)).hide();

    // 1) Scroll: bei Bewegung nach unten schließen
    let lastY = window.scrollY;
    const onScroll = async () => {
        const scrolledDown = isMobile() && window.scrollY > lastY + scrollDelta;
        lastY = window.scrollY;
        if (scrolledDown && isOpen()) await close();
    };

    // 2) Klick im Menü: Links/Buttons schließen
    const onNavClick = async (e: Event) => {
        if (!closeOnLinkClick || !isMobile() || !isOpen()) return;
        const target = (e.target as Element | null)?.closest("a, button");
        if (!target || target.matches("[data-no-autoclose]")) return;
        await close();
    };

    // 3) Breakpoint-Wechsel nach oben (>= md): schließen
    const onResize = async () => {
        if (closeOnResizeUp && !isMobile() && isOpen()) await close();
    };

    window.addEventListener("scroll", onScroll, { passive: true });
    nav.addEventListener("click", onNavClick);
    window.addEventListener("resize", onResize);

    return {
        destroy: () => {
            window.removeEventListener("scroll", onScroll);
            nav.removeEventListener("click", onNavClick);
            window.removeEventListener("resize", onResize);
        },
    };
}
