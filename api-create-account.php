<?php
require_once 'bootstrap.php';

$result["creazioneeseguita"] = false;

$create_result = $dbh->createUtente($_POST["username"], $_POST["password"], $_POST["nome"], $_POST["cognome"], $_POST["telefono"]);
if(!$create_result){
    //Creazione account fallita
    $result["errorecreazione"] = "Errore nella creazione dell'account";
} else{
    //Creazione account riuscita
    $result["creazioneeseguita"] = true;
    $_SESSION["flash_message"] = "Account creato con successo! Ora puoi effettuare il login.";
}


header('Content-Type: application/json');
echo json_encode($result);

?>