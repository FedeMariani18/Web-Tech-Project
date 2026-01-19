<?php
require_once 'bootstrap.php';

// Pulisci la sessione
$_SESSION = [];
session_unset();

$result['logouteseguito'] = session_destroy();

if(!$result['logouteseguito']){
    $result['errorelogout'] = "errore nel logout";
}

header('Content-Type: application/json');
echo json_encode($result);
?>