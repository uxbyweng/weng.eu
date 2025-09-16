<?php
// === canonical.php ===

// Basis-URL deiner Website (immer mit Slash am Ende!)
$base_url = "https://weng.eu";

// Protokoll + Host automatisch ermitteln (falls mehrere Domains möglich sind)
$scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host   = $_SERVER['HTTP_HOST'];

// Request-URI (Pfad ohne Query-Parameter)
$uri = strtok($_SERVER['REQUEST_URI'], '?');

// Sauber zusammensetzen
$canonical = $scheme . "://" . $host . $uri;

// Optional: Trailing Slash erzwingen (SEO-konform, falls du überall Slashes hast)
if (substr($canonical, -1) !== "/") {
    $canonical .= "/";
}
?>
<link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>" />
