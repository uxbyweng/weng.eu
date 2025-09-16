// modules/cookie-consent.js
let initialized = false;

export function initCookieConsent() {
    if (initialized) return;
    initialized = true;

    ("use strict");

    const htmlLang = (document.documentElement.getAttribute("lang") || "de").slice(0, 2).toLowerCase();
    const isDe = htmlLang === "de";
    const TEXT = isDe
        ? {
              title: "Cookies auf dieser Website",
              msg: "Diese Website nutzt Cookies z. B. für den Sprachumschalter.",
              allow: "Zustimmen",
              deny: "Ablehnen",
              link: "Datenschutzerklärung",
              policyUrl: "/datenschutz/",
          }
        : {
              title: "Cookies on this website",
              msg: "This website uses cookies, e.g. for the language switcher.",
              allow: "Allow",
              deny: "Decline",
              link: "Privacy policy",
              policyUrl: "/privacy/",
          };

    const COOKIE_NAME = "cc_status"; // 'allow' | 'deny'
    const COOKIE_MAX_AGE = 60 * 60 * 24 * 365; // 1 year (s)

    function setCookie(name, value, maxAgeSec) {
        const secure = location.protocol === "https:" ? "; Secure" : "";
        document.cookie = name + "=" + encodeURIComponent(value) + "; Max-Age=" + (maxAgeSec | 0) + "; Path=/; SameSite=Lax" + secure;
    }
    function getCookie(name) {
        return document.cookie.split("; ").reduce((acc, part) => {
            const idx = part.indexOf("=");
            const k = part.slice(0, idx);
            const v = part.slice(idx + 1);
            return k === name ? decodeURIComponent(v) : acc;
        }, null);
    }
    function dispatch(status) {
        try {
            window.dispatchEvent(new CustomEvent("consent:change", { detail: { status } }));
        } catch {}
    }

    // Public API
    window.CookieConsent = {
        get() {
            return getCookie(COOKIE_NAME);
        },
        set(status) {
            setCookie(COOKIE_NAME, status, COOKIE_MAX_AGE);
            dispatch(status);
        },
        revoke() {
            setCookie(COOKIE_NAME, "", -1);
            openBanner();
        },
    };

    let lastFocus = null;
    let el = null;

    function getFocusable(container) {
        return container.querySelectorAll(
            [
                "a[href]",
                "area[href]",
                "button:not([disabled])",
                "input:not([disabled])",
                "select:not([disabled])",
                "textarea:not([disabled])",
                '[tabindex]:not([tabindex="-1"])',
            ].join(",")
        );
    }

    function buildBanner() {
        const wrap = document.createElement("div");
        wrap.className = "cc-banner";
        wrap.setAttribute("role", "dialog");
        wrap.setAttribute("aria-modal", "true");

        const titleId = "cc-title-" + Math.random().toString(36).slice(2);
        const msgId = "cc-msg-" + Math.random().toString(36).slice(2);
        wrap.setAttribute("aria-labelledby", titleId);
        wrap.setAttribute("aria-describedby", msgId);

        wrap.innerHTML =
            '<div class="cc-inner" role="document">' +
            `<h2 id="${titleId}" class="cc-title">${TEXT.title}</h2>` +
            `<p id="${msgId}" class="cc-msg">${TEXT.msg} ` +
            `<a class="cc-link" href="${TEXT.policyUrl}" rel="nofollow noopener">${TEXT.link}</a>.</p>` +
            '<div class="cc-actions">' +
            `<button type="button" class="cc-btn cc-deny btn btn-outline-secondary px-4 py-2 m-2">${TEXT.deny}</button>` +
            `<button type="button" class="cc-btn cc-allow btn btn-primary px-4 py-2 m-2">${TEXT.allow}</button>` +
            "</div>" +
            "</div>";

        const denyBtn = wrap.querySelector(".cc-deny");
        const allowBtn = wrap.querySelector(".cc-allow");

        denyBtn.addEventListener("click", () => {
            window.CookieConsent.set("deny");
            closeBanner();
        });
        allowBtn.addEventListener("click", () => {
            window.CookieConsent.set("allow");
            closeBanner();
        });

        // Fokusfalle + ESC
        wrap.addEventListener("keydown", e => {
            if (e.key === "Escape") {
                e.preventDefault();
                closeBanner();
                return;
            }
            if (e.key !== "Tab") return;
            const focusables = getFocusable(wrap);
            if (!focusables.length) return;
            const first = focusables[0],
                last = focusables[focusables.length - 1];
            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        });

        return wrap;
    }

    function openBanner() {
        if (el) return;
        lastFocus = document.activeElement;
        el = buildBanner();
        document.body.appendChild(el);
        document.body.classList.add("has-cc-open");
        try {
            el.querySelector(".cc-allow")?.focus({ preventScroll: true });
        } catch {}
    }

    function closeBanner() {
        if (!el) return;
        el.remove();
        el = null;
        document.body.classList.remove("has-cc-open");
        try {
            lastFocus?.focus();
        } catch {}
    }

    // Init
    const status = getCookie(COOKIE_NAME);
    if (status !== "allow" && status !== "deny") openBanner();
    else dispatch(status);

    // Reopen Link
    function bindReopen(selector) {
        const link = document.querySelector(selector);
        if (!link) return;
        link.addEventListener("click", e => {
            e.preventDefault();
            window.CookieConsent.revoke();
        });
    }
    bindReopen("#cookie-settings");
    bindReopen("[data-cookie-settings]");
}
