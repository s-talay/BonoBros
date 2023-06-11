<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root."/bits/sessioncheck.php");
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1){
    header("HTTP/1.0 404 Not Found");
    include($root."/404.php");
    exit();
}
//$pageStyles = '<link rel="stylesheet" href="/css/landingpage.css">';
$pageTitle = "Admin Panel";
//$pageScripts = '<script src="/js/gameswitcher.js"></script>';
$pageContent = file_get_contents($root."/content/admin.php");

include_once($root."/php/master.php");
?>