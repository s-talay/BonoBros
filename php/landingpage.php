<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include_once("bits/sessioncheck.php");
$pageStyles = '<link rel="stylesheet" href="/css/landingpage.css">';
$pageTitle = "Home";
$pageContent = file_get_contents($root."/content/landingpage.html");

include_once($root."/php/master.php");
?>