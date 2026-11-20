/**
 * Mobiles Menü (Burger-Button) ohne Bootstrap.
 *
 * Markup (includes/header.php): <button class="nav-toggle" hidden aria-controls="site-nav" …> und <nav id="site-nav">.
 * Ohne JS bleibt der Button versteckt und die Navigation sichtbar. Mit JS wird der Button eingeblendet
 * und die Navigation auf kleinen Bildschirmen eingeklappt (CSS: .site-nav[data-js]:not(.is-open)). Geöffnet füllt das Menü den ganzen Bildschirm.
 */
const DESKTOP_QUERY = "(min-width: 768px)";
const SCROLL_DELTA = 10;
const KEEP_OPEN_KEY = "menu-keep-open";

/** sessionStorage kann blockiert sein (Privatmodus, Einstellungen) → Fehler schlucken, das Menü funktioniert auch ohne. */
function storage(action: () => void): void {
    try {
        action();
    } catch {
        // ignorieren
    }
}

export function initNavToggle(): void {
    const button = document.querySelector<HTMLButtonElement>(".nav-toggle");
    const nav = document.getElementById(button?.getAttribute("aria-controls") ?? "");
    if (!button || !nav) return;

    const desktop = window.matchMedia(DESKTOP_QUERY);

    const setOpen = (open: boolean): void => {
        nav.classList.toggle("is-open", open);
        document.documentElement.classList.toggle("menu-open", open); // CSS: html.menu-open sperrt das Scrollen der Seite dahinter
        button.setAttribute("aria-expanded", String(open));
        button.setAttribute("aria-label", (open ? button.dataset.labelClose : button.dataset.labelOpen) ?? "");
    };

    nav.dataset.js = "";
    button.hidden = false;
    setOpen(false);

    button.addEventListener("click", () => setOpen(button.getAttribute("aria-expanded") !== "true"));

    // Sprachwechsel lädt eine neue Seite: Menü dort wieder öffnen (wie beim Dunkelmodus-Schalter, der das Menü nicht schließt)
    const langLink = (target: EventTarget | null): boolean => !!(target as Element | null)?.closest(".lang-switch a");

    // Link im Menü angeklickt → schließen (Sprachwechsel ausgenommen)
    nav.addEventListener("click", e => {
        if (langLink(e.target)) {
            storage(() => sessionStorage.setItem(KEEP_OPEN_KEY, "1"));
            return;
        }
        if ((e.target as Element | null)?.closest("a")) setOpen(false);
    });

    // Nach dem Sprachwechsel: Menü wieder öffnen und den Fokus auf die aktive Sprache setzen
    let keepOpen = false;
    storage(() => {
        keepOpen = sessionStorage.getItem(KEEP_OPEN_KEY) === "1";
        sessionStorage.removeItem(KEEP_OPEN_KEY);
    });
    if (keepOpen && !desktop.matches) {
        setOpen(true);
        nav.querySelector<HTMLElement>(".lang-switch [aria-current]")?.focus();
    }

    // Escape schließt und gibt den Fokus an den Button zurück
    document.addEventListener("keydown", e => {
        if (e.key === "Escape" && button.getAttribute("aria-expanded") === "true") {
            setOpen(false);
            button.focus();
        }
    });

    // Beim Runterscrollen schließen (nur mobil). scrollY wird erst beim Scrollen gelesen: Ein Zugriff beim Start würde nach den
    // DOM-Änderungen oben ein sofortiges Layout erzwingen (Lighthouse: "Erzwungener dynamischer Umbruch").
    let lastY: number | null = null;
    window.addEventListener(
        "scroll",
        () => {
            const y = window.scrollY;
            const scrolledDown = lastY !== null && y > lastY + SCROLL_DELTA;
            lastY = y;
            if (scrolledDown && !desktop.matches && button.getAttribute("aria-expanded") === "true") setOpen(false);
        },
        { passive: true },
    );

    // Auf Desktop-Breite wird die Navigation immer angezeigt → Zustand zurücksetzen
    desktop.addEventListener("change", () => setOpen(false));
}
