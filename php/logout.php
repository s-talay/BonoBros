<?php
session_start();//initialisieren
$_SESSION = array();//leeren
session_destroy();//Destroy
header("location: /php/login.php");//redirect
exit();//close
?>