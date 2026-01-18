<?php
require_once 'bootstrap.php';

//restituisce di default tutte le informazione dell'utente correntemente loggato
$response = [
    'utenteLoggato' => isUserLoggedIn(),
    'post' => null,
    'fotoProfilo' => null,
    'utentePartecipa' => null,
    'id_utente' => null,
    'likeUtente' => null
];

if (isUserLoggedIn()) {
    $response['fotoProfilo'] = $dbh->getUserFromId($_SESSION['id'])['foto'];
    $response['fotoProfilo'] = UPLOAD_DIR_PROFILE.$response['fotoProfilo'];
    $response['id_utente'] = $_SESSION['id'];
}

if(isset($_POST['id'])){
    //carica lo specifico utente dato un id
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
} else {
    //caricamento di tutti gli utenti
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
}

header('Content-Type: application/json');
echo json_encode($response);
?>