<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

$response = [
    'utenteLoggato' => isUserLoggedIn(),
    'fotoProfilo' => null,
    'likes' => null
];

if (isUserLoggedIn()) {
    $response['fotoProfilo'] = $dbh->getUserFromId($_SESSION['id'])['foto'];
    $response['fotoProfilo'] = UPLOAD_DIR_PROFILE.$response['fotoProfilo'];
    $response['username'] = $dbh->getUserFromId($_SESSION['id'])['username'];
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $post = $dbh->getLikedPostFromUser($id);
    for($i = 0; $i < count($post); $i++){
        $post[$i]["foto"] = UPLOAD_DIR_POST.$post[$i]["foto"];
    }
    $response['likes'] = $post;
    echo json_encode($response);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Non sei loggato']);
}
