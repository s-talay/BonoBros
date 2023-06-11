<?php
session_start();

$timeout_dur = 1800; // in Sekunden

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    checkTime($timeout_dur);
    $_SESSION["last_activity"] = time();
    if (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') {
        header("Location: /php/landingpage.php", true, 301);
    }
} else {
    header("Location: /php/login.php", true, 301);
}


function checkTime($timeout_dur){
    if(isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) > $timeout_dur){
        header("location: /php/logout.php");
    }
}
?>