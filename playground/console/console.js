// === Utility formatting ===
const escapeHTML = s => String(s).replace(/[&<>\"]/g, c => ({ "&": "&amp;", "<": "&lt;", ">": "&gt;", '"': "&quot;", "\\": "\\" }[c]));

function stringifyArg(arg) {
    const type = Object.prototype.toString.call(arg).slice(8, -1);
    if (arg === null) return "null";
    if (type === "Undefined") return "undefined";
    if (["Number", "Boolean", "BigInt"].includes(type)) return String(arg);
    if (type === "String") return arg;
    if (type === "Function") return `[Function ${arg.name || "anonymous"}]`;
    if (type === "Symbol") return arg.toString();

    try {
        const seen = new WeakSet();
        return JSON.stringify(
            arg,
            (k, v) => {
                if (typeof v === "object" && v !== null) {
                    if (seen.has(v)) return "[Circular]";
                    seen.add(v);
                }
                if (typeof v === "function") return `[Function ${v.name || "anonymous"}]`;
                if (typeof v === "undefined") return "[undefined]";
                return v;
            },
            2
        );
    } catch (e) {
        return String(arg);
    }
}

const out = document.getElementById("output");

function appendEntry(content) {
    const el = document.createElement("div");
    el.className = "entry log";
    el.innerHTML = `<div class="payload">${content}</div>`;
    out.appendChild(el);
    out.scrollTop = out.scrollHeight;
}

function prune(max = 500) {
    // keep it snappy
    while (out.children.length > max) out.removeChild(out.firstChild);
}

// === Evaluation with console capture and top-level await support ===
const AsyncFunction = Object.getPrototypeOf(async function () {}).constructor;

async function evaluate(code) {
    const logs = [];
    const original = console;
    const proxyConsole = new Proxy(original, {
        get(target, prop) {
            if (["log", "info", "warn", "error"].includes(prop)) {
                return (...args) => {
                    logs.push({ type: prop, args });
                    try {
                        target[prop](...args);
                    } catch {}
                };
            }
            return Reflect.get(target, prop);
        },
    });

    // 1) Normaler Programmlauf (Statements erlaubt)
    try {
        const fn = new AsyncFunction("console", "window", "document", '"use strict";\n' + code);
        const result = await fn(proxyConsole, window, document);
        if (result !== undefined) return { result, logs };

        // 2) Fallback: als Ausdruck interpretieren (wie DevTools)
        //    Wir wrappen in ein async IIFE und returnen dessen Wert.
        try {
            const exprFn = new AsyncFunction("console", "window", "document", '"use strict";\nreturn (async () => ( ' + code + " ))();");
            const exprResult = await exprFn(proxyConsole, window, document);
            return { result: exprResult, logs };
        } catch {
            // Wenn auch das scheitert, behandeln wir es wie „kein Ausdruck“
            return { result: undefined, logs };
        }
    } catch (error) {
        return { error, logs };
    }
}

// === History ===
const HISTORY_KEY = "mini-console-history-v1";
let history = JSON.parse(localStorage.getItem(HISTORY_KEY) || "[]");
let histIndex = history.length; // points one past the end

function pushHistory(cmd) {
    if (!cmd.trim()) return;
    if (history[history.length - 1] === cmd) return; // avoid dup consecutive
    history.push(cmd);
    if (history.length > 300) history.shift();
    histIndex = history.length;
    localStorage.setItem(HISTORY_KEY, JSON.stringify(history));
}

// === UI wiring ===
const codeEl = document.getElementById("code");
const runBtn = document.getElementById("runBtn");
const clearBtn = document.getElementById("clearBtn");
const dlBtn = document.getElementById("dlBtn");

function setCode(value) {
    codeEl.value = value;
    // position caret at end
    requestAnimationFrame(() => {
        codeEl.selectionStart = codeEl.selectionEnd = codeEl.value.length;
    });
}

async function runCurrent() {
    const code = codeEl.value;
    if (!code.trim()) return;

    // Ausgabe vor jedem Run leeren
    out.replaceChildren();

    pushHistory(code);

    const { result, error, logs } = await evaluate(code);

    // Nur console.*-Logs ausgeben
    for (const l of logs) {
        const formatted = l.args.map(a => `<code class="console language-javascript">${escapeHTML(stringifyArg(a))}</code>`).join(" ");
        appendEntry(formatted);
    }

    // Fehler anzeigen
    if (error) {
        appendEntry(`<code class="console error">${escapeHTML(error && (error.stack || error.message || String(error)))}</code>`);
    }
}

runBtn.addEventListener("click", runCurrent);
clearBtn.addEventListener("click", () => {
    out.innerHTML = "";
    codeEl.focus();
});

// Save-as-HTML (downloads the current page as a single file)
// dlBtn.addEventListener('click', (e) => {
// e.preventDefault();
// const blob = new Blob([document.documentElement.outerHTML], { type: 'text/html' });
// const url = URL.createObjectURL(blob);
// const a = document.createElement('a');
// a.href = url;
// a.download = 'mini-js-console.html';
// document.body.appendChild(a);
// a.click();
// a.remove();
// URL.revokeObjectURL(url);
// });

// Keyboard: Ctrl/Cmd+Enter to run, Shift+Enter newline, Tab to indent, Up/Down to browse history
codeEl.addEventListener("keydown", e => {
    if ((e.ctrlKey || e.metaKey) && e.key === "Enter") {
        e.preventDefault();
        runCurrent();
        return;
    }
    if (e.key === "Tab") {
        e.preventDefault();
        const { selectionStart: s, selectionEnd: epos, value } = codeEl;
        const insert = "  ";
        codeEl.value = value.slice(0, s) + insert + value.slice(epos);
        codeEl.selectionStart = codeEl.selectionEnd = s + insert.length;
        return;
    }
    if (e.key === "ArrowUp") {
        // Only intercept at line start
        const atStart = codeEl.selectionStart === 0 && codeEl.selectionEnd === 0;
        if (atStart && history.length) {
            e.preventDefault();
            histIndex = Math.max(0, histIndex - 1);
            setCode(history[histIndex] || "");
        }
        return;
    }
    if (e.key === "ArrowDown") {
        const atEnd = codeEl.selectionStart === codeEl.value.length && codeEl.selectionEnd === codeEl.value.length;
        if (atEnd && history.length) {
            e.preventDefault();
            histIndex = Math.min(history.length, histIndex + 1);
            setCode(history[histIndex] || "");
        }
        return;
    }
});

// Autofocus and welcome
window.addEventListener("load", () => {
    codeEl.focus();
    // appendEntry('info', 'Welcome! Paste JavaScript code in the mini-console above.');
});
