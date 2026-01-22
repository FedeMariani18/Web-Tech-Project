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

function getImgUniqName($foto, $user){
    if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
        $estensione = pathinfo($foto['name'], PATHINFO_EXTENSION);

        if($user){
            // Genera nome file univoco
            $nomeFile = uniqid('user_') . '.' . $estensione;
        } else {
            // Genera nome file univoco
            $nomeFile = uniqid('post_') . '.' . $estensione;
        }

        return $nomeFile;
    }
    return null;
}

// function saveImg($foto, $user, $nomeFile){
//     if (isset($foto) && $foto['error'] === UPLOAD_ERR_OK) {
        
//         // Crea cartella se non esiste
//         if($user){
//             $uploadDir = UPLOAD_DIR_PROFILE;
//             if (!is_dir($uploadDir)) {
//                 mkdir($uploadDir, 0755, true);
//             } 
//         } else {
//             $uploadDir = UPLOAD_DIR_POST;
//             if (!is_dir($uploadDir)) {
//                 mkdir($uploadDir, 0755, true);
//             }
//         }
        
//         //crea file path intero
//         $fotoPath = $uploadDir . $nomeFile;
        
//         // Salva il file
//         if (!move_uploaded_file($foto['tmp_name'], $fotoPath)) {
//             $result["errorecreazione"] = "Errore durante il salvataggio della foto";
//             header('Content-Type: application/json');
//             echo json_encode($result);
//             exit;
//         }

//         return $nomeFile;
//     }
// }

function saveImg($foto, $user, $nomeFile) {

    if (empty($nomeFile)) {
        return false;
    }

    if (!isset($foto) || $foto['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    $uploadDir = $user ? UPLOAD_DIR_PROFILE : UPLOAD_DIR_POST;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    $fotoPath = $uploadDir . $nomeFile;

    if (!move_uploaded_file($foto['tmp_name'], $fotoPath)) {
        return false;
    }

    return $nomeFile;
}

?>