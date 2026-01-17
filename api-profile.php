<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

if (isUserLoggedIn()) {
    $id = $_SESSION['id'];
    $user = $dbh->getUserFromId($id);
    $user['foto'] = UPLOAD_DIR_PROFILE.$user['foto'];
    $user['postAttivi'] = $dbh->getActivePostsFromUser($id);
    for ($i = 0; $i < count($user['postAttivi']); $i++) {
        $user['postAttivi'][$i]['foto'] = UPLOAD_DIR_POST.$$user['postAttivi'][$i]['foto'];
    }
    echo json_encode($user);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Non sei loggato']);
}
