<?php
    require_once 'bootstrap.php';

    $result["postcreated"] = false;

    // Gestione upload foto
    $fotoName = null;
    if (isset($_FILES['foto'])) {
        $fotoName = saveImg($_FILES['foto'], false);
        if (!$fotoName) {
            $result["errorecreazione"] = "Errore durante il salvataggio della foto";
            header('Content-Type: application/json');
            echo json_encode($result);
            exit;
        }
    }

    $insertId = $dbh->createPost($_POST['titolo'], $_POST['descrizione'], 
        $_POST['dataOra'], $_POST['nPartecipanti'], 
        $_POST['indirizzo'], $_POST['citta'], $_POST['comune'], 
        $_POST['provincia'], $_POST['categoria'], $fotoName, $_SESSION['id']);

    if(!$insertId){
        //Creazione annuncio fallita
        $result["errorcreation"] = "Errore nella creazione del post";
    } else {
        //Creazione annuncio riuscita
        $result["postcreated"] = true;
        $result["idPost"] = $insertId;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
