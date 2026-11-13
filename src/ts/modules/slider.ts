/**
 * Horizontaler Bilder-Slider auf nativem Scroll-Snap (kein Karussell-Skript).
 *
 * Markup (z. B. projekte/park-klinik/index.php):
 *   <div data-slider>
 *     <div class="slider__track" data-slider-track tabindex="0" role="region" aria-label="…"> <figure class="slider__slide">…</figure> … </div>
 *     <div class="slider__controls" hidden> <button data-slider-prev>…</button> <button data-slider-next>…</button> </div>
 *   </div>
 * Ohne JS bleibt der Slider ein ganz normal scrollbarer Streifen (Touch, Trackpad, Pfeiltasten im fokussierten Bereich);
 * die Buttons werden nur eingeblendet, wenn es wirklich etwas zu scrollen gibt.
 */
const EDGE = 4;

export function initSlider(): void {
    for (const root of document.querySelectorAll<HTMLElement>("[data-slider]")) {
        const track = root.querySelector<HTMLElement>("[data-slider-track]");
        const prev = root.querySelector<HTMLButtonElement>("[data-slider-prev]");
        const next = root.querySelector<HTMLButtonElement>("[data-slider-next]");
        const controls = root.querySelector<HTMLElement>(".slider__controls");
        if (!track || !prev || !next || !controls) continue;

        const slides = Array.from(track.querySelectorAll<HTMLElement>(".slider__slide"));
        const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)");

        const update = (): void => {
            const max = track.scrollWidth - track.clientWidth;
            controls.hidden = max <= EDGE;
            prev.disabled = track.scrollLeft <= EDGE;
            next.disabled = track.scrollLeft >= max - EDGE;
        };

        const go = (direction: 1 | -1): void => {
            const left = track.scrollLeft;
            const target =
                direction === 1
                    ? slides.find(slide => slide.offsetLeft > left + EDGE)
                    : [...slides].reverse().find(slide => slide.offsetLeft < left - EDGE);
            if (!target) return;
            track.scrollTo({ left: target.offsetLeft, behavior: reduceMotion.matches ? "auto" : "smooth" });
        };

        prev.addEventListener("click", () => go(-1));
        next.addEventListener("click", () => go(1));
        track.addEventListener("scroll", update, { passive: true });
        window.addEventListener("resize", update);
        // Bilder laden nachträglich und ändern die Breite
        for (const image of track.querySelectorAll("img")) image.addEventListener("load", update);
        update();
    }
}
