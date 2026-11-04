export function initEasyLanguage(): void {
    const isEasy = window.location.pathname.includes("leichte-sprache");
    const byId = (id: string) => document.getElementById(id);

    // Paare aus "Link zur Leichten Sprache" und "Link zurück zur Alltagssprache"
    const pairs: Array<[easy: string, regular: string]> = [
        ["easyLanguageIconLink", "alltagsSpracheLink"],
        ["easyLanguageIconLinkMobile", "alltagsSpracheLinkMobile"],
        ["easyLanguageFooterLink", "alltagsSpracheFooterLink"],
    ];

    for (const [easyId, regularId] of pairs) {
        byId(easyId)?.classList.toggle("d-none", isEasy);
        byId(regularId)?.classList.toggle("d-none", !isEasy);
    }
}
