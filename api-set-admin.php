<?php
require_once 'bootstrap.php';

$result["user-modificato"] = false;
$modify_result = $dbh->modifyAdminById($_POST['id']);

if($modify_result === null){
    //tentativo di query fallito
    $result["erroremodifica"] = "fallita la modifica dell'utente";
} else{
    $result["usermodificato"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>