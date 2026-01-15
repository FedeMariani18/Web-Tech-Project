<?php 

function isUserLoggedIn(){
    return !empty($_SESSION['id']);
}

function registerLoggedUser($user){
    $_SESSION["id"] = $user["id"];
    $_SESSION["username"] = $user["username"];
    $_SESSION["nome"] = $user["nome"];
    $_SESSION["cognome"] = $user["cognome"];
}

?>