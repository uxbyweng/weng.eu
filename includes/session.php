<?php
declare(strict_types=1);

// nur starten, wenn gefordert
if (defined('NEED_SESSION') && NEED_SESSION && session_status() !== PHP_SESSION_ACTIVE) {
  session_set_cookie_params([
    'lifetime'=>0,'path'=>'/','domain'=>'',
    'secure'=>(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off'),
    'httponly'=>true,'samesite'=>'Lax',
  ]);
  session_start();
}

// CSP-Nonce kann auch ohne Session pro Request erzeugt werden
if (empty($_SERVER['CSP_NONCE'])) {
  $_SERVER['CSP_NONCE'] = bin2hex(random_bytes(16));
}
