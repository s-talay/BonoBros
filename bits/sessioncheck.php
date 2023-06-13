<?php
session_start();

$root = $_SERVER['DOCUMENT_ROOT'];
$ini_path = $root."/php.ini";
$array = parse_ini_file($ini_path);
define('TIMEOUR_DUR', $array["timeout_time"]);

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    checkTime(TIMEOUR_DUR);
    if (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') {
        header("Location: /php/landingpage.php", true, 301);
    }
} else {
    header("Location: /php/login.php", true, 301);
}


function checkTime($timeout_dur){
    if(isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) > $timeout_dur){
        header("location: /php/logout.php");
    }else{
        $_SESSION["last_activity"] = time();
    }
}
?>