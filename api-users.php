<?php
require_once 'bootstrap.php';

$users = $dbh->getUtenti();

if(count($users) === 0){
    //tentativo di query fallito
    $result["erroreusers"] = "fallito il caricamento degli utenti";
}
else{
    $result["userscaricati"] = true;
    for($i = 0; $i < count($users); $i++){
        $users[$i]["foto"] = UPLOAD_DIR.$users[$i]["foto"];
    }
    $response['users'] = $users;
}

header('Content-Type: application/json');
echo json_encode($response);
?>