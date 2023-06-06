<?php
$root = $_SERVER['DOCUMENT_ROOT'];

include_once($root."/bits/sessioncheck.php");

if(isset($_GET['gamename'])){
    $gamename = $_GET['gamename'];
    if($gamename =="tictactoe"){
        $pageTitle="TicTacToe";
        $pageScripts='<script src="/js/tictactoe.js"></script>';
        $pageStyles='<link rel="stylesheet" href="/css/tictactoe.css">';
        $pageContent= file_get_contents($root."/content/tictactoe.php");
    }else if($gamename =="tictac"){
        $pageTitle="TicTacToe";
        // $pageScripts='<script src="/js/tictactoe.js"></script>';
        // $pageStyles='<link rel="stylesheet" href="/css/tictactoe.css">';
        $pageContent= file_get_contents($root."/content/c_.php");
    }else{
    }
    include_once($root."/php/master.php");
}else{
    include_once($root."/php/master.php");
}
?>
