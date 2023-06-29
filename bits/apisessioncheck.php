<?php
session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    checkAndResetTime(TIMEOUT_DUR);
} else {
    header("Location: /php/login.php", true, 301);
}


function checkAndResetTime($timeout_dur){
    if(isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) >= $timeout_dur){
        header("location: /php/logout.php");
    }else{
        $_SESSION["last_activity"] = time();
    }
}
?>