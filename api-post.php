<?php
require_once 'bootstrap.php';
if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $post = $dbh->getPost($id);
    if (!$post) {
        http_response_code(404);
        echo json_encode(['error' => 'Post non trovato']);
        exit;
    }
    $post['foto'] = UPLOAD_DIR . $post['foto'];
    $post['partecipanti'] = $dbh->getMembersFromPost($id);
    $post['numero_partecipanti'] = $dbh->getNumberOfMembersFromPost($id);
    $post['commenti'] = $dbh->getCommentsFromPost($id);
    for($i = 0; $i < count($post['commenti']); $i++){
        $user = $dbh->getUserFromComment($post["commenti"][$i]['id']);
        $post["commenti"][$i]['username'] = $user['username'];
        $post["commenti"][$i]['id_utente'] = $user['id'];
    }
} else {
    $post = $dbh->getActivePosts();
    for($i = 0; $i < count($post); $i++){
        $post[$i]["foto"] = UPLOAD_DIR.$post[$i]["foto"];
    }
}

header('Content-Type: application/json');
echo json_encode($post);
?>