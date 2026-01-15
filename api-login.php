<?php
require_once 'bootstrap.php';

$result["logineseguito"] = false;
if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if($login_result === null){
        //Login fallito
        $result["errorelogin"] = "Username e/o password errati";
    }
    else{
        //Login riuscito
        registerLoggedUser($login_result);
    }
}

if(isUserLoggedIn()){
    $result["logineseguito"] = true;
    //TODO: go to userProfile
}

header('Content-Type: application/json');
echo json_encode($result);

?>