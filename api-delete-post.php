<?php
require_once 'bootstrap.php';

$result["posteliminato"] = false;
$deletion_result = $dbh->deletePost($_POST['id']);

if($deletion_result === null){
    //tentativo di query fallito
    $result["errorecancellazione"] = "fallita l'eliminazione del post";
} else{
    $result["posteliminato"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);
?>