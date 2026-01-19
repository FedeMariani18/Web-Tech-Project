<?php
require_once 'bootstrap.php';

$result["creazioneeseguita"] = false;

// Gestione upload foto
$fotoName = null;
if (isset($_FILES['foto'])&& $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoName = saveImg($_FILES['foto'], false);
    } else {
        $fotoName = "default_profile.png"; // immagine di default
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