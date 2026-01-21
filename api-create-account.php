<?php
require_once 'bootstrap.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');

$result = ["creazioneeseguita" => false];

try {
    // Gestione foto
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoName = getImgUniqName($_FILES['foto'], true);
    } else {
        $fotoName = "default_profile.png";
    }

    if (!isset($_POST["password"])) {
        throw new Exception("Password mancante");
    }

    $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $create_result = $dbh->createUtente(
        $_POST["username"],
        $passwordHash,
        $_POST["nome"],
        $_POST["cognome"],
        $_POST["telefono"],
        $_POST["mail"],
        $fotoName
    );

    if (!$create_result) {
        http_response_code(400);
        echo json_encode([
            "creazioneeseguita" => false,
            "errorecreazione" => "Username già esistente"
        ]);
        exit;
    }

    $result["creazioneeseguita"] = true;
    saveImg($_FILES['foto'], true, $fotoName);
    echo json_encode($result);

} catch (Throwable $e) {
    http_response_code(500);
    echo json_encode([
        "creazioneeseguita" => false,
        "errorecreazione" => "errore nella creazione dell'accaount: " . $e->getMessage()
    ]);
}

