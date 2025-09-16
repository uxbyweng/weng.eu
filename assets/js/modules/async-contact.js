export function initAsyncContact() {
    window.addEventListener("DOMContentLoaded", function () {
        setTimeout(() => {
            fetch("/assets/api/contact.json.php", { credentials: "same-origin" })
                .then(r => {
                    if (!r.ok) throw new Error("HTTP " + r.status);
                    return r.json();
                })
                .then(data => {
                    // Kontakt
                    const setHTML = (id, html) => {
                        const el = document.getElementById(id);
                        if (el && html) el.innerHTML = html;
                    };
                    setHTML("nameSlotContact", data.name_human);
                    setHTML("addressSlotContact", data.address_human);
                    setHTML(
                        "telSlotContact",
                        data.tel_human && data.tel_link ? `<a href="tel:${data.tel_link}" aria-label="Anrufen ${data.tel_human}">${data.tel_human}</a>` : ""
                    );
                    setHTML(
                        "mailSlotContact",
                        data.mail_human && data.mail_link
                            ? `<a href="mailto:${data.mail_link}" aria-label="E-Mail an ${data.mail_human}">${data.mail_human}</a>`
                            : ""
                    );

                    // Footer
                    setHTML("nameSlotFooter", data.name_human);
                    setHTML(
                        "telSlotFooter",
                        data.tel_human && data.tel_link ? `<a href="tel:${data.tel_link}" aria-label="Anrufen ${data.tel_human}">${data.tel_human}</a>` : ""
                    );
                    setHTML(
                        "mailSlotFooter",
                        data.mail_human && data.mail_link
                            ? `<a href="mailto:${data.mail_link}" aria-label="E-Mail an ${data.mail_human}">${data.mail_human}</a>`
                            : ""
                    );

                    // Privacy
                    setHTML("nameSlotPrivacy", data.name_human ? `<strong>${data.name_human}</strong>` : "");
                    setHTML("addressSlotPrivacy", data.address_human);
                    setHTML(
                        "telSlotPrivacy",
                        data.tel_human && data.tel_link ? `<a href="tel:${data.tel_link}" aria-label="Anrufen ${data.tel_human}">${data.tel_human}</a>` : ""
                    );
                    setHTML(
                        "mailSlotPrivacy",
                        data.mail_human && data.mail_link
                            ? `<a href="mailto:${data.mail_link}" aria-label="E-Mail an ${data.mail_human}">${data.mail_human}</a>`
                            : ""
                    );

                    // Imprint
                    setHTML("nameSlotImprint1", data.name_human ? `<strong>${data.name_human}</strong>` : "");
                    setHTML("nameSlotImprint2", data.name_human ? `<strong>${data.name_human}</strong>` : "");
                    setHTML("addressSlotImprint1", data.address_human);
                    setHTML("addressSlotImprint2", data.address_human);
                    setHTML(
                        "telSlotImprint",
                        data.tel_human && data.tel_link ? `<a href="tel:${data.tel_link}" aria-label="Anrufen ${data.tel_human}">${data.tel_human}</a>` : ""
                    );
                    setHTML(
                        "mailSlotImprint",
                        data.mail_human && data.mail_link
                            ? `<a href="mailto:${data.mail_link}" aria-label="E-Mail an ${data.mail_human}">${data.mail_human}</a>`
                            : ""
                    );
                })
                .catch(err => console.error("[contact] fetch failed:", err));
        }, 3000);
    });
}
