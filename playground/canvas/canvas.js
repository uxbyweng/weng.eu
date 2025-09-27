(function () {
    const cvs = document.getElementById("canvas");
    if (!cvs) return;
    const ctx = cvs.getContext("2d");

    // URLs & Token aus data-Attributen
    const SAVE_URL = cvs.getAttribute("data-save-url"); // /playground/canvas/save.php
    const LOAD_URL = cvs.getAttribute("data-load-url"); // /playground/canvas/current.php
    const CSRF = cvs.getAttribute("data-csrf");

    const saveBtn = document.getElementById("saveBtn");
    const clearBtn = document.getElementById("clearBtn");
    const dlBtn = document.getElementById("dlBtn");
    const statusEl = document.getElementById("status");
    const versionList = document.getElementById("versionList");
    const nameInput = document.getElementById("bildname");

    let currentName = null; // z.B. "20250927120550-eye.png" oder "latest.png"

    function setStatus(t) {
        if (statusEl) statusEl.textContent = t || "";
    }

    function buildShareUrl() {
        const base = location.origin + "/playground/canvas/";
        if (!currentName || currentName === "latest.png") return base;
        const v = currentName.replace(/\.png$/, "");
        return base + "?v=" + encodeURIComponent(v);
    }

    // Startzustand
    function resetBackground() {
        ctx.fillStyle = "#32363a";
        ctx.fillRect(0, 0, cvs.width, cvs.height);
        ctx.strokeStyle = "#ff3300";
        ctx.lineWidth = 10;
        ctx.lineCap = "round";
        ctx.lineJoin = "round";
    }
    resetBackground();

    let drawing = false,
        last = null;

    function canvasPosFromClient(clientX, clientY) {
        const r = cvs.getBoundingClientRect();
        const scaleX = cvs.width / r.width;
        const scaleY = cvs.height / r.height;
        return {
            x: (clientX - r.left) * scaleX,
            y: (clientY - r.top) * scaleY,
        };
    }

    // Maus
    function posMouse(e) {
        return canvasPosFromClient(e.clientX, e.clientY);
    }

    // Touch
    function posTouch(e) {
        const t = e.touches[0];
        return canvasPosFromClient(t.clientX, t.clientY);
    }

    // Mit der Maus zeichnen (Mouse)
    cvs.addEventListener("mousedown", e => {
        drawing = true;
        last = posMouse(e);
    });
    window.addEventListener("mouseup", () => {
        drawing = false;
    });
    cvs.addEventListener("mousemove", e => {
        if (!drawing) return;
        const p = posMouse(e);
        ctx.beginPath();
        ctx.moveTo(last.x, last.y);
        ctx.lineTo(p.x, p.y);
        ctx.stroke();
        last = p;
    });

    //  Mit dem Finger zeichnen (Touch)
    cvs.addEventListener(
        "touchstart",
        e => {
            e.preventDefault();
            drawing = true;
            last = posTouch(e);
        },
        { passive: false }
    );
    cvs.addEventListener(
        "touchmove",
        e => {
            if (!drawing) return;
            e.preventDefault();
            const p = posTouch(e);
            ctx.beginPath();
            ctx.moveTo(last.x, last.y);
            ctx.lineTo(p.x, p.y);
            ctx.stroke();
            last = p;
        },
        { passive: false }
    );
    cvs.addEventListener("touchend", () => {
        drawing = false;
    });

    // Download
    function downloadPng() {
        const url = cvs.toDataURL("image/png");
        dlBtn.href = url;
    }

    // ► Clear (nur lokal)
    function clearCanvas() {
        resetBackground();
        setStatus("Canvas cleared ✔");
        if (nameInput) nameInput.value = "";
    }

    // Speichern – mit optionalem Namen
    async function saveToServer() {
        if (!SAVE_URL) return;
        setStatus("Saving …");
        try {
            const blob = await new Promise(res => cvs.toBlob(res, "image/png", 0.92));
            const fd = new FormData();
            if (CSRF) fd.append("csrf", CSRF);
            fd.append("png", blob, "canvas.png");

            const rawName = ((nameInput && nameInput.value) || "").trim();
            if (rawName) fd.append("name", rawName);

            const r = await fetch(SAVE_URL, { method: "POST", body: fd, credentials: "same-origin" });

            if (r.status === 429) {
                let retry = 60;
                try {
                    const j = await r.json();
                    if (j && j.retry_after) retry = j.retry_after;
                } catch {}
                setStatus(`Limit erreicht – bitte in ${retry}s erneut versuchen.`);
                if (saveBtn) {
                    saveBtn.disabled = true;
                    setTimeout(() => {
                        saveBtn.disabled = false;
                        setStatus("");
                    }, retry * 1000);
                }
                return;
            }
            if (!r.ok) throw new Error("HTTP " + r.status);

            const json = await r.json().catch(() => null);

            // ► State: gerade gespeicherte Datei ist die neue aktuelle
            if (json && json.name) {
                currentName = json.name; // z.B. "20250927123748-sonne.png"
                const share = buildShareUrl();
                history.pushState({}, "", share); // teilbare URL setzen
                setStatus(`Gespeichert als ${json.name}`);
            } else {
                setStatus("Gespeichert ✔");
            }

            // ► Name-Input leeren
            if (nameInput) nameInput.value = "";

            // Liste aktualisieren
            await fetchVersions();
        } catch (e) {
            console.error(e);
            setStatus("Fehler beim Speichern");
        }
    }

    // Laden (optional mit bestimmtem Dateinamen)
    async function loadFromServer(name) {
        if (!LOAD_URL) return;
        setStatus("Lade …");
        try {
            const img = new Image();
            img.onload = () => {
                ctx.drawImage(img, 0, 0, cvs.width, cvs.height);
                setStatus("Geladen ✔");
            };
            const isLatest = !name;
            const url = isLatest ? `${LOAD_URL}?t=${Date.now()}` : `${LOAD_URL}?name=${encodeURIComponent(name)}&t=${Date.now()}`;
            img.src = url;

            // ► State aktualisieren
            currentName = isLatest ? "latest.png" : name;

            // ► URL in der Adresszeile aktualisieren (teilbare URL)
            const share = buildShareUrl();
            history.pushState({}, "", share);

            // ► Input leeren, wenn man eine ältere Version lädt
            if (nameInput) nameInput.value = "";
        } catch (e) {
            console.error(e);
            setStatus("Fehler beim Laden");
        }
    }

    // Versionen-Liste
    async function fetchVersions() {
        try {
            const r = await fetch("/playground/canvas/versions.php", { credentials: "same-origin" });
            if (!r.ok) throw new Error("HTTP " + r.status);
            const list = await r.json();
            renderVersions(list);
        } catch (e) {
            console.error(e);
            if (versionList) versionList.innerHTML = "<li><em>No list available.</em></li>";
        }
    }

    function renderVersions(items) {
        if (!versionList) return;
        if (!items || !items.length) {
            versionList.innerHTML = "<li><em>No versions saved yet.</em></li>";
            return;
        }
        versionList.innerHTML = "";
        items.forEach(it => {
            const li = document.createElement("li");
            const a = document.createElement("a");
            a.href = "/playground/canvas/?v=" + encodeURIComponent(it.name.replace(/\.png$/, ""));
            a.addEventListener("click", ev => {
                ev.preventDefault();
                // ► Input leeren
                if (nameInput) nameInput.value = "";
                // ► Laden setzt currentName & URL
                loadFromServer(it.name);
            });
            // Anzeige: freundlicher Titel (falls vorhanden) + TS
            const label = it.title ? it.title : it.name;
            a.innerHTML = `<span>${label}</span><span class="time">${it.ts || ""}</span>`;
            li.appendChild(a);
            versionList.appendChild(li);
        });
    }

    // Events
    if (dlBtn) dlBtn.addEventListener("click", downloadPng);
    if (saveBtn) saveBtn.addEventListener("click", saveToServer);
    if (clearBtn) clearBtn.addEventListener("click", clearCanvas);

    const shareBtn = document.getElementById("shareBtn");
    if (shareBtn) {
        shareBtn.addEventListener("click", async () => {
            const url = buildShareUrl();
            try {
                await navigator.clipboard.writeText(url);
                setStatus("Link kopiert");
                setTimeout(() => setStatus(""), 2000);
            } catch {
                // Fallback: Auswahl/Prompt
                prompt("Link kopieren:", url);
            }
        });
    }

    // Beim Start: Liste holen + initiale Version laden
    fetchVersions();
    const initial = cvs.getAttribute("data-initial-name");
    if (initial) {
        loadFromServer(initial);
    } else {
        loadFromServer(); // latest
    }
})();
