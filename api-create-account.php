<?php
require_once 'bootstrap.php';

$result["creazioneeseguita"] = false;

var_dump($_POST);

$create_result = $dbh->createUtente($_POST["username"], $_POST["password"], $_POST["nome"], $_POST["cognome"], $_POST["telefono"]);
if(!$create_result){
    //Creazione account fallita
    $result["errorecreazione"] = "Errore nella creazione dell'account";
} else{
    //Creazione account riuscita
    $result["creazioneeseguita"] = true;
}


header('Content-Type: application/json');
echo json_encode($result);

?>