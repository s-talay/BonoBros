<?php
// identisch zu sessioncheck aber ohne Weiterleitung
session_start();
// Check ob eingeloggt
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    checkAndResetTime(TIMEOUT_DUR);
} else {
    header("Location: /php/login.php", true, 301);
}


function checkAndResetTime($timeout_dur){ // Auto Logout oder Timer refresh
    if(isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) >= $timeout_dur){
        header("location: /php/logout.php");
    }else{
        $_SESSION["last_activity"] = time();
    }
}
?>