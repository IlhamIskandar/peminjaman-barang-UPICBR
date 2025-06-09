<?php
// config/security.php

// 1. Auto-sanitize GET/POST requests
foreach ($_GET as $key => $value) {
    $_GET[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

foreach ($_POST as $key => $value) {
    $_POST[$key] = is_array($value)
        ? array_map('htmlspecialchars', $value)
        : htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}

// 2. Auto-escape output dengan fungsi helper
function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// 3. Set security headers
header("X-XSS-Protection: 1; mode=block");
header("Content-Security-Policy: default-src 'self'");
header("X-Content-Type-Options: nosniff");

// 4. Log XSS attempts
if (preg_match('/<script|alert\(|onerror=/i', json_encode($_REQUEST))) {
    error_log("[XSS Attempt] IP: ".$_SERVER['REMOTE_ADDR']." - Payload: ".$_SERVER['REQUEST_URI']);
}
