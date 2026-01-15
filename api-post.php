<?php
require_once 'bootstrap.php';
if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $postArray = $dbh->getPost($id);
    if (!$postArray || count($postArray) === 0) {
        http_response_code(404);
        echo json_encode(['error' => 'Post non trovato']);
        exit;
    }
    $post = $postArray[0];
    $post['foto'] = UPLOAD_DIR . $post['foto'];
    $post['partecipanti'] = $dbh->getMembersFromPost($id);
} else {
    $post = $dbh->getActivePosts();
    for($i = 0; $i < count($post); $i++){
        $post[$i]["foto"] = UPLOAD_DIR.$post[$i]["foto"];
    }
}

header('Content-Type: application/json');
echo json_encode($post);
?>