<?php
    require_once 'bootstrap.php';
    $response = [
        'searchsuccess' => false,
        'id_utente' => isset($_SESSION['id']) ? $_SESSION['id'] : null,
        'error' => "",
        'posts' => [],
        'users' => []
    ];

    $searchedPost = $dbh->searchPosts($_GET['query']);
    $searchedUser = $dbh->searchUsers($_GET['query']);

    if(!$searchedPost && !$searchedUser){
        $response['error'] = "Nessun risultato trovato";
    } else {
        for($i = 0; $i < count($searchedPost); $i++){
            $searchedPost[$i]["foto"] = UPLOAD_DIR_POST.$searchedPost[$i]["foto"];
        }

        for($i = 0; $i < count($searchedUser); $i++){
            $searchedUser[$i]["foto"] = UPLOAD_DIR_PROFILE.$searchedUser[$i]["foto"];
        }
        
        $response['posts'] = $searchedPost;
        $response['users'] = $searchedUser;
        $response['searchsuccess'] = true;
    }

    header('Content-Type: application/json');
    echo json_encode($response);
?>