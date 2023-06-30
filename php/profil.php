<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root . "/bits/sessioncheck.php");

// Templatevariablen
$pageTitle = "Profil";
$pageContent = file_get_contents($root . "/content/profil.php");
$pageScripts = '<script src="/js/profil.js"></script>';

include_once($root . "/php/master.php");
?>