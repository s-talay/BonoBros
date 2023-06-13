<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root."/bits/sessioncheck.php");
$pageTitle="TicTacToe";
$pageScripts='<script src="/js/tictactoeonline.js"></script>';
$pageStyles='<link rel="stylesheet" href="/css/tictactoe.css">';
if(!isset($_GET['lobbyId'])){
  echo("no lobby id");
  die;
}
$lobbyId = $_GET['lobbyId'];
echo "<script>let lobbyId = ". json_encode($lobbyId) . ";</script>";

$pageContent= file_get_contents($root."/content/tictactoe.html");

include_once($root."/php/master.php");
?>

