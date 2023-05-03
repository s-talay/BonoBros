<?php
    session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == true){
        header("Location: landingpage.php",true,301);
    }else{
        header("Location: login.php",true,301);
    }
    exit();
?>