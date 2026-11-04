/**
 * Projekte-Filter (Projekte-Übersicht).
 *
 * Markup (projekte/index.php): <div data-project-filter hidden> mit Buttons [data-filter="all|client|employed|own"] (aria-pressed)
 * und einem <p data-filter-status data-template="… {n} … {total}">. Die Karten tragen [data-category].
 * Ohne JS bleibt der Filter versteckt und alle Projekte sind sichtbar.
 */
export function initProjectFilter(): void {
    const filter = document.querySelector<HTMLElement>("[data-project-filter]");
    if (!filter) return;

    const buttons = filter.querySelectorAll<HTMLButtonElement>("button[data-filter]");
    const cards = document.querySelectorAll<HTMLElement>("[data-category]");
    const status = filter.querySelector<HTMLElement>("[data-filter-status]");

    const apply = (category: string): void => {
        let shown = 0;
        for (const card of cards) {
            const visible = category === "all" || card.dataset.category === category;
            card.hidden = !visible;
            if (visible) shown++;
        }
        for (const button of buttons) button.setAttribute("aria-pressed", String(button.dataset.filter === category));
        if (status) {
            status.textContent = (status.dataset.template ?? "").replace("{n}", String(shown)).replace("{total}", String(cards.length));
        }
    };

    for (const button of buttons) {
        button.addEventListener("click", () => apply(button.dataset.filter ?? "all"));
    }

    filter.hidden = false;
}
