export function initEasyLanguage() {
    const isEasy = window.location.pathname.includes("leichte-sprache");
    const q = id => document.getElementById(id);
    const easyIcon = q("easyLanguageIconLink");
    const alltags = q("alltagsSpracheLink");
    const easyM = q("easyLanguageIconLinkMobile");
    const alltagsM = q("alltagsSpracheLinkMobile");
    const easyF = q("easyLanguageFooterLink");
    const alltagsF = q("alltagsSpracheFooterLink");

    const show = el => el && el.classList.remove("d-none");
    const hide = el => el && el.classList.add("d-none");

    if (isEasy) {
        hide(easyIcon);
        show(alltags);
        hide(easyM);
        show(alltagsM);
        hide(easyF);
        show(alltagsF);
    } else {
        show(easyIcon);
        hide(alltags);
        show(easyM);
        hide(alltagsM);
        show(easyF);
        hide(alltagsF);
    }
}
