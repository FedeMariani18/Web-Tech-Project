<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $post = $dbh->getLikedPostFromUser($id);
    for($i = 0; $i < count($post); $i++){
        $post[$i]["foto"] = UPLOAD_DIR.$post[$i]["foto"];
    }
    echo json_encode($post);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Non sei loggato']);
}
