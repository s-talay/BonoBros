<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root."/bits/sessioncheck.php");

$pageTitle = "Your Lobby";
$pageContent= file_get_contents($root."/content/c_lobby.php");
include_once($root."/php/master.php");
?>