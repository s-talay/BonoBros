<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root."/bits/sessioncheck.php");

$pageTitle = "TicTacToe - Lobbys";
$pageContent= file_get_contents($root."/content/c_lobby_tictactoe.php");
include_once($root."/php/master.php");
?>