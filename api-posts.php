<?php
require_once 'bootstrap.php';

$posts = $dbh->getActivePosts();

if(count($posts) === 0){
    //tentativo di query fallito
    $result["erroreposts"] = "fallito il caricamento dei post";
}
else{
    $result["postscaricati"] = true;
    for($i = 0; $i < count($posts); $i++){
        $posts[$i]["foto"] = UPLOAD_DIR_POST.$posts[$i]["foto"];
    }
    $response['posts'] = $posts;
}

header('Content-Type: application/json');
echo json_encode($response);
?>