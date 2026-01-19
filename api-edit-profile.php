<?php
require_once 'bootstrap.php';

$result['modificaeseguita'] = false;

// Gestione upload foto
$fotoName = null;
if(!empty($_FILES['foto']['name'])) {
    //cancellazione foto precedente se ne è stata caricata una nuova
    $oldFoto = $_POST['fotoOld'] ?? null;
    if($oldFoto) {
        unlink("resources/users/" . $oldFoto);
    }

    $fotoName = saveImg($_FILES['foto'], true);
    if (!$fotoName) {
        $result["errorecreazione"] = "Errore durante il salvataggio della foto";
        header('Content-Type: application/json');
        echo json_encode($result);
        exit;
    } 
} else {
    $fotoName = $_POST['fotoOld'] ?? null;
}

//gestisco la password, se è null non è stata modificata quindi la lascio così com'è
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