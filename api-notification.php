<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');

$response = [
    'utenteLoggato' => isUserLoggedIn(),
    'fotoProfilo' => null,
    'notifications' => null
];

if (isUserLoggedIn()) {
    $response['fotoProfilo'] = $dbh->getUserFromId($_SESSION['id'])['foto'];
    $response['fotoProfilo'] = UPLOAD_DIR_PROFILE.$response['fotoProfilo'];
}

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $notifications = $dbh->getNotificationFromUser($id);
    $response['notifications'] = $notifications;
    echo json_encode($response);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Non sei loggato']);
}
