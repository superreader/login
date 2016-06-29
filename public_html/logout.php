<?php 
require_once(__DIR__ . "/../config/config.php");

echo "Location: ".SITE_URL;
if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(!isset($_POST["token"]) || $_POST["token"] !== $_SESSION["token"]) {
        echo "Invalid Token";
        exit;
    }

    $_SESSION = [];

    if(!isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 80000,"/");
    }
    session_destroy();
}
echo "Location: ".SITE_URL;
header("Location: ".SITE_URL);
