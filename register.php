<?php
require_once "config.php";
$pageStyles = '<link rel="stylesheet" href="css/register.css">';
$pageTitle = "Registrieren";
$pageContent = file_get_contents("content/register.php");
    include_once("master.php"); 
?>