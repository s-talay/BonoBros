<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root . "/bits/sessioncheck.php");

// Templatevariablen
$pageTitle = "TicTacToe";
$pageScripts = '<script src="/js/tictactoeonline.js"></script>';
$pageStyles = '<link rel="stylesheet" href="/css/tictactoe.css"><link rel="stylesheet" href="/css/tictactoe_online.css">';
if (!isset($_GET['lobbyId'])) { // Check ob Lobby ID gesetzt
  echo ("Keine Lobby ID");
  die;
}
$lobbyId = $_GET['lobbyId'];
echo "<script>let lobbyId = " . json_encode($lobbyId) . ";</script>"; // Lobby ID für Frontend JS setzen
// komische Bugs mit externem Stylesheet
//$pageStyles = '<link rel="stylesheet" href="/css/tictactoe_online.css">';
$pageContent = file_get_contents($root . "/content/tictactoe_online.html");

include_once($root . "/php/master.php");
?>