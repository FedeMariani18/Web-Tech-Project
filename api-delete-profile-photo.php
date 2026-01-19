<?php
    require_once 'bootstrap.php';
    $response['deletesuccess'] = false;

    $response['deletesuccess'] = $dbh->deleteProfilePhoto($_GET['id']);

    header('Content-Type: application/json');
    echo json_encode($response);

?>