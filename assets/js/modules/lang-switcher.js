export function initLangSwitcher() {
    document.addEventListener("click", function (e) {
        const el = e.target.closest(".lang-switch [data-lang]");
        if (!el) return;
        e.preventDefault();
        const form = document.getElementById("langForm");
        if (!form) return;
        form.elements.lang.value = el.dataset.lang;
        form.submit();
    });
}
