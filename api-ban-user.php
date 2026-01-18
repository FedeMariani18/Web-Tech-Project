<?php
require_once 'bootstrap.php';

$result["usermodificato"] = false;
$modify_result = $dbh->modifyBanUserById($_POST['id']);

if(!$modify_result){
    //tentativo di query fallito
    $result["erroremodifica"] = "fallita la modifica dell'utente";
} else{
    $result["usermodificato"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>