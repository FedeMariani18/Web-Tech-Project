<?php
require_once 'bootstrap.php';

if(isset($_POST['id'])){
    $user = $dbh->getUserFromId($_POST['id']);
    $response['userscaricati'] = false;
    if($user === null || $user === false){
        //tentativo di query fallito
        $response['userscaricati'] = false;
        $result["erroreuser"] = "fallito il ricaricamento dell'utente";
    } else{
        $user["foto"] = UPLOAD_DIR.$user["foto"];
        $response['user'] = $user;
        $response['userscaricati'] = true;
        }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

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