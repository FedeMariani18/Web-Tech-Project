<?php
require_once 'bootstrap.php';

if (isset($_POST['eliminaCommento'])) {
    $response = "";
    $result = $dbh->removeComment($_POST['idCommento']);
    if(!$result){
        $response = "errore";
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if (isset($_POST['eliminaPost'])) {
    $response = "ok";
    if (!isset($_SESSION['id'])) {
        $response = "errore";
    } else {
        $post = $dbh->getPost($_POST['id_post']);
        if (!$post || $post['id_creatore'] != $_SESSION['id']) {
            $response = "errore";
        } else {
            $membri = $dbh->getMembersFromPost($_POST['id_post']); 
            for ($i = 0; $i < count($membri); $i++) {
                $resultNotifica = $dbh->insertNewNotification(4, $membri[$i]['id'], date("Y-m-d H:i:s"), $_POST['creatore'], $_POST['id_post'], 0);
                if(!$resultNotifica) {
                    $response = "Errore nell'invio della notifica per " . $membri[$i]['nome'] . " " . $membri[$i]['cognome'];
                }
            }
            $result = $dbh->deletePost($_POST['id_post']);
            if(!$result){
                $response = "errore";
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if (isset($_POST['like'])) {
    if ($_POST['like'] == "true") {
        $response = "";
        $result = $dbh->insertNewLike($_POST['id_post'], $_POST['id_utente']);
        if(!$result){
            $response = "errore";
        } else {
            $result = $dbh->insertNewNotification(1, $_POST['creatore'], date("Y-m-d H:i:s"), $_POST['id_utente'], $_POST['id_post'], 0);
            if(!$result) {
                $response = "errore";
            }
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    } else {
        $response = "";
        $result = $dbh->removeLike($_POST['id_post'], $_POST['id_utente']);
        if(!$result){
            $response = "errore";
        }
        header('Content-Type: application/json');
        echo json_encode($response);
        exit;
    }
}

if (isset($_POST['testo'])) {
    $response = "";
    $result = $dbh->insertNewComment($_POST['testo'], $_POST['id_utente'], $_POST['id_post']);
    if(!$result){
        $response = "errore";
    } else {
        if ($_POST['creatore'] != $_POST['id_utente']) {
            $result = $dbh->insertNewNotification(3, $_POST['creatore'], date("Y-m-d H:i:s"), $_POST['id_utente'], $_POST['id_post'], 0);
        }
        if(!$result) {
            $response = "errore";
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

if (isset($_POST['id_utente']) && isset($_POST['id_post']) && !isset($_POST['testo'])) {
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
            $resultNotifica = $dbh->insertNewNotification(2, $_POST['creatore'], date("Y-m-d H:i:s"), $_POST['id_utente'], $_POST['id_post'], 0);
            if(!$resultNotifica) {
                $response["errore"] = "Errore nell'invio della notifica.";
            }
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
            $result = $dbh->insertNewNotification(5, $_POST['creatore'], date("Y-m-d H:i:s"), $_POST['id_utente'], $_POST['id_post'], 0);
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
    'id_utente' => null,
    'likeUtente' => null,
    'admin' => null
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
        $response['likeUtente'] = $dbh->hasUserLikedPost($_SESSION['id'], $id);
        $response['admin'] = $dbh->getUserFromId($_SESSION['id'])['ruolo'] == 'ADMIN';
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
    for($i = 0; $i < count($post['partecipanti']); $i++){
        //sistemo il percorso della foto
        $post['partecipanti'][$i]['foto'] = UPLOAD_DIR_PROFILE . $post['partecipanti'][$i]['foto'];
    }
    $post['numero_partecipanti'] = $dbh->getNumberOfMembersFromPost($id);
    $post['commenti'] = $dbh->getCommentsFromPost($id);
    $post['creatore'] = $dbh->getCreatorFromPost($id);
    for($i = 0; $i < count($post['commenti']); $i++){
        $user = $dbh->getUserFromComment($post["commenti"][$i]['id']);
        $post["commenti"][$i]['username'] = $user['username'];
        $post["commenti"][$i]['id_utente'] = $user['id'];
        $post["commenti"][$i]['foto_utente'] = UPLOAD_DIR_PROFILE . $user['foto'];
    }
    $response['post'] = $post;
} else {
    // $post = $dbh->getActivePosts();
    $post = $dbh->getActivePostsWithParticipantCount();

    for($i = 0; $i < count($post); $i++){
        $post[$i]["foto"] = UPLOAD_DIR_POST.$post[$i]["foto"];
    }
    $response['post'] = $post;
}

header('Content-Type: application/json');
echo json_encode($response);
?>