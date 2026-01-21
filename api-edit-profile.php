<?php
require_once 'bootstrap.php';

$result['modificaeseguita'] = false;

// Gestione upload foto
$fotoName = null;
if(!empty($_FILES['foto']['name'])) {
    //cancellazione foto precedente se ne è stata caricata una nuova
    $oldFoto = $_POST['fotoOld'] ?? null;
    if($oldFoto && (UPLOAD_DIR_PROFILE . $oldFoto) != (UPLOAD_DIR_PROFILE . "default_profile.png")) {
        unlink(UPLOAD_DIR_PROFILE . $oldFoto);
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
if(isset($_POST['password']) && !empty($_POST['password'])){
    $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);
} else {
    $passwordHash = $_POST['passwordOld'] ?? null;  // Mantieni la vecchia
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