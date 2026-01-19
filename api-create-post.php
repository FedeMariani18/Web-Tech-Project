<?php
    require_once 'bootstrap.php';

    $result["postcreated"] = false;

    // Gestione upload foto
    $fotoName = null;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $fotoName = saveImg($_FILES['foto'], false);
    } else {
        switch ($_POST['categoria']) {
            case 1:
                $fotoName = "img_prova.jpeg";
                break;
            case 2:
                $fotoName = "img_prova.jpeg";
                break;
            case 3:
                $fotoName = "img_prova.jpeg";
                break;
            default:
                $fotoName = "img_prova.jpeg";
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
