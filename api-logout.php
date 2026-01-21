<?php
header('Content-Type: application/json');

// avvia sessione in modo sicuro
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// distruggi dati sessione
$_SESSION = [];

// cancella cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(
        session_name(),
        '',
        time() - 42000,
        $params["path"],
        $params["domain"],
        $params["secure"],
        $params["httponly"]
    );
}

$destroyed = session_destroy();

echo json_encode([
    "logouteseguito" => $destroyed
]);
