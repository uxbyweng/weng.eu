/**
 * Mobiles Menü (Burger-Button) ohne Bootstrap.
 *
 * Markup (includes/header.php): <button class="nav-toggle" hidden aria-controls="site-nav" …> und <nav id="site-nav">.
 * Ohne JS bleibt der Button versteckt und die Navigation sichtbar. Mit JS wird der Button eingeblendet
 * und die Navigation auf kleinen Bildschirmen eingeklappt (CSS: .site-nav[data-js]:not(.is-open)).
 */
const DESKTOP_QUERY = "(min-width: 768px)";
const SCROLL_DELTA = 10;

export function initNavToggle(): void {
    const button = document.querySelector<HTMLButtonElement>(".nav-toggle");
    const nav = document.getElementById(button?.getAttribute("aria-controls") ?? "");
    if (!button || !nav) return;

    const desktop = window.matchMedia(DESKTOP_QUERY);

    const setOpen = (open: boolean): void => {
        nav.classList.toggle("is-open", open);
        button.setAttribute("aria-expanded", String(open));
        button.setAttribute("aria-label", (open ? button.dataset.labelClose : button.dataset.labelOpen) ?? "");
    };

    nav.dataset.js = "";
    button.hidden = false;
    setOpen(false);

    button.addEventListener("click", () => setOpen(button.getAttribute("aria-expanded") !== "true"));

    // Link im Menü angeklickt → schließen
    nav.addEventListener("click", e => {
        if ((e.target as Element | null)?.closest("a")) setOpen(false);
    });

    // Escape schließt und gibt den Fokus an den Button zurück
    document.addEventListener("keydown", e => {
        if (e.key === "Escape" && button.getAttribute("aria-expanded") === "true") {
            setOpen(false);
            button.focus();
        }
    });

    // Beim Runterscrollen schließen (nur mobil)
    let lastY = window.scrollY;
    window.addEventListener(
        "scroll",
        () => {
            const scrolledDown = window.scrollY > lastY + SCROLL_DELTA;
            lastY = window.scrollY;
            if (scrolledDown && !desktop.matches && button.getAttribute("aria-expanded") === "true") setOpen(false);
        },
        { passive: true },
    );

    // Auf Desktop-Breite wird die Navigation immer angezeigt → Zustand zurücksetzen
    desktop.addEventListener("change", () => setOpen(false));
}
