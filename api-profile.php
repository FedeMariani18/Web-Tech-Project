<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

if (isUserLoggedIn() || isset($_GET['id'])) {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        $id = $_SESSION['id'];
    }
    $user = $dbh->getUserFromId($id);
    $user['foto'] = UPLOAD_DIR_PROFILE.$user['foto'];
    $user['postAttivi'] = $dbh->getActivePostsFromUser($id);
    if(isUserLoggedIn()) {
        $user['utenteLoggato'] = true;
        $user['fotoProfilo'] = UPLOAD_DIR_PROFILE.$dbh->getUserFromId($_SESSION['id'])['foto'];
    }
    for ($i = 0; $i < count($user['postAttivi']); $i++) {
        $user['postAttivi'][$i]['foto'] = UPLOAD_DIR_POST.$user['postAttivi'][$i]['foto'];
    }
    echo json_encode($user);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Non sei loggato']);
}
