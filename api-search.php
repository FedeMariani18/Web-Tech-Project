<?php
    require_once 'bootstrap.php';
    $response = [
        'searchsuccess' => false,
        'error' => "",
        'results' => []
    ];

    error_log("QUERY ARRIVATA: " . $_GET['query']);
    $searchedPost = $dbh->searchPosts($_GET['query']);

    if(!$searchedPost){
        $response['error'] = "Nessun risultato trovato";
    } else {
        for($i = 0; $i < count($searchedPost); $i++){
            $searchedPost[$i]["foto"] = UPLOAD_DIR_POST.$searchedPost[$i]["foto"];
        }
        $response['results'] = $searchedPost;
        $response['searchsuccess'] = true;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>