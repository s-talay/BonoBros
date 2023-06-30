<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/sessioncheck.php");

// Template Variablen
$pageTitle = "Home";
$pageContent = file_get_contents($root."/content/landingpage.html");

include_once($root."/php/master.php");
?>