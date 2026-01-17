<?php 

function isUserLoggedIn(){
    return !empty($_SESSION['id']);
}

function registerLoggedUser($user){
    $_SESSION["id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
}

function saveImg($foto){
    if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
        
        // Genera nome file univoco
        $estensione = pathinfo($foto['name'], PATHINFO_EXTENSION);
        $fotoName = uniqid('user_') . '.' . $estensione;
        
        // Salva il file
        if (!move_uploaded_file($foto['tmp_name'], $fotoName)) {
            $result["errorecreazione"] = "Errore durante il salvataggio della foto";
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }

        return $fotoName;
    }
}

?>