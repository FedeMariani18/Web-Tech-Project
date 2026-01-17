<?php
    session_start();
    define("UPLOAD_DIR", "./resources/");
    define("UPLOAD_DIR_POST", "./resources/posts/");
    define("UPLOAD_DIR_PROFILE", "./resources/users/");

    require_once("utils/functions.php");
    require_once("db/database.php");
    $dbh = new DatabaseHelper("localhost", "root", "", "webtechproject", 3306);
?>