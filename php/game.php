<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root . "/bits/sessioncheck.php");

//Überprüfen der Variable in URL
if (isset($_GET['gamename'])) {
    $gamename = $_GET['gamename'];
    //TicTacToe online oder normal
    if ($gamename == "tictactoe") {
        // Template Variablen
        $pageTitle = "TicTacToe";
        $pageScripts = '<script src="/js/tictactoe.js"></script>';
        $pageStyles = '<link rel="stylesheet" href="/css/tictactoe.css">';
        $pageContent = file_get_contents($root . "/content/tictactoe.html");
    } else if ($gamename == "tictactoe_online") {
        // Template Variablen
        $pageTitle = "TicTacToe - Lobbys";
        $pageScripts = '<script src="/js/c_lobby_tictactoe.js"></script>';
        $pageStyles = '<link rel="stylesheet" href="/css/c_lobby_tictactoe.css">';
        $pageContent = file_get_contents($root . "/content/c_lobby_tictactoe.php");
    } else {
        header("location: 404.php");
        exit();
    }
    include_once($root . "/php/master.php");
} else { // weiterleiten wenn Variable fehlt
    header("location: 404.php");
    exit();
}
?>