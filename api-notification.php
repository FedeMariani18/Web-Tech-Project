<?php
require_once 'bootstrap.php';

header('Content-Type: application/json');
$_SESSION['id'] = 2;
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $notifications = $dbh->getNotificationFromUser($id);
    echo json_encode($notifications);
} else {
    http_response_code(401);
    echo json_encode(['error' => 'Non sei loggato']);
}
