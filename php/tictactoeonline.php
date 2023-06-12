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

$pageContent= '<article>
<h1>Tic Tac Toe</h1>
  <table>
    <tr>
      <td id="cell00"></td>
      <td id="cell01"></td>
      <td id="cell02"></td>
    </tr>
    <tr>
      <td id="cell10"></td>
      <td id="cell11"></td>
      <td id="cell12"></td>
    </tr>
    <tr>
      <td id="cell20"></td>
      <td id="cell21"></td>
      <td id="cell22"></td>
    </tr>
  </table>
  <button id="restart">Restart Game</button>
</article>';

include_once($root."/php/master.php");
?>

