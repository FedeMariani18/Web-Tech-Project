<?php
require_once 'bootstrap.php'

$templateParams["titolo"] = "Login";
$templateParams["js"] = array("js/login.js");

require 'template/login-form.php';
?>