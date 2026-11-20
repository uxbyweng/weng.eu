/** Minimale Typen für Trusted Types (fehlen in der TypeScript-DOM-Bibliothek). Genutzt in modules/contact-form.ts. */
interface Window {
    trustedTypes?: {
        createPolicy(name: string, rules: { createHTML?: (input: string) => string }): { createHTML(input: string): unknown };
    };
}
