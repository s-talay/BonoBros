<?php
if(isset($_GET['gamename'])){
    $gamename = $_GET['gamename'];
    if($gamename =="tictactoe"){
        $pageTitle="TicTacToe";
        $pageScripts='<script src="js/tictactoe.js"></script>';
        $pageStyles='<link rel="stylesheet" href="css/tictactoe.css">';
        $pageContent= file_get_contents("content/tictactoe.php");
    }else{
    }
    include_once("master.php");
}else{
    include_once("master.php");
}
?>
