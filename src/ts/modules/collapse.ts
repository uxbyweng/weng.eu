import type Collapse from "bootstrap/js/dist/collapse";

/**
 * Lädt Bootstrap-Collapse erst bei Bedarf (eigener Chunk) und liefert die Instanz für ein Element.
 * Mehrfachaufrufe teilen sich denselben Import.
 */
let collapseModule: Promise<typeof Collapse> | undefined;

export async function getCollapse(el: HTMLElement): Promise<Collapse> {
    collapseModule ??= import("bootstrap/js/dist/collapse").then(m => m.default);
    const CollapseClass = await collapseModule;
    return CollapseClass.getOrCreateInstance(el, { toggle: false });
}
