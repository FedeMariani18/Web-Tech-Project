<?php 

function isUserLoggedIn(){
    return !empty($_SESSION['id']);
}

function getMyUserId(){   
    return isUserLoggedIn()? $_SESSION['id'] : null;
}

function registerLoggedUser($user){
    $_SESSION["id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
}

function saveImg($foto, $user){
    if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
        $estensione = pathinfo($foto['name'], PATHINFO_EXTENSION);

        if($user){
            // Crea cartella se non esiste
            $uploadDir = 'resources/users/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            } 

            $nomeFile = uniqid('user_') . '.' . $estensione;
        } else {
            // Crea cartella se non esiste
            $uploadDir = 'resources/posts/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $nomeFile = uniqid('post_') . '.' . $estensione;
        }
        
        // Genera nome file univoco
        $fotoPath = $uploadDir . $nomeFile;
        
        // Salva il file
        if (!move_uploaded_file($foto['tmp_name'], $fotoPath)) {
            $result["errorecreazione"] = "Errore durante il salvataggio della foto";
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }

        return $nomeFile;
    }
}

?>