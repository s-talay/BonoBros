<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root."/bits/sessioncheck.php");

//$pageStyles = '<link rel="stylesheet" href="/css/landingpage.css">';
$pageTitle = "Profil";
//$pageScripts = '<script src="/js/gameswitcher.js"></script>';
$pageContent = file_get_contents($root."/content/profil.php");

include_once($root."/php/master.php");
?>