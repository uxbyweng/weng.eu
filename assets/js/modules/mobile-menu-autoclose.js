/**
 * Auto-close Bootstrap mobile menu on scroll down / link click / breakpoint change.
 * Funktioniert auch, wenn Bootstrap JS beim Init noch nicht geladen ist.
 */
export function initMobileMenuAutoClose(options = {}) {
    const {
        navSelector = "#mainNav",
        maxMobileWidth = 767.98,
        scrollDelta = 10,
        closeOnLinkClick = true,
        closeOnResizeUp = true,
        bootstrapSrc = "/assets/vendor/bootstrap/bootstrap.min.js",
    } = options;

    const nav = document.querySelector(navSelector);
    if (!nav) return { destroy: () => {} };

    // kleiner Loader, Mehrfachaufrufe = 1 Netzrequest
    let __bsPromise;
    function loadScriptOnce(src) {
        if (__bsPromise) return __bsPromise;
        __bsPromise = new Promise((resolve, reject) => {
            const s = document.createElement("script");
            s.src = src;
            s.async = true;
            s.onload = () => resolve();
            s.onerror = reject;
            document.head.appendChild(s);
        });
        return __bsPromise;
    }

    async function ensureCollapse() {
        if (window.bootstrap?.Collapse) return window.bootstrap.Collapse;
        await loadScriptOnce(bootstrapSrc).catch(() => {});
        return window.bootstrap?.Collapse || null;
    }

    async function getCollapseInstance() {
        const Collapse = await ensureCollapse();
        if (!Collapse) return null;
        return Collapse.getOrCreateInstance ? Collapse.getOrCreateInstance(nav, { toggle: false }) : new Collapse(nav, { toggle: false });
    }

    const isMobile = () => window.matchMedia(`(max-width: ${maxMobileWidth}px)`).matches;
    const isOpen = () => nav.classList.contains("show");

    // 1) Scroll: bei Bewegung nach unten schließen
    let lastY = window.scrollY;
    const onScroll = async () => {
        if (!isMobile()) {
            lastY = window.scrollY;
            return;
        }
        const scrolledDown = window.scrollY > lastY + scrollDelta;
        if (scrolledDown && isOpen()) {
            const collapse = await getCollapseInstance();
            collapse?.hide();
        }
        lastY = window.scrollY;
    };

    // 2) Klick im Menü: Links/Buttons schließen
    const onNavClick = async e => {
        if (!closeOnLinkClick || !isMobile() || !isOpen()) return;
        const t = e.target.closest("a, button");
        if (!t || t.matches("[data-no-autoclose]")) return;
        const collapse = await getCollapseInstance();
        collapse?.hide();
    };

    // 3) Breakpoint-Wechsel nach oben (>= md): schließen
    const onResize = async () => {
        if (!closeOnResizeUp) return;
        if (!isMobile() && isOpen()) {
            const collapse = await getCollapseInstance();
            collapse?.hide();
        }
    };

    // Listener registrieren
    window.addEventListener("scroll", onScroll, { passive: true });
    nav.addEventListener("click", onNavClick);
    window.addEventListener("resize", onResize);

    // API zum Aufräumen
    const destroy = () => {
        window.removeEventListener("scroll", onScroll, { passive: true });
        nav.removeEventListener("click", onNavClick);
        window.removeEventListener("resize", onResize);
    };

    return { destroy };
}
