<?php
require_once 'bootstrap.php';

$result['modificaeseguita'] = false;

// Gestione upload foto
$fotoName = null;
if (is_string($_POST['foto'])) {
    $fotoName = $_POST['foto'];
} else {
    $fotoName = saveImg($_FILES['foto'], true);
    if (!$fotoName) {
        $result["errorecreazione"] = "Errore durante il salvataggio della foto";
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    }    
}

if(is_null($_POST['password'])){
    $passwordHash = $_POST['password'];
} else {
    $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
}

$create_result = $dbh->modifyUtente($_POST["id"], $_POST["username"], $passwordHash, $_POST["nome"], $_POST["cognome"], $_POST["telefono"], $_POST["mail"], $fotoName);
//controllo risultato della query
if(!$create_result){
    //Creazione account fallita
    $result["erroremodifica"] = "Errore nella modifica dell'account";
} else{
    //Creazione account riuscita
    $result["modificaeseguita"] = true;
    $_SESSION["flash_message"] = "Account modificato con successo!";
}

header('Content-Type: application/json');
echo json_encode($result);
?>