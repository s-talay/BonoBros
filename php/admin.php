<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/sessioncheck.php");

// Check ob Admin, falls nicht weiterleiten
if(!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1){
    header("HTTP/1.0 404 Not Found");
    include($root."/404.php");
    exit();
}
//Template Variablen
$pageTitle = "Admin Panel";
$pageStyles = '<link rel="stylesheet" href="/css/admin.css">';
$pageContent = file_get_contents($root."/content/admin.php");
$pageScripts = '<script src="/js/admin.js"></script>';
//Template
include_once($root."/php/master.php");
?>