<?php
// === canonical.php ===
// Canonical immer mit der festen Live-Adresse (SITE_URL), nie mit dem Host aus der Anfrage. Query-Parameter entfallen, Pfad endet auf "/".
$canonical = page_url();
if (substr($canonical, -1) !== '/') {
    $canonical .= '/';
}
?>
<link rel="canonical" href="<?php echo htmlspecialchars($canonical, ENT_QUOTES, 'UTF-8'); ?>" />
