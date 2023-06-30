<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/sessioncheck.php");

// Template Variablen
$pageTitle = "Your Lobby";
$pageContent= file_get_contents($root."/content/c_lobby.php");
$pageStyles = '<link rel="stylesheet" href="/css/c_lobby.css">';
$pageScripts = '<script src="/js/c_lobby.js"></script>';
include_once($root."/php/master.php");
?>