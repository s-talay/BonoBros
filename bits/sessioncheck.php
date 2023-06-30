<?php
//Session start mit extras für jede Seite
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
// Check ob eingeloggt, falls nein weiterleiten
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true) {
    checkTime(TIMEOUT_DUR);
    if (basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == '') {
        header("Location: /php/landingpage.php", true, 301);
    }
} else {
    header("Location: /php/login.php", true, 301);
}


function checkTime($timeout_dur){ // Auto Logout oder Timer refresh
    if(isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"]) > $timeout_dur){
        header("location: /php/logout.php");
    }else{
        $_SESSION["last_activity"] = time();
    }
}
?>