<?php
require_once 'bootstrap.php';

$result["creazioneeseguita"] = false;

// Gestione upload foto
$fotoName = null;
if (isset($_FILES['foto'])) {
    $fotoName = saveImg($_FILES['foto'], true);
    if (!$fotoName) {
        $result["errorecreazione"] = "Errore durante il salvataggio della foto";
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }
}

//crea l'utente nel database
$passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
$create_result = $dbh->createUtente($_POST["username"], $passwordHash, $_POST["nome"], $_POST["cognome"], $_POST["telefono"], $_POST["mail"], $fotoName);
//controllo risultato della query
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