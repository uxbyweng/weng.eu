export function initLangSwitcher(): void {
    document.addEventListener("click", e => {
        const el = (e.target as Element | null)?.closest<HTMLElement>(".lang-switch [data-lang]");
        if (!el) return;
        e.preventDefault();
        const form = document.getElementById("langForm") as HTMLFormElement | null;
        const langField = form?.elements.namedItem("lang");
        if (!form || !(langField instanceof HTMLInputElement)) return;
        langField.value = el.dataset.lang ?? "";
        form.submit();
    });
}
