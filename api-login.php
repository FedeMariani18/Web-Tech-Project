<?php
require_once 'bootstrap.php';

$result["logineseguito"] = false;
if(isset($_POST["username"]) && isset($_POST["password"])){
    $user = $dbh->getUserFromUsername($_POST["username"]);

    if ($user && password_verify($_POST["password"], $user["password_hash"])) {
        //Login riuscito
        registerLoggedUser($user);
    } else {
        //Login fallito
        $result["errorelogin"] = "Username e/o password errati";
    }
}

if(isUserLoggedIn()){
    $result["logineseguito"] = true;
}

header('Content-Type: application/json');
echo json_encode($result);

?>