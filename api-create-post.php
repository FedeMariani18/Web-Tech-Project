<?php
    require_once 'bootstrap.php';

    $result["postcreated"] = false;

    $creationresult = $dbgh->createPost($_POST['titolo'], $_POST['descrizione'], 
        $_POST['data'], $_POST['orario'], $_POST['nPartecipanti'], 
        $_POST['via'], $_POST['civico'], $_POST['citta'], $_POST['comune'], 
        $_POST['provincia'], $_POST['categoria'], $_POST['foto']);

    if(!$creationresult){
        //Creazione annuncio fallita
        $result["errorcreation"] = "Errore nella creazione del post";
    } else {
        //Creazione annuncio riuscita
        $result["postcreated"] = true;
    }

    header('Content-Type: application/json');
    echo json_encode($result);
?>
