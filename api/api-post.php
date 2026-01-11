<?php
require_once 'bootstrap.php';
$post = $dbh->getActivePosts();

for($i = 0; $i < count($post); $i++){
    $post[$i]["foto"] = UPLOAD_DIR.$post[$i]["foto"];
}
header('Content-Type: application/json');
echo json_encode($post);
?>