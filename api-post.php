<?php
require_once 'bootstrap.php';

if (isset($_POST['testo'])) {
    $response = "";
    $result = $dbh->insertNewComment($_POST['testo'], $_POST['id_utente'], $_POST['id_post']);
    if(!$result){
        $response = "errore";
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if (isset($_POST['id_utente']) && isset($_POST['id_post'])) {
    if ($_POST['partecipazione'] == "true") {
        $response = [
        'iscrizioneRiuscita' => false,
        'errore' => null
        ];
        $response['iscrizioneRiuscita'] = false;
        $result = $dbh->insertNewPartecipation($_POST['id_utente'], $_POST['id_post']);
        if($result){
            $response["iscrizioneRiuscita"] = true;
            $_SESSION["flash_message"] = "Iscrizione avvenuta con successo.";
        } else{
            $response["errore"] = "Errore nell'iscrizione.";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        $response = [
        'disiscrizioneRiuscita' => false,
        'errore' => null
        ];
        $response['disiscrizioneRiuscita'] = false;
        $result = $dbh->removeParticipation($_POST['id_utente'], $_POST['id_post']);
        if($result){
            $response["disiscrizioneRiuscita"] = true;
            $_SESSION["flash_message"] = "Disiscrizione avvenuta con successo.";
        } else{
            $response["errore"] = "Errore nela disiscrizione.";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

$response = [
    'utenteLoggato' => isUserLoggedIn(),
    'post' => null,
    'fotoProfilo' => null,
    'utentePartecipa' => null,
    'id_utente' => null
];

if (isUserLoggedIn()) {
    $response['fotoProfilo'] = $dbh->getUserFromId($_SESSION['id'])['foto'];
    $response['fotoProfilo'] = UPLOAD_DIR_PROFILE.$response['fotoProfilo'];
    $response['id_utente'] = $_SESSION['id'];
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    if (isUserLoggedIn()) {
        $response['utentePartecipa'] = $dbh->isUserAPartecipant($_SESSION['id'], $id);
    }
    $post = $dbh->getPost($id);
    if (!$post) {
        http_response_code(404);
        echo json_encode(['error' => 'Post non trovato']);
        exit;
    }
    $post['foto'] = UPLOAD_DIR_POST . $post['foto'];
    error_log("UPLOAD_DIR_POST = " . UPLOAD_DIR_POST);
    error_log("foto = " . $post['foto']);

    $post['partecipanti'] = $dbh->getMembersFromPost($id);
    $post['numero_partecipanti'] = $dbh->getNumberOfMembersFromPost($id) + 1;
    $post['commenti'] = $dbh->getCommentsFromPost($id);
    $post['creatore'] = $dbh->getCreatorFromPost($id);
    for($i = 0; $i < count($post['commenti']); $i++){
        $user = $dbh->getUserFromComment($post["commenti"][$i]['id']);
        $post["commenti"][$i]['username'] = $user['username'];
        $post["commenti"][$i]['id_utente'] = $user['id'];
    }
    $response['post'] = $post;
} else {
    $post = $dbh->getActivePosts();
    for($i = 0; $i < count($post); $i++){
        $post[$i]["foto"] = UPLOAD_DIR_POST.$post[$i]["foto"];
    }
    $response['post'] = $post;
}

header('Content-Type: application/json');
echo json_encode($response);
?>